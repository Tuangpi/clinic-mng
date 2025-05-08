@php
$currentBranch = session('branch');
$currentBranchCurrencySymbol = $currentBranch ? $currentBranch->currency_symbol : '$';
@endphp

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="orderFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="orderFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="orderForm">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-5 required">Order
                                    Date</label>
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm date">
                                        <input id="orderDate" name="orderDate" type="text"
                                            class="form-control form-control-sm datepicker" placeholder="Select Date"
                                            required data-parsley-errors-container="#orderDate-error" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <div id="orderDate-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">PO No.</label>
                                <div class="col-md-8">
                                    <input id="poNo" name="poNo" type="text" class="form-control form-control-sm"
                                        placeholder="PO No." />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                    <th width="100px">UOM</th>
                                    <th width="100px">Unit Price</th>
                                    <th width="100px">Qty</th>
                                    <th width="100px">Total</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-end">Total</th>
                                    <th id="itemTotalAmount"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3">Discount</label>
                                <div class="col-md-9">
                                    <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <span id="discTypeDisplay">%</span>
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a id="discTypePercentage" href="javascript:;"
                                                class="dropdown-item disc-type active">%</a>
                                            <a id="discTypeAmount" href="javascript:;"
                                                class="dropdown-item disc-type">{{$currentBranchCurrencySymbol}}</a>
                                        </div>
                                        <input id="discount" type="text" class="form-control form-control-sm"
                                            value="0" />
                                    </div>
                                    <span id="discountAmountDisplay" class="ms-5 text-muted"
                                        style="display:none;"></span>
                                    <input id="discountAmount" type="hidden" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-2">Tax</label>
                                <div class="col-md-10">
                                    <select id="tax" name="tax" class="form-select form-select-sm">
                                        <option value="" disabled selected></option>
                                        @foreach ($taxes as $tax)
                                        <option value="{{ $tax->id }}" data-percentage="{{ $tax->percentage }}">{{
                                            $tax->code }} ({{ $tax->percentage }}%)</option>
                                        @endforeach
                                    </select>
                                    <span id="taxAmount" class="text-muted" style="display:none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Total Amt.</label>
                                <div class="col-md-8">
                                    <label
                                        class="form-label col-form-label col-form-label-sm">{{$currentBranchCurrencySymbol}}<span
                                            id="totalAmount">0.00</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveOrder" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>