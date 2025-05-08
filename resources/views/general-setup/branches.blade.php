@extends('layouts.master')

@section('title', 'Branches')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Branches</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addBranch" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New Branch
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="branchesTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th width="1%"></th>
                        <th>Branch ID</th>
                        <th>Branch Name</th>
                        <th>City</th>
                        <th>Tel. No.</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Branch ID</th>
                        <th>Branch Name</th>
                        <th>City</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
@include('partials.general-setup.branches.modal-branch-details')
@include('partials.general-setup.branches.modal-branch-form')
@endsection
@section('scripts')
<script type="text/javascript">
    var _url = '{{route('branches.index')}}',
        _id = 0;
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/branches.js') }}"></script>
@endsection