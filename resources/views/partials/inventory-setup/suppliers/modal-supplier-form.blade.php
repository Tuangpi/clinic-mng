<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="supplierFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="supplierFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="supplierForm">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Supplier
                                    ID</label>
                                <div class="col-md-8">
                                    <input id="supplierId" name="supplierId" type="text"
                                        class="form-control form-control-sm" placeholder="[Auto-Generate]" disabled
                                        readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2 required">Supplier
                                    Name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control form-control-sm"
                                        placeholder="Supplier Name" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2">Contact Person</label>
                                <div class="col-md-10">
                                    <input id="contactPerson" name="contactPerson" type="text" class="form-control form-control-sm"
                                        placeholder="Contact Person"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2">Description</label>
                                <div class="col-md-10">
                                    <textarea id="description" name="description" type="text"
                                        class="form-control form-control-sm" placeholder="Enter description here..."
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-12">
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
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4 required">State/Region</label>
                                <div class="col-md-8">
                                    <select id="state" name="state" class="form-select form-select-sm" required data-parsley-errors-container="#state-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="state-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4 required">City</label>
                                <div class="col-md-8">
                                    <select id="city" name="city" class="form-select form-select-sm" required data-parsley-errors-container="#city-error">
                                        <option value="" disabled selected></option>
                                      
                                    </select>
                                    <div id="city-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Postal/Zip
                                    Code</label>
                                <div class="col-md-8">
                                    <input id="zipCode" name="zipCode" type="text" class="form-control form-control-sm"
                                        placeholder="Postal/Zip Code" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Email
                                    Address</label>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" class="form-control form-control-sm"
                                        placeholder="Email Address" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required"
                                    required>Mobile
                                    Number</label>
                                <div class="col-md-8">
                                    <input id="mobileNo" name="mobileNo" type="text"
                                        class="form-control form-control-sm" placeholder="Mobile Number" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Telephone Number</label>
                                <div class="col-md-8">
                                    <input id="telNo" name="telNo" type="text" class="form-control form-control-sm"
                                        placeholder="Telephone Number" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-1">Notes</label>
                                <div class="col-md-10 ms-md-4_1rem">
                                    <textarea id="notes" name="notes" type="text" class="form-control form-control-sm"
                                        placeholder="Enter notes here..." rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="isSupplier" />
                                        <label class="form-check-label" for="isSupplier">Supplier</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="isManufacturer" />
                                        <label class="form-check-label" for="isManufacturer">Manufacturer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveSupplier" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>