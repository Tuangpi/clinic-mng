@extends('layouts.master')

@section('title', 'Stock Adjustments')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/stock-management/stock-adjustments.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Stock Adjustments</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addAdjustment" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Adjustment
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="adjustmentsTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>Adjustment ID</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Adjustment ID</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>Branch</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.stock-management.stock-adjustments.modal-adjustment-details')
@include('partials.stock-management.stock-adjustments.modal-adjustment-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/stock-management/stock-adjustments.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('stock-adjustments.index')}}',
        _id = 0,
        _products = {!! $products->toJson() !!};
        
</script>
<script type="text/javascript" src="{{ mix('/assets/js/stock-management/stock-adjustments.js') }}"></script>
@endsection