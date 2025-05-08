<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientCredit;
use App\Models\ViewCreditTransaction;
use App\Models\PatientAvailableCredit;
use DataTables;
class PatientCreditController extends Controller
{
    
    public function index(Request $request, $patientId)
    {
        if ($request->ajax()) {
            $currentBranch = session('branch');
            $data = ViewCreditTransaction::active($patientId, $currentBranch->id);
                
            return Datatables::of($data)
            ->make(true);
        }
    }

    public function store(Request $request, $patientId)
    {
        try {

            \DB::beginTransaction();

            $currentBranch = session('branch');
            $currentUserId = \Auth::id();
            
            $c = new PatientCredit;
            $c->branch_id = $currentBranch->id;
            $c->patient_id = $patientId;
            $c->created_by = $currentUserId;
            $c->updated_by = $currentUserId;
            $this->mapValues($c, $request);

            $ac = PatientAvailableCredit::where([
                ['patient_id', $patientId],
                ['branch_id', $currentBranch->id],
            ])->first();

            if (!$ac) {
                $ac = new PatientAvailableCredit;
                $ac->patient_id = $patientId;
                $ac->branch_id = $currentBranch->id;
                $ac->created_by = $currentUserId;
            }

            $ac->updated_by = $currentUserId;
            $ac->amount += $c->amount;
            $ac->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'New credit has been created.']);
    }

    public function destroy($patientId, $id)
    {
        $c = PatientCredit::find($id);

        $ac = PatientAvailableCredit::where([
            ['patient_id', $patientId],
            ['branch_id', $c->branch_id],
        ])->first();

        $ac->amount -= $c->amount;

        if ($ac->amount < 0) {
            return response()->json(['errMsg'=> 'Unable to delete credit, insufficient credit.', 'isError'=> true]);
        }
        else {
            $ac->save();
            $currentUserId = \Auth::id();
            
            $nc = new PatientCredit;
            $nc->branch_id = $c->branch_id;
            $nc->patient_id = $c->patient_id;
            $nc->credit_date = \Carbon::now();
            $nc->amount = $c->amount * -1;
            $nc->remarks = 'Delete ' . $c->code;
            $nc->created_by = $currentUserId;
            $nc->updated_by = $currentUserId;

            $nc->save();
            $nc->code = 'CR-' . sprintf('%02d', $nc->branch_id) . '-' . sprintf('%05d', $nc->id);
            $nc->save();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false]);
    }

    private function mapValues($c, $request)
    {
        $c->credit_date = \Carbon::parse($request->date);
        $c->amount = $request->amount;
        $c->remarks = $request->remarks;

        $c->save();
        
        if (empty($c->code)) {
            $c->code = 'CR-' . sprintf('%02d', $c->branch_id) . '-' . sprintf('%05d', $c->id);
        }

        $c->save();
    }
}
