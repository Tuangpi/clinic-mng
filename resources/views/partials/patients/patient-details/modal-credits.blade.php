<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="creditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Credits</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">
                <form id="creditForm">
                    <div class="row mb-2">
                        <div id="addCreditContainer" class="col">
                            <button type="button" id="addCredit" class='btn btn-primary'>
                                Add Credit
                            </button>
                        </div>
                        <div id="formContainer" style="display: none;">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-2 required">Date</label>
                                        <div class="col-md-10">
                                            <div class="input-group date">
                                                <input id="date" name="date" type="text"
                                                    class="form-control form-control-sm datepicker"
                                                    placeholder="Select Date" required
                                                    data-parsley-errors-container="#date-error" />
                                                <span class="input-group-text input-group-addon bg-primary"><i
                                                        class="fa fa-calendar"></i></span>
                                            </div>
                                            <div id="date-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-2 required">Amount</label>
                                        <div class="col-md-10">
                                            <input id="amount" name="amount" type="text"
                                                class="form-control form-control-sm" placeholder="Amount" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-1 required">Remarks</label>
                                        <div class="col-md-11">
                                            <textarea id="remarks" name="remarks" type="text"
                                                class="form-control form-control-sm" placeholder="Enter remarks here..."
                                                rows="4" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <button type="button" id="cancelCredit" class="btn btn-white me-1">Cancel</button>
                                    <button type="button" id="saveCredit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="bg-gray-600 opacity-2" />
                <div class="table-responsive">
                    <table id="creditsTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th>Date</th>
                                <th>Credit Id</th>
                                <th>Amount</th>
                                <th>Credited By</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Credit Id</th>
                                <th>Amount</th>
                                <th>Credited By</th>
                                <th>Remarks</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>