<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentOption;
use DataTables;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $currentBranch = session('branch');
            $data = PaymentOption::active($currentBranch->id ?? null);

            return Datatables::of($data)
                ->filterColumn('branch', function ($query, $keyword) {
                    $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
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

            if ($request->description && PaymentOption::where([
                ['description', $request->description],
                ['branch_id', $currentBranch->id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Mode already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $po = new PaymentOption;
            $po->branch_id = $currentBranch->id;
            $po->created_by = $currentUserId;
            $po->updated_by = $currentUserId;

            $this->mapValues($po, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New Payment Mode has been created.']);
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
            $po = PaymentOption::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['paymentMode' => $po]);
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
            $currentBranch = session('branch');

            if ($request->description && PaymentOption::where([
                ['description', $request->description],
                ['branch_id', $currentBranch->id],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Mode already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $po = PaymentOption::find($id);
            $po->updated_by = \Auth::id();
            $this->mapValues($po, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Payment Mode has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po = PaymentOption::find($id);
        if (
            $po->queuePayments()->exists() ||
            $po->purchaseOrderPayments()->exists()
        ) {
            return response()->json(['errMsg' => 'Unable to delete, this payment mode is in use.', 'isError' => true]);
        }
        $po->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($po, $request)
    {
        $po->description = $request->description;
        $po->seq_no = $request->seqNo;
        $po->sales_report_excluded = $request->salesReportExcluded;
        $po->save();
    }
}
