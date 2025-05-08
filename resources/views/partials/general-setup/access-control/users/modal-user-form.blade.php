<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="userFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="userFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="row">
                        <div class="col-md-2 order-md-2">
                            <input id="photo" type="file" accept="image/*" style="display:none;">
                            <div class="photo-container mb-2">
                                <img id="photoPreview" src="{{ asset('/assets/images/new-user.png') }}" class="w-100" alt="...">
                                <a href="javascript:;" id="removePhoto" class="remove-photo" style=""><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="btn-group btn-group-sm w-100">
                                <button id="photoCamera" type="button" class="btn btn-outline-primary">
                                    <i class="fa fa-camera"></i>
                                </button>
                                <button id="photoImage" type="button" class="btn btn-outline-primary">
                                    <i class="fa fa-image"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-10 order md-1">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Username</label>
                                        <div class="col-md-8">
                                            <input id="username" name="username" type="text"
                                                class="form-control form-control-sm" placeholder="Username" required />
                                        </div>
                                    </div>
                                </div>
                                <div id="passwordContainer" class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Password</label>
                                            
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                    <input id="password" name="password" type="password" class="form-control form-control-sm"
                                                        placeholder="Password" required minlength="6" data-parsley-errors-container="#password-error"/>
                                                        <button id="showPassword" type="button" class="btn btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                            </div>
                                            <div id="password-error"></div>
                                        </div>
                                        <div class="col-md-8">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Role</label>
                                        <div class="col-md-8">
                                            <select id="role" name="role" class="form-select form-select-sm" required
                                                data-parsley-errors-container="#role-error">
                                                <option value="" disabled selected></option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                                                @endforeach
                                            </select>
                                            <div id="role-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Status</label>
                                        <div class="col-md-8">
                                            <select id="status" name="status" class="form-select form-select-sm">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg-gray-600 opacity-2" />
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4 required">First
                                            Name</label>
                                        <div class="col-md-8">
                                            <input id="firstName" name="firstName" type="text"
                                                class="form-control form-control-sm" placeholder="First Name" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4 required">Last
                                            Name</label>
                                        <div class="col-md-8">
                                            <input id="lastName" name="lastName" type="text"
                                                class="form-control form-control-sm" placeholder="Last Name" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4">Nationality</label>
                                        <div class="col-md-8">
                                            <select id="nationality" name="nationality"
                                                class="form-select form-select-sm">
                                                <option value="" disabled selected></option>
                                                @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">{{ $nationality->description }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4">NRIC</label>
                                        <div class="col-md-8">
                                            <input id="nric" name="nric" type="text"
                                                class="form-control form-control-sm" placeholder="NRIC" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4"
                                            required>Mobile
                                            No.</label>
                                        <div class="col-md-8">
                                            <input id="mobileNo" name="mobileNo" type="text"
                                                class="form-control form-control-sm" placeholder="Mobile Number"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Email</label>
                                        <div class="col-md-8">
                                            <input id="email" name="email" type="email" class="form-control form-control-sm"
                                                placeholder="Email Address" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div id="branchContainer" class="row" style="display:none;">
                        <div class="col-md-12">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-1_14">Branches</label>
                                <div class="col-md-10_86">
                                    <select id="branch" name="branch" class="form-select form-select-sm" multiple="multiple">
                                        @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveUser" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>