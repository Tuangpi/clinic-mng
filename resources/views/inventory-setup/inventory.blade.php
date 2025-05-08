@extends('layouts.master')

@section('title', 'Inventory')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Inventory</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addItem" class='btn btn-primary dropdown-toggle' data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa fa-plus"></i>
            Create New Item
            <b class="caret ms-lg-2"></b>
        </button>
        <ul class="dropdown-menu">
            @foreach ($types as $type)
            <li>
                <a id="type{{$type->id}}" class="dropdown-item add-item-type" href="javascript:;">
                    {{ $type->description }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="itemsTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>UOM</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Selling Price</th>
                        <th>Cost Price</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>UOM</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Selling Price</th>
                        <th>Cost Price</th>
                        <th>Branch</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.modal-camera')
@include('partials.inventory-setup.inventory.modal-item-details')
@include('partials.inventory-setup.inventory.modal-item-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/inventory-setup/inventory.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('inventory.index')}}',
        _defaultPhotoSrc = '/assets/images/image-regular.svg',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/inventory-setup/inventory.js') }}"></script>
@endsection