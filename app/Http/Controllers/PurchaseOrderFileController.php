<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderFile;

use DataTables;

class PurchaseOrderFileController extends Controller
{
    public function index(Request $request, $orderId)
    {
        if ($request->ajax()) {
            $data = PurchaseOrderFile::byOrder($orderId);

            return Datatables::of($data)
                ->filterColumn('created_by', function ($query, $keyword) {
                    $query->whereRaw("concat(c.first_name, ' ', c.last_name) like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
    }

    public function destroy($orderId, $id)
    {
        $pof = PurchaseOrderFile::find($id);
        $pof->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function download($orderId, $name)
    {
        $file = PurchaseOrderFile::where([
            ['purchase_order_id', $orderId],
            ['name', $name]
        ])->first();
        return \Storage::download('purchase-order-files/' . $name, $file->original_name);
    }

    public function upload(Request $request, $orderId)
    {
        foreach ($request->file as $file) {
            $name = $file->store('purchase-order-files');

            $pof = new PurchaseOrderFile;
            $pof->purchase_order_id = $orderId;
            $pof->created_by = \Auth::id();
            $pof->size = $file->getSize();
            $pof->original_name = $file->getClientOriginalName();
            $pof->name = basename($name);

            $pof->save();
        }

        return response()->json(['success' => 'true']);
    }
}
