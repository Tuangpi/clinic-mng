<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderPayment;
use App\Models\PurchaseOrderProduct;
use App\Models\PaymentOption;
use App\Models\Tax;
use Carbon\Carbon;

use DataTables;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        if ($request->ajax()) {
            $data = PurchaseOrder::active($branchId, $request->startDate, $request->endDate, $request->supplier, $request->paymentStatus, $request->deliveryStatus);
            return Datatables::of($data)
            ->filterColumn('supplier', function($query, $keyword) {
                $query->whereRaw("s.name like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('item_count', function($query, $keyword) {
                $query->whereRaw("(Select count(1) from purchase_order_products as pop 
                where pop.purchase_order_id = purchase_orders.id and pop.deleted_at is null) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('invoice_no', function($query, $keyword) {
                $query->whereRaw("(
                    select
                    group_concat(
                        pop.invoice_no
                            SEPARATOR ', ') as products
                    from purchase_order_payments pop
                    where pop.deleted_at is null and pop.purchase_order_id = purchase_orders.id
                ) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('branch', function($query, $keyword) {
                $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
            })
            ->make(true);
        }


        $suppliers = Supplier::forDropdown(true)->get();
        $products = Product::withStockForDropdown($branchId)->get();
        $paymentOptions = PaymentOption::forDropdown($branchId)->get();
        $taxes = Tax::forDropdown()->get();
        return view('stock-management/purchase-orders', compact('products', 'suppliers', 'paymentOptions', 'taxes')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $currentBranch = session('branch');
            
            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $p = new PurchaseOrder;
            $p->branch_id = $currentBranch->id;
            $p->created_by = $currentUserId;
            $p->updated_by = $currentUserId;
            $this->mapValues($p, $request);

            $cost_price = 0;
            foreach ($request->products as $prod) {
                $pop = new PurchaseOrderProduct;
                $this->mapProductValues($pop, $prod);
                $pop->created_by = $currentUserId;
                $pop->updated_by = $currentUserId;
                $p->products()->save($pop);
            }
            $p->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'New Order has been created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $po = PurchaseOrder::with([
                'supplier:id,name', 
                'products:id,purchase_order_id,product_id,qty,uom,unit_price,total_amount,delivered_qty,pending_qty',
                'payments:id,purchase_order_id,payment_date,invoice_no,paid_amt,payment_option_id,ref_no,remarks',
                'products.product:id,name',
                'creator:id,first_name,last_name',
                'updator:id,first_name,last_name'
                ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['order' => $po,
                                    'currencySymbol' => $po->branch->currency_symbol]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $po = PurchaseOrder::with(['products:id,purchase_order_id,product_id,qty,uom,unit_price,total_amount'])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['order' => $po,
                                    'currencySymbol' => $po->branch->currency_symbol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            \DB::beginTransaction();

            $po = PurchaseOrder::find($id);
            
            $po->updated_by = \Auth::id();
            $this->mapValues($po, $request);

            if (!empty($request->products)) {
                    
                $pIds = collect($request->products)->pluck('id');
                $po->products()->whereNotIn('id', $pIds)->delete();

                foreach ($request->products as $prod) {
                    $newProduct = $prod['id'] == '0';

                    if ($newProduct) {
                        $pop = new PurchaseOrderProduct;
                        $pop->created_by = \Auth::id();
                    }
                    else {
                        $pop = PurchaseOrderProduct::find($prod['id']);
                    }

                    $this->mapProductValues($pop, $prod);
                    $pop->updated_by = \Auth::id();
                    $po->products()->save($pop);
                }
            }
            else {
                $po->products()->delete();
            }
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Order has been updated.']);
    }

    public function updatePayment(Request $request, $id)
    {
        try {
            
            \DB::beginTransaction();

            $po = PurchaseOrder::find($id);
            
            if (!empty($request->payments)) {
                    
                $pIds = collect($request->payments)->pluck('id');
                $po->payments()->whereNotIn('id', $pIds)->delete();

                foreach ($request->payments as $payment) {
                    $newPayment = $payment['id'] == '0';

                    if ($newPayment) {
                        $pop = new PurchaseOrderPayment;
                        $pop->created_by = \Auth::id();
                    }
                    else {
                        $pop = PurchaseOrderPayment::find($payment['id']);
                    }

                    $pop->payment_date = Carbon::parse($payment['paymentDate']);
                    $pop->invoice_no = $payment['invoiceNo'];
                    $pop->paid_amt = $payment['amt'];
                    $pop->payment_option_id = $payment['paymentOption'];
                    $pop->ref_no = $payment['refNo'];
                    $pop->remarks = $payment['remarks'];
                    $pop->updated_by = \Auth::id();
                    $po->payments()->save($pop);
                }
            }
            else {
                $po->payments()->delete();
            }
            
            
            $po->paid_amount = $po->payments()->sum('paid_amt');
            $po->remaining_balance = $po->total_amount - $po->paid_amount;
            
            if ($po->remaining_balance < 0) {
                \DB::rollBack();
                return response()->json(['errMsg'=> 'Unable to update payment, paid amt. exceeded the total amt.', 'isError'=> true]);
            }
            $po->is_fully_paid =  ($po->remaining_balance == 0);
            $po->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Order has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po = PurchaseOrder::find($id);

        if ($po->deliveries()->exists()) {
            return response()->json(['errMsg'=> 'Unable to cancel, this order has a delivery record.', 'isError'=> true]);
        }

        if ($po->payments()->exists()) {
            return response()->json(['errMsg'=> 'Unable to cancel, this order has a payment record.', 'isError'=> true]);
        }

        $po->delete();
        return response()->json(['errMsg'=> '', 'isError'=> false]);
    }

    private function mapValues($po, $request)
    {
        $po->order_date = Carbon::parse($request->orderDate);
        $po->po_no = $request->poNo;
        $po->supplier_id = $request->supplier;
        $po->disc_percentage = $request->discPercentage;
        $po->disc_amount = $request->discAmount;
        $po->tax_id = $request->tax;
        if ($po->tax_id) {
            $po->tax_percentage = $request->taxPercentage;
            $po->tax_amount = $request->taxAmount;
        }
        else {
            $po->tax_percentage = null;
            $po->tax_amount = null;
        }
        $po->total_amount = $request->totalAmount;
        $po->remaining_balance = $po->total_amount;

        $po->save();

        if (empty($po->code)) {
            $po->code = 'ON-' . sprintf('%02d', $po->branch_id) . '-' . $po->created_at->year  . '-' . sprintf('%05d', $po->id);
        }

        $po->save();
    }

    private function mapProductValues($pop, $prod)
    {
        $pop->product_id = $prod['product'];
        $pop->qty = $prod['qty'];
        $pop->uom = $prod['uom'];
        $pop->unit_price = $prod['price'];
        $pop->total_amount = $prod['total'];
        $pop->pending_qty = $pop->qty;
    }
}
