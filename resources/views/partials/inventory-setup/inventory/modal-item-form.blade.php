<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="itemFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="itemFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="itemForm">
                    <div class="row">
                        <div class="col-md-3 order-md-2">
                            <input id="photo" type="file" accept="image/*" style="display:none;">
                            <div class="photo-container mb-2">
                                <img id="photoPreview" src="{{ asset('/assets/images/image-regular.svg') }}"
                                    class="w-100" alt="...">
                                <a href="javascript:;" id="removePhoto" class="remove-photo" style=""><i
                                        class="fa fa-trash"></i></a>
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
                        <div class="col-md-9 order-md-1">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4">Item
                                            ID</label>
                                        <div class="col-md-8">
                                            <input id="itemId" name="itemId" type="text"
                                                class="form-control form-control-sm" placeholder="[Auto-Generate]"
                                                disabled readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Item Code</label>
                                        <div class="col-md-8">
                                            <input id="code" name="code" type="text"
                                                class="form-control form-control-sm" placeholder="Item Code" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-2 required">Item
                                            Name</label>
                                        <div class="col-md-10">
                                            <input id="name" name="name" type="text"
                                                class="form-control form-control-sm" placeholder="Item Name" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Type</label>
                                        <div class="col-md-8">
                                            <select id="type" name="type" class="form-select form-select-sm" required
                                                data-parsley-errors-container="#type-error">
                                                <option value="" disabled selected></option>
                                                @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                                                @endforeach
                                            </select>
                                            <div id="type-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Category</label>
                                        <div class="col-md-8">
                                            <select id="category" name="category" class="form-select form-select-sm"
                                                required data-parsley-errors-container="#category-error">
                                                <option value="" disabled selected></option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->description }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div id="category-error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">UOM</label>
                                        <div class="col-md-8">
                                            <select id="uom" name="uom" class="form-select form-select-sm" required
                                                data-parsley-errors-container="#uom-error">
                                                <option value="" disabled selected></option>
                                                @foreach ($uoms as $uom)
                                                <option value="{{ $uom->id }}">{{ $uom->description }}</option>
                                                @endforeach
                                            </select>
                                            <div id="uom-error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-2">Description</label>
                                        <div class="col-md-10">
                                            <textarea id="description" name="description" type="text"
                                                class="form-control form-control-sm"
                                                placeholder="Enter description here..." rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4">Has Dosage</label>
                                <div class="col-md-8">
                                    <input class="form-check-input mt-2" type="checkbox" id="hasDosage" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dosageContainer" style="display: none;">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="form-label col-form-label col-form-label-sm col-md-4">Usage</label>
                                    <div class="col-md-8">
                                        <select id="usage" name="usage" class="form-select form-select-sm dosage-fields">
                                            <option value="" disabled selected></option>
                                            @foreach ($usages as $usage)
                                            <option value="{{ $usage->id }}">{{ $usage->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="form-label col-form-label col-form-label-sm col-md-4">Dosage</label>
                                    <div class="col-md-8">
                                        <select id="dosage" name="dosage" class="form-select form-select-sm dosage-fields">
                                            <option value="" disabled selected></option>
                                            @foreach ($dosages as $dosage)
                                            <option value="{{ $dosage->id }}">{{ $dosage->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="form-label col-form-label col-form-label-sm col-md-4">Unit</label>
                                    <div class="col-md-8">
                                        <select id="unit" name="unit" class="form-select form-select-sm dosage-fields">
                                            <option value="" disabled selected></option>
                                            @foreach ($uoms as $uom)
                                            <option value="{{ $uom->id }}">{{ $uom->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="row">
                                    <label
                                        class="form-label col-form-label col-form-label-sm col-md-2">Frequency</label>
                                    <div class="col-md-10">
                                        <select id="frequency" name="frequency" class="form-select form-select-sm dosage-fields">
                                            <option value="" disabled selected></option>
                                            @foreach ($frequencies as $frequency)
                                            <option value="{{ $frequency->id }}">{{ $frequency->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="form-label col-form-label col-form-label-sm col-md-4">Tot. Dosage</label>
                                    <div class="col-md-8">
                                        <input id="totalDosage" name="totalDosage" type="text"
                                            class="form-control form-control-sm dosage-fields" placeholder="0.00"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3 required">Selling
                                    Price</label>
                                <div class="col-md-9">
                                    <input id="sellingPrice" name="sellingPrice" type="text"
                                        class="form-control form-control-sm" placeholder="Selling price" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3 required">Cost
                                    Price</label>
                                <div class="col-md-9">
                                    <input id="costPrice" name="costPrice" type="text"
                                        class="form-control form-control-sm" placeholder="Cost price" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Supplier</label>
                                <div class="col-md-9">
                                    <select id="supplier" name="supplier" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#supplier-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="supplier-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Manufacturer</label>
                                <div class="col-md-9">
                                    <select id="manufacturer" name="manufacturer" class="form-select form-select-sm"
                                        required data-parsley-errors-container="#manufacturer-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div id="manufacturer-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Critical Level</label>
                                <div class="col-md-9">
                                    <input id="criticalLevel" name="criticalLevel" type="text"
                                        class="form-control form-control-sm" placeholder="Critical Level" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="unlimitedStock" />
                                        <label class="form-check-label" for="unlimitedStock">Unlimited Stock</label>
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
                    <button type="button" id="saveItem" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>