@extends('layouts.master')

@section('title', 'Access Control')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Access Control</h1>
    </div>
</div>
<ul class="nav nav-tabs tab-blue">
    <li class="nav-item">
      <a href="#userAccounts" data-bs-toggle="tab" class="nav-link active">User Accounts</a>
    </li>
    <li class="nav-item">
      <a id="userRolesLink" href="#userRoles" data-bs-toggle="tab" class="nav-link">User Roles</a>
    </li>
  </ul>
  <div class="tab-content panel p-3 rounded-0 rounded-bottom">
    <div class="tab-pane fade active show" id="userAccounts">
      @include('partials.general-setup.access-control.users.users')
    </div>
    <div class="tab-pane fade" id="userRoles">
      @include('partials.general-setup.access-control.roles.roles')
    </div>
  </div>
@endsection

@section('modals')
@include('partials.modal-camera')
@include('partials.general-setup.access-control.roles.modal-role-form')
@include('partials.general-setup.access-control.users.modal-user-details')
@include('partials.general-setup.access-control.users.modal-user-form')
@endsection

@section('scripts')
<script type="text/javascript">
    var _userUrl = '{{route('users.index')}}',
        _roleUrl = '{{route('roles.index')}}',
        _id = 0,
        _defaultPhotoSrc = '{{ asset('assets/images/new-user.png') }}';
</script>
<script type="text/javascript" src="{{ mix('/assets/js/general-setup/access-control.js') }}"></script>
@endsection