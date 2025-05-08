@extends('layouts.master')

@section('title', 'Inventory Reports')

@section('pre-styles')
<link href="{{ mix('/assets/css/plugins/reports/inventory-reports.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Inventory Reports</h1>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2 mb-3">
                <select id="reportType" class="form-select form-select-sm">
                    <option value="{{ route('inventory-reports.purchase-delivery') }}">Purchase Delivery</option>
                    <option value="{{ route('inventory-reports.item-dispensed') }}">Item Dispensed</option>
                    <option value="{{ route('inventory-reports.stock-adjustment') }}">Stock Adjustment</option>
                    <option value="{{ route('inventory-reports.drug-usage-product') }}">Drug Usage (Product)</option>
                    <option value="{{ route('inventory-reports.drug-usage-package') }}">Drug Usage (Package)</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3">
                <div id="drFilter" class="btn btn-white d-flex text-start align-items-center">
                    <span class="flex-1"></span>
                    <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 mb-3 purchase-delivery-filter-container">
                <select id="supplierFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 mb-3 purchase-delivery-filter-container">
                <select id="deliveryStatusFilter" class="form-select form-select-sm">
                    <option value="">All Delivery Statuses</option>
                    <option value="0">On Process</option>
                    <option value="1">Completed</option>
                </select>
            </div>
            <div class="col-lg-9 mb-3 item-dispensed-filter-container stock-adjustment-filter-container">
                <select id="productFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{ $product->code }} - {{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-9 mb-3 item-dispensed-filter-container">
                <select id="categoryFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-9 mb-3 item-dispensed-filter-container">
                <select id="typeFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{ $type->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-9 mb-3 stock-adjustment-filter-container">
                <select id="adjustmentTypeFilter" class="form-select form-select-sm" multiple="true">
                    @foreach ($adjustmentTypes as $adjustmentType)
                    <option value="{{$adjustmentType->id}}">{{ $adjustmentType->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-9 mb-3 drug-usage-filter-container">
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
                <button type="button" id="print" class='btn btn-primary me-2'>
                    <i class="fa fa-print"></i>
                </button>
                <button type="button" id="detailedView" class='btn btn-white'>
                    <i class="fa fa-table-columns"></i>
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
<script type="text/javascript" src="{{ mix('/assets/js/plugins/reports/inventory-reports.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('inventory-reports.index')}}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/reports/inventory-reports.js') }}"></script>
@endsection