@extends('layouts.master')

@section('title', 'Purchase Orders')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/stock-management/purchase-orders.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Purchase Orders</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addOrder" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Order
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="ordersTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th>Order No.</th>
                        <th>Order Date</th>
                        <th>PO No.</th>
                        <th>Supplier</th>
                        <th>No. of items</th>
                        <th>Total Amount</th>
                        <th>Invoice No.</th>
                        <th>Payment Status</th>
                        <th>Del. Status</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Order No.</th>
                        <th>Order Date</th>
                        <th>PO No.</th>
                        <th>Supplier</th>
                        <th>No. of items</th>
                        <th>Total Amount</th>
                        <th>Invoice No.</th>
                        <th>Payment Status</th>
                        <th>Del. Status</th>
                        <th>Branch</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.stock-management.purchase-orders.modal-order-attachments')
@include('partials.stock-management.purchase-orders.modal-order-delivery')
@include('partials.stock-management.purchase-orders.modal-order-details')
@include('partials.stock-management.purchase-orders.modal-order-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/stock-management/purchase-orders.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('purchase-orders.index')}}',
        _id = 0,
        _popId = 0,
        _currencySymbol,
        _products = {!! $products->toJson() !!},
        _paymentOptions = {!! $paymentOptions->toJson() !!};

</script>
<script type="text/javascript" src="{{ mix('/assets/js/stock-management/purchase-orders.js') }}"></script>
@endsection