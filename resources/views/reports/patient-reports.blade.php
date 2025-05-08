@extends('layouts.master')

@section('title', 'Patient Reports')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/reports/patient-reports.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Patient Reports</h1>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2 mb-3">
                <select id="reportType" class="form-select form-select-sm">
                    <option value="{{ route('patient-reports.detailed-patient-history') }}">Detailed Patient History</option>
                </select>
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
<script type="text/javascript" src="{{ mix('/assets/js/plugins/reports/patient-reports.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('patient-reports.index')}}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/reports/patient-reports.js') }}"></script>
@endsection