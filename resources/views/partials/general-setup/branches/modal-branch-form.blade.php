<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="branchFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="branchFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="branchForm">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Branch
                                    ID</label>
                                <div class="col-md-8">
                                    <input id="branchId" name="branchId" type="text"
                                        class="form-control form-control-sm" placeholder="Branch ID" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2 required">Branch
                                    Name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control form-control-sm"
                                        placeholder="Branch Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2">Print Header</label>
                                <div class="col-md-10">
                                    <input id="printHeader" name="printHeader" type="text"
                                        class="form-control form-control-sm" placeholder="Print Header" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Telephone
                                    Number</label>
                                <div class="col-md-8">
                                    <input id="telNo" name="telNo" type="text" class="form-control form-control-sm"
                                        placeholder="Telephone Number" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3">CO. Reg. No.</label>
                                <div class="col-md-9">
                                    <input id="coRegNo" name="coRegNo" type="text" class="form-control form-control-sm"
                                        placeholder="CO. Reg. No." />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-1 required">Address</label>
                                <div class="col-md-10 ms-md-4_1rem">
                                    <input id="address" name="address" type="text" class="form-control form-control-sm"
                                        placeholder="Address" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4 required">State/Region</label>
                                <div class="col-md-8">
                                    <select id="state" name="state" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#state-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="state-error"></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3">City</label>
                                <div class="col-md-9">
                                    <select id="city" name="city" class="form-select form-select-sm"
                                        data-parsley-errors-container="#city-error">
                                        <option value="" disabled selected></option>

                                    </select>
                                    <div id="city-error"></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Postal/Zip Code</label>
                                <div class="col-md-8">
                                    <input id="zipCode" name="zipCode" type="text"
                                        class="form-control form-control-sm" placeholder="Postal/Zip Code" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Status</label>
                                <div class="col-md-9">
                                    <select id="status" name="status" class="form-select form-select-sm">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Currency
                                    Symbol</label>
                                <div class="col-md-8">
                                    <input id="currencySymbol" name="currencySymbol" type="text"
                                        class="form-control form-control-sm" placeholder="Currency Symbol" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveBranch" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
