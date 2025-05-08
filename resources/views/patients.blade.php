@extends('layouts.master')

@section('title', 'All Patients')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/patients.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">All Patients</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addPatient" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Patient
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="patientsTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th width="1%"></th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>City</th>
                        <th>Mobile Number</th>
                        <th>Birth Date</th>
                        <th>Available Credits</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>City</th>
                        <th>Mobile Number</th>
                        <th>Available Credits</th>
                        <th>Branch</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.patients.label-print')
@include('partials.patients.modal-patient-form')
@include('partials.patients.modal-patient-details')
@include('partials.modal-camera')
@include('partials.patients.patient-details.modal-case-note-details')
@include('partials.patients.patient-details.modal-case-note-attachments')
@include('partials.patients.patient-details.modal-credits')
@endsection

@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/patients.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('patients.index')}}',
        _id = 0,
        _caseNoteId = 0,
        _defaultPhotoSrc = 'assets/images/new-user.png',
        _currentUserPhoto = '{{ \Auth::user()->photoUrl }}';
        _currentUserFullName = '{{ \Auth::user()->full_name }}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/patients.js') }}"></script>
@endsection