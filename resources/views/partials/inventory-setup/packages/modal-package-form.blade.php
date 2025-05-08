<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="packageFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="packageFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="packageForm">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Package
                                    ID</label>
                                <div class="col-md-8">
                                    <input id="packageId" name="packageId" type="text"
                                        class="form-control form-control-sm" placeholder="[Auto-Generate]" disabled
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Package
                                    Code</label>
                                <div class="col-md-8">
                                    <input id="code" name="code" type="text" class="form-control form-control-sm"
                                        placeholder="Package Code" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2 required">Package
                                    Name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control form-control-sm"
                                        placeholder="Package Name" required />
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
                                    <select id="category" name="category" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#category-error">
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
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Selling
                                    Price</label>
                                <div class="col-md-8">
                                    <input id="sellingPrice" name="sellingPrice" type="text"
                                        class="form-control form-control-sm" placeholder="Selling price" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Cost
                                    Price</label>
                                <div class="col-md-8">
                                    <input id="costPrice" name="costPrice" type="text"
                                        class="form-control form-control-sm" placeholder="[Auto-Computed]" disabled
                                        readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">No. of
                                    sessions</label>
                                <div class="col-md-8">
                                    <input id="sessionCount" name="sessionCount" type="text"
                                        class="form-control form-control-sm" placeholder="No. of sessions" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <button type="button" id="addItem" class='btn btn-primary mb-2'>
                        Add Item
                    </button>
                    <div class="table-responsive">
                        <table id="itemsTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-silver">
                                    <th width="1%"></th>
                                    <th>Item</th>
                                    <th width="15%">Qty <i class="fa-solid fa-circle-exclamation"
                                            data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="* The quantity of all items that will be deducted are per SESSION<br/>
                                            * All items included in this package are automatically deducted whenever a session is used"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="savePackage" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>