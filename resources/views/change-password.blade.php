@extends('layouts.master')

@section('title', 'Change Password')

@section('pre-styles')
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1 class="page-header">Change Password</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-4 offset-md-3">
        <div class="panel">
            <div class="panel-body">
                <form id="changePasswordForm">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Current
                                    Password</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="currentPassword" name="currentPassword" type="password"
                                            class="form-control form-control-sm password" placeholder="Password" required
                                            data-parsley-errors-container="#currentPassword-error" />
                                        <button type="button" class="btn btn-primary show-password">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="currentPassword-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">New
                                    Password</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="newPassword" name="newPassword" type="password"
                                            class="form-control form-control-sm password" placeholder="New Password" required minlength="6"
                                            data-parsley-errors-container="#newPassword-error" />
                                        <button type="button" class="btn btn-primary show-password">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="newPassword-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Confirm
                                    Password</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="confirmPassword" name="confirmPassword" type="password"
                                            class="form-control form-control-sm password" placeholder="Confirm Password" required data-parsley-equalto="#newPassword" data-parsley-equalto-message="New password and confirm password does not match"
                                            data-parsley-errors-container="#confirmPassword-error" />
                                        <button type="button" class="btn btn-primary show-password">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="confirmPassword-error"></div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-gray-600 opacity-2" />
                        <div class="col-md-12 mb-2">
                            <button type="button" id="savePassword" class="btn btn-primary float-end">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/assets/js/change-password.js') }}"></script>
@endsection