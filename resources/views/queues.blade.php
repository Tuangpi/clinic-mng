@extends('layouts.master')

@section('title', 'All Patients')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/queue.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="row no-print">
    <div class="col-md-2 text-sm-center">
        <h1 class="page-header">Queue</h1>
    </div>
    <div class="col text-center">
        <h1 class="page-header">
            <span id="currentDate">{{ Carbon\Carbon::now()->format('F d, Y') }}</span>
            <i class="fa fa-square fs-7px align-middle mx-2"></i>
            <span id="currentTime">{{ Carbon\Carbon::now()->format('h:i A') }}</span>
        </h1>
    </div>
    <div class="col-md-2 text-lg-end text-sm-center mb-3">
        <button type="button" id="addQueue" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Add Queue
        </button>
    </div>
</div>
<div class="panel no-print">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="queuesTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th width="1%"></th>
                        <th>Queue ID</th>
                        <th>Patient</th>
                        <th>Appt.</th>
                        <th width="100px">Time In</th>
                        <th width="100px">Time Out</th>
                        <th>Notes</th>
                        <th width="100px">Total Amount</th>
                        <th width="100px">Paid Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Queue ID</th>
                        <th>Patient</th>
                        <th>Appt.</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Notes</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.patients.label-print')
@include('partials.queue.modal-unknown-item-form')
@include('partials.queue.item-label-print')
@include('partials.queue.modal-item-label')
@include('partials.queue.invoice-print')
@include('partials.queue.modal-outside-prescription')
@include('partials.queue.modal-session-balance')
@include('partials.queue.modal-item-search')
@include('partials.queue.modal-transaction')
@include('partials.queue.modal-notes')
@include('partials.queue.modal-time-picker')
@include('partials.queue.modal-queue-form')
@endsection

@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/queue.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('queue.index')}}',
    _defaultPhotoSrc = 'assets/images/new-user.png',
    _id,
    _outsidePrescriptionId,
    _isDraft,
    _currencySymbol,
    _statuses = {!! $statuses->toJson() !!},
    _productTypes = {!! $productTypes->toJson() !!},
    _productCategories = {!! $productCategories->toJson() !!},
    _paymentOptions = {!! $paymentOptions->toJson() !!},
    _defaultDate = '{{ $defaultDate ? $defaultDate : '' }}',
    _defaultId = '{{ $defaultId ? $defaultId : '' }}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/queue.js') }}"></script>
@endsection