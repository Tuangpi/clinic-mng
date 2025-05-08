<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseOrderProductDelivery;
use Carbon\Carbon;

class PurchaseOrderProductController extends Controller
{
    public function show($orderId, $id)
    {
        try {
            $pop = PurchaseOrderProduct::with(['deliveries:id,purchase_order_product_id,delivery_date,dr_no,delivered_qty,pack_size,batch_no,expiry_date,remarks'])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['product' => $pop]);
    }

    public function update(Request $request, $orderId, $id)
    {
        try {
            
            \DB::beginTransaction();

            $po = PurchaseOrder::find($orderId);
            $pop = PurchaseOrderProduct::find($id);
            $changedQty = 0;

            if (!empty($request->deliveries)) {
                    
                $dIds = collect($request->deliveries)->pluck('id');
                $deletedDeliveries = $pop->deliveries()->whereNotIn('id', $dIds)->get();
                foreach ($deletedDeliveries as $deletedDelivery) {
                    $changedQty -= $deletedDelivery->delivered_qty;
                    $deletedDelivery->delete();
                }

                foreach ($request->deliveries as $delivery) {
                    $newDelivery = $delivery['id'] == '0';
                    $qty = $delivery['qty'];

                    if ($newDelivery) {
                        $del = new PurchaseOrderProductDelivery;
                        $del->created_by = \Auth::id();
                    }
                    else {
                        $del = PurchaseOrderProductDelivery::find($delivery['id']);
                        $qty -= $del->delivered_qty;
                    }

                    $changedQty += $qty;

                    $del->delivery_date = Carbon::parse($delivery['deliveryDate']);
                    $del->dr_no = $delivery['drNo'];
                    $del->delivered_qty = $delivery['qty'];
                    $del->pack_size = $delivery['ps'];
                    $del->batch_no = $delivery['bn'];
                    $del->expiry_date = !empty($delivery['expiryDate']) ? Carbon::parse($delivery['expiryDate']) : null;
                    $del->remarks = $delivery['remarks'];
                    $del->updated_by = \Auth::id();
                    $pop->deliveries()->save($del);
                }
            }
            else {
                $changedQty -= $pop->deliveries()->sum('delivered_qty');
                $pop->deliveries()->delete();
            }

            $pop->delivered_qty = $pop->deliveries()->sum('delivered_qty');
            $pop->pending_qty = $pop->qty - $pop->delivered_qty;
            if ($pop->pending_qty < 0) {
                \DB::rollBack();
                return response()->json(['errMsg'=> 'Unable to update delivery, delivered qty. exceeded the ordered qty.', 'isError'=> true]);
            }
            $pop->save();
            $pop->product->current_stock += $changedQty;
            $pop->product->save();

            $notCompleted = $po->products()->where('pending_qty', '>', 0)->exists();
            if (!$notCompleted && !$po->is_delivery_completed) {
                $po->is_delivery_completed = true;
                $po->save();
            }
            else if ($notCompleted && $po->is_delivery_completed) {
                $po->is_delivery_completed = false;
                $po->save();
            }

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Delivery has been updated.']);
    }
}
