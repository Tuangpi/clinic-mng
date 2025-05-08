<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Branch;
use App\Models\Product;
use App\Models\StockAdjustment;
use App\Models\StockAdjustmentType;
use App\Models\StockAdjustmentProduct;
use App\Models\Supplier;

use App\Enums\StockAdjustmentType as StockAdjustmentTypeEnum;
use DataTables;

class StockAdjustmentController extends Controller
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
            $data = StockAdjustment::active($branchId, $request->startDate, $request->endDate);
            return Datatables::of($data)
            ->filterColumn('created_by', function($query, $keyword) {
                $query->whereRaw("concat(u.first_name, ' ', u.last_name) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('branch', function($query, $keyword) {
                $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
            })
            ->make(true);
        }

        $products = Product::withStockForDropdown($branchId)->get();
        $types = StockAdjustmentType::forDropdown()->get();
        $suppliers = Supplier::forDropdown(true)->get();
        $branches = Branch::forDropdown(true)->get();

        return view('stock-management/stock-adjustments', compact('products', 'types', 'suppliers', 'branches')); 
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

            $sa = new StockAdjustment;
            $sa->branch_id = $currentBranch->id;
            $sa->adjustment_date = \Carbon::parse($request->adjustmentDate);
            $sa->stock_adjustment_type_id = $request->type;

            if ($sa->stock_adjustment_type_id == StockAdjustmentTypeEnum::StockTransferSender || $sa->stock_adjustment_type_id == StockAdjustmentTypeEnum::StockTransferReceiver) {
                $sa->other_branch_id = $request->branch;
            }
            else if ($sa->stock_adjustment_type_id == StockAdjustmentTypeEnum::ReturnToSupplier) {
                $sa->supplier_id = $request->supplier;
            }

            $sa->created_by = $currentUserId;
            $sa->save();

            if (empty($sa->code)) {
                $sa->code = 'SA-' . sprintf('%02d', $sa->branch_id) . '-' . sprintf('%05d', $sa->id);
            }

            $sa->save();

            foreach ($request->products as $prod) {
                $sap = new StockAdjustmentProduct;
                $p = Product::find($prod['product']);

                $sap->created_by = $currentUserId;
                $sap->product_id = $prod['product'];
                $sap->uom = $prod['uom'];
                $sap->current_stock = $p->current_stock;
                $sap->qty = $prod['qty'];

                $p->current_stock += $sap->qty;
                $sap->updated_stock = $p->current_stock;

                $sap->batch_no = $prod['bn'];
                $sap->expiry_date = !empty($prod['expiryDate']) ? \Carbon::parse($prod['expiryDate']) : null;
                $sap->remarks = $prod['remarks'];
                $sa->products()->save($sap);

                $p->save();
            }
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'New adjustment has been created.']);
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
            $sa = StockAdjustment::with([
                'otherBranch:id,description',
                'supplier:id,name',
                'stockAdjustmentType:id,description',
                'products:id,stock_adjustment_id,product_id,current_stock,qty,updated_stock,uom,batch_no,expiry_date,remarks',
                'products.product:id,code,name',
                'creator:id,first_name,last_name'
                ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['adjustment' => $sa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
