@extends('layouts.master')

@section('title', 'Suppliers')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Suppliers</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addSupplier" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Supplier
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="suppliersTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Contact Person</th>
                        <th>City</th>
                        <th>Mobile No.</th>
                        <th>Tel. No.</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Contact Person</th>
                        <th>City</th>
                        <th>Mobile No.</th>
                        <th>Tel. No.</th>
                        <th>Email</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.inventory-setup.suppliers.modal-supplier-details')
@include('partials.inventory-setup.suppliers.modal-supplier-form')
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('suppliers.index')}}',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/inventory-setup/suppliers.js') }}"></script>
@endsection