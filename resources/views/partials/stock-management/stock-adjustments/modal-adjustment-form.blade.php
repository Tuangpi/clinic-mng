<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="adjustmentFormModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="adjustmentFormModalTitle" class="modal-title">Create New Adjustment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="adjustmentForm">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required">Adjustment
                                    Date</label>
                                <div class="col-md-8">
                                    <div class="input-group input-group-sm date">
                                        <input id="adjustmentDate" name="adjustmentDate" type="text"
                                            class="form-control form-control-sm datepicker" placeholder="Select Date"
                                            required data-parsley-errors-container="#adjustmentDate-error" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <div id="adjustmentDate-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Type</label>
                                <div class="col-md-9">
                                    <select id="type" name="type" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#type-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="type-error"></div>
                                    <small id="qtyDescription" class="text-primary"></small>
                                </div>
                            </div>
                        </div>
                        <div id="branchContainer" class="col-md-4" style="display:none;">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Branch</label>
                                <div class="col-md-9">
                                    <select id="branch" name="branch" class="form-select form-select-sm"
                                        data-parsley-errors-container="#branch-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="branch-error"></div>
                                </div>
                            </div>
                        </div>
                        <div id="supplierContainer" class="col-md-4" style="display:none;">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Supplier</label>
                                <div class="col-md-9">
                                    <select id="supplier" name="supplier" class="form-select form-select-sm"
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
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <button type="button" id="addItem" class='btn btn-primary mb-2'>
                        Add Item
                    </button>
                    <div class="table-responsive">
                        <table id="itemsTable" class="table table-adjustmented table-striped table-hover">
                            <thead>
                                <tr class="bg-silver">
                                    <th width="1%"></th>
                                    <th>Item</th>
                                    <th width="100px">UOM</th>
                                    <th width="150px">Qty <i class="fa-solid fa-circle-exclamation"
                                            data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="* Qty. can be positive or negative.<br/>
                                                            * For stock transfer (sender) and return to supplier type, qty. should be negative.<br/>
                                                            * For stock transfer (receiver), qty. should be positive."></i>
                                    </th>
                                    <th width="100px">Batch No. (Opt.)</th>
                                    <th width="150px">Expiry Date</th>
                                    <th width="20%">Remarks</th>
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
                    <button type="button" id="saveAdjustment" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>