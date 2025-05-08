@extends('layouts.master')

@section('title', 'Packages')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Packages</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addPackage" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Package
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="packagesTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th>Package ID</th>
                        <th>Package Name</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>No. of Sessions</th>
                        <th>Selling Price</th>
                        <th>Cost Price</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Package ID</th>
                        <th>Package Name</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>No. of Sessions</th>
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
@include('partials.inventory-setup.packages.modal-package-details')
@include('partials.inventory-setup.packages.modal-package-form')
@endsection
@section('pre-scripts')
<script type="text/javascript" src="{{ mix('/assets/js/plugins/inventory-setup/packages.js') }}"></script>
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('packages.index')}}',
        _id = 0,
        _defaultType = '{{config('app.package_default_type')}}',
        _defaultCategory = '{{config('app.package_default_category')}}',
        _products = {!! $products->toJson() !!};
</script>
<script type="text/javascript" src="{{ mix('/assets/js/inventory-setup/packages.js') }}"></script>
@endsection