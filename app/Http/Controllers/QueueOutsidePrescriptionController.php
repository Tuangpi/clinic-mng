<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Queue;
use App\Models\QueueOutsidePrescription;
use App\Models\QueueOutsidePrescriptionMedicine;
use DataTables;

class QueueOutsidePrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $queueId)
    {
        if ($request->ajax()) {
            $data = QueueOutsidePrescription::byQueue($queueId);

            return Datatables::of($data)
                ->filterColumn('created_by', function ($query, $keyword) {
                    $query->whereRaw("concat(c.first_name, ' ', c.last_name) like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('case_type', function ($query, $keyword) {
                    $query->whereRaw("t.description like ?", ["%{$keyword}%"]);
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
    public function store(Request $request, $queueId)
    {
        try {

            \DB::beginTransaction();

            $op = new QueueOutsidePrescription;
            $op->queue_id = $queueId;
            $op->created_by = \Auth::id();
            $op->updated_by = \Auth::id();
            $this->mapValues($op, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New outside prescription has been created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($queueId, $id)
    {
        try {
            $qop = QueueOutsidePrescription::find($id);
            $medicines = QueueOutsidePrescriptionMedicine::where('queue_outside_prescription_id', $id)->select('id', 'description', 'dosage', 'remarks')->get();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['medicines' => $medicines, 'is_draft' => $qop->is_draft]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $queueId, $id)
    {
        try {

            \DB::beginTransaction();

            $qop = QueueOutsidePrescription::find($id);
            $qop->updated_by = \Auth::id();
            $this->mapValues($qop, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Case note has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($queueId, $id)
    {
        $qop = QueueOutsidePrescription::find($id);
        $qop->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function revert($queueId, $id)
    {
        $qop = QueueOutsidePrescription::withTrashed()->find($id);
        $qop->restore();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function print($queueId, $id)
    {
        $qop = QueueOutsidePrescription::find($id);
        $medicines = QueueOutsidePrescriptionMedicine::where('queue_outside_prescription_id', $id)->select('id', 'description', 'dosage', 'remarks')->get();
        $q = Queue::find($queueId);
        $branch = $q->branch;
        $patient = $q->patient;

        return response()->json([
            'branchName' => $branch->description,
            'branchAddress' => $branch->address,
            'patientName' => $patient->fullName,
            'patientId' => $patient->code,
            'patientAddress' => $patient->address . ', ' . $patient->city->description . ', ' . $patient->city->state->description,
            'prescriptionDate' => $qop->created_at,
            'prescriptionNo' => $qop->id,
            'queueId' => $q->code,
            'medicines' => $medicines
        ]);
    }

    private function mapValues($op, $request)
    {
        $op->is_draft = $request->isDraft;

        $op->save();

        $op->save();

        if (!empty($request->medicines)) {

            $mIds = collect($request->medicines)->pluck('id');
            $op->medicines()->whereNotIn('id', $mIds)->forceDelete();

            foreach ($request->medicines as $medicine) {
                $newMedicine = $medicine['id'] == '0';

                if ($newMedicine) {
                    $m = new QueueOutsidePrescriptionMedicine;
                    $m->queue_outside_prescription_id = $op->id;
                    $m->created_by = \Auth::id();
                } else {
                    $m = QueueOutsidePrescriptionMedicine::find($medicine['id']);
                }

                $m->description = $medicine['description'];
                $m->dosage = $medicine['dosage'];
                $m->remarks = $medicine['remarks'];
                $m->updated_by = \Auth::id();
                $m->save();
            }
        } else {
            $op->medicines()->forceDelete();
        }
    }
}
