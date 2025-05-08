@extends('layouts.master')

@section('title', 'Appointment')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/appointments.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row no-print">
    <div class="col">
        <h1 class="page-header">Appointment</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addAppointment" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create Appointment
        </button>
    </div>
</div>
<div class="panel no-print">
    <div class="panel-body">

        <div class="row fs-11px no-print">
            <div class="col">
                <div class="btn-group">
                    <button class="btn btn-white btn-sm dropdown-toggle me-1" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        All Categories
                        <b class="caret ms-lg-2"></b>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item category-filter" href="javascript:;">
                                <i class="fa fa-square" style="color: #{{ $category->hex_color }}"></i>
                                {{ $category->description}} {{$currentBranch == null ? '(' . $category->branch . ')' :
                                ''}}
                                <i id="cf{{ $category->id }}" class="fa fa-check float-end mt-1"></i>
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="allCategoryLink" class="dropdown-item category-filter" href="javascript:;">All
                                Categories<i id="cf" class="fa fa-check float-end mt-1"></i></a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Status
                        <b class="caret ms-lg-2"></b>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($statuses as $status)
                        <li>
                            <a class="dropdown-item status-filter" href="javascript:;">
                                <i class="fa fa-square" style="color: #{{ $status->hex_color }}"></i>
                                {{ $status->description}}
                                <i id="sf{{ $status->id }}" class="fa fa-check float-end mt-1"></i>
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="allStatusLink" class="dropdown-item status-filter" href="javascript:;">All Statuses<i
                                    id="sf" class="fa fa-check float-end mt-1"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col text-end">
                <div class="btn-group">
                    <button class="btn btn-white btn-sm dropdown-toggle me-1" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-print"></i>
                        <b class="caret ms-lg-2"></b>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a id="printTable" class="dropdown-item" href="javascript:;">
                                Table
                            </a>
                        </li>
                        <li>
                            <a id="printList" class="dropdown-item" href="javascript:;">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
                <button id="refreshAppointment" class="btn btn-white btn-sm">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div id='calendar'></div>
    </div>
    <div class="col-md-3 no-print">
        <div class="row mb-5">
            <div class="col">
                <h2 class="text-center">Quick Navigation</h2>
                <div id="appointmentNavigator" class="bg-white p-3">
                    <div></div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <h5 class="text-center">Quick Navigation (<span class="text-green">Week</span>)</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">1</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">2</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">3</a></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">4</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">5</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-week btn btn-dark-blue d-block">6</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h5 class="text-center">Quick Navigation (<span class="text-green">Month</span>)</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">1</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">2</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">3</a></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">4</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">5</a></div>
                    <div class="col-md-4"><a  href="javascript:;" class="qn-month btn btn-dark-blue d-block">6</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="appointmentsTablePrint" width="100%" class="table table-bordered table-striped hide">
    <thead>
        <tr>
            <th colspan="6" class="text-center" id="appointmentsTablePrintTitle"></th>
        </tr>
        <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Patient</th>
            <th>Guest</th>
            <th>Category</th>
            <th>Branch</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
@endsection

@section('modals')
@include('partials.appointment.modal-appointment-search')
@include('partials.appointment.modal-appointment-details')
@include('partials.appointment.modal-appointment-form')
@endsection

@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/appointments.js') }}"></script>
@endsection
@section('scripts')

<script type="text/javascript">
    var _url = '{{route('appointment.index')}}',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/appointments.js') }}"></script>
@endsection