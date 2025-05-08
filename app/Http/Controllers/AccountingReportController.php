<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Patient;
use App\Models\Queue;
use App\Models\QueueTransaction;
use App\Models\IncompleteTransaction;
use App\Models\ViewTransactionSummary;
use App\Models\ViewTransactionSummaryWithoutExcludedPaymentModes;
use App\Models\ViewTransactionSummaryPaymentMode;
use App\Models\ViewTransactionSummaryPaymentModeWithoutExcluded;

use DataTables;
class AccountingReportController extends Controller
{
    public function index()
    {
        $patients = Patient::forDropdown()->get();
        return view('reports.accounting-reports', compact('patients')); 
    }

    public function transactionSummary(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.accounting-reports.transaction-summary', compact('startDate', 'endDate', 'branch')); 
    }

    public function transactionSummaryData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        if ($request->showExcludedPaymentMode) {
            $data = ViewTransactionSummary::active($branchId, $request->startDate, $request->endDate, $request->patient);
        } else {
            $data = ViewTransactionSummaryWithoutExcludedPaymentModes::active($branchId, $request->startDate, $request->endDate, $request->patient);
        }
        
        return Datatables::of($data)
        ->make(true);
    }

    public function voidedTransactionData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = $request->includeVoidedTransaction ? Queue::voidedTransactionReport($branchId, $request->startDate, $request->endDate, $request->patient) : [];
        return Datatables::of($data)
        ->make(true);
    }

    public function transactionSummaryPaymentModeData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        if ($request->showExcludedPaymentMode) {
            $data = ViewTransactionSummaryPaymentMode::active($branchId, $request->startDate, $request->endDate, $request->patient);
        } else {
            $data = ViewTransactionSummaryPaymentModeWithoutExcluded::active($branchId, $request->startDate, $request->endDate, $request->patient);
        }

        return Datatables::of($data)
        ->make(true);
    }

    public function owingTransaction(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.accounting-reports.owing-transaction', compact('startDate', 'endDate', 'branch')); 
    }

    public function owingTransactionData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;

        $data = IncompleteTransaction::owingTransactionReport($branchId, $request->startDate, $request->endDate, $request->patient);
        
        return Datatables::of($data)
        ->make(true);
    }

    public function detailedBillingSummary(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.accounting-reports.detailed-billing-summary', compact('startDate', 'endDate', 'branch')); 
    }

    public function detailedBillingSummaryData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;

        $data = QueueTransaction::detailedBillingSummaryReport($branchId, $request->startDate, $request->endDate, $request->patient);
        
        return Datatables::of($data)
        ->make(true);
    }
}
