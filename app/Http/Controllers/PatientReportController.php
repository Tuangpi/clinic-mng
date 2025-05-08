<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\QueueTransaction;

use DataTables;
class PatientReportController extends Controller
{
    public function index()
    {
        $patients = Patient::forDropdown()->get();
        return view('reports.patient-reports', compact('patients')); 
    }

    public function detailedPatientHistory(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        return view('partials.reports.patient-reports.detailed-patient-history', compact('branch')); 
    }

    public function detailedPatientHistoryData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;

        $data = QueueTransaction::detailedPatientHistoryReport($branchId, $request->patient);
        
        return Datatables::of($data)
        ->make(true);
    }
}
