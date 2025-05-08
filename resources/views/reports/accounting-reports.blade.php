@extends('layouts.master')

@section('title', 'Accounting Reports')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/reports/accounting-reports.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Accounting Reports</h1>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2 mb-3">
                <select id="reportType" class="form-select form-select-sm">
                    <option value="{{ route('accounting-reports.transaction-summary') }}">Transaction Summary</option>
                    <option value="{{ route('accounting-reports.owing-transaction') }}">Owing Transaction</option>
                    <option value="{{ route('accounting-reports.detailed-billing-summary') }}">Detailed Billing Summary</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3">
                <div id="drFilter" class="btn btn-white d-flex text-start align-items-center">
                    <span class="flex-1"></span>
                    <i class="fa fa-caret-down"></i>
                </div>
            </div>
            <div class="col-lg-2 mb-3 transaction-summary-filter-container">
                <div class="mt-1 form-check form-check-inline fs-6 text-black">
                    <input class="form-check-input" type="checkbox" id="includeVoidedTransaction" />
                    <label class="form-check-label" for="includeVoidedTransaction">Include Voided Transaction</label>
                </div>
            </div>
            <div class="col-lg-3 mb-3 transaction-summary-filter-container">
                <div class="mt-1 form-check form-check-inline fs-6 text-black">
                    <input class="form-check-input" type="checkbox" id="showExcludedPaymentMode" />
                    <label class="form-check-label" for="showExcludedPaymentMode">Show Excluded Payment Mode</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mb-3">
                <select id="patientFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($patients as $px)
                        <option value="{{$px->id}}">{{$px->code}} - {{ $px->first_name }} {{ $px->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <button type="button" id="clearFilter" class='btn btn-warning me-2'>
                    Clear Filter
                </button>
                <button type="button" id="generate" class='btn btn-primary me-2'>
                    Generate
                </button>
                <button type="button" id="print" class='btn btn-primary'>
                    <i class="fa fa-print"></i>
                </button>
            </div>
        </div>
        <div id="reportContainer"></div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/reports/accounting-reports.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('accounting-reports.index')}}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/reports/accounting-reports.js') }}"></script>
@endsection