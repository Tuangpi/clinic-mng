@extends('layouts.master')

@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Users</h1>
    </div>
    <div class="col text-end">
        <button type="button" id="addUser" class='btn btn-primary'>
            <i class="fa fa-plus"></i>
            Create New User
        </button>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <table id="usersTable" class="table table-bordered table-striped table-hover w-100">
            <thead>
                <tr>
                    <th width="1%"></th>
                    <th width="1%"></th>
                    <th>User Id</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>User Id</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('modals')
@include('partials.modal-camera')
@include('partials.general-setup.users.modal-user-details')
@include('partials.general-setup.users.modal-user-form')
@endsection

@section('scripts')
<script type="text/javascript">
    var _url = '{{route('users.index')}}',
        _id = 0,
        _defaultPhotoSrc = '{{ asset('assets/images/new-user.png') }}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/users.js') }}"></script>
@endsection