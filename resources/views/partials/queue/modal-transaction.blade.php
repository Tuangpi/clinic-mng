<div class="modal fade no-print" data-bs-backdrop="static" data-bs-keyboard="false" id="transactionModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="transactionModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">

                <div id="allergyContainer" class="alert alert-primary"></div>
                <div class="row g-3 align-items-center mb-4">
                    <div class="col-lg-10">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control posted-disable" id="itemKeyword"
                                placeholder="Add Medicines, Investigations, Procedures, Injections or etc.">
                            <button id="searchItem" type="button" class="btn btn-primary posted-disable"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-2 text-end">
                        <input type="hidden" id="patientId">
                        <button id="sessionBalance" type="button"
                            class="d-inline-block btn btn-primary me-3px posted-disable">
                            Session / Balance
                            <span id="sessionBalanceCount" class="badge bg-dark-blue rounded-pill"></span>
                        </button>
                        <button type="button" class="d-inline-block btn btn-white" id="detailedView"><i
                                class="fa fa-table-columns"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="transactionItemsTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-silver">
                                    <th class="w-60px text-center">
                                        <button id="addUnknownItem" type="button" class="btn btn-xs btn-primary fs-9px">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </th>
                                    <th class="w-100px">ID</th>
                                    <th>Name</th>
                                    <th class="w-100px optional" style="display:none;">Unit Price</th>
                                    <th class="w-130px">Qty</th>
                                    <th class="w-100px">Price</th>
                                    <th class="w-100px optional" style="display:none;">Total Amount</th>
                                    <th class="w-130px">Disc.</th>
                                    <th class="w-100px">SubTotal</th>
                                    <th class="w-130px">Amount to Pay</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th id="totalLabel" colspan="4" class="text-end">Total</th>
                                    <th id="totalPrice"></th>
                                    <th id="totalTotalAmount" class="optional" style="display: none;"></th>
                                    <th id="totalDiscount"></th>
                                    <th id="preSubTotal"></th>
                                    <th id="preAmountToPay"></th>
                                </tr>
                                <tr>
                                    <th id="overallDiscountLabel" colspan="5" class="text-end">Overall Discount</th>
                                    <th id="overallDiscountTH">
                                        <a id="overallDiscDisplay" href="javascript:;">0.00</a>
                                        <input id="overallDiscVal" type="hidden" value="" />
                                        <div id="overallDiscEditorContainer" class="input-group input-group-sm">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <span id="overallDiscTypeDisplay">%</span>
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a id="overallDiscTypePercentage" href="javascript:;"
                                                    class="dropdown-item overall-disc-type active">%</a>
                                                <a id="overallDiscTypeCurrency" href="javascript:;"
                                                    class="dropdown-item overall-disc-type"></a>
                                            </div>
                                            <input id="overallDiscEditor" type="text"
                                                class="form-control form-control-sm editor" value="0" />
                                        </div>
                                    </th>
                                    <th id="subTotalBeforePxCredit"></th>
                                    <th id="amountToPayBeforePxCredit"></th>
                                </tr>
                                <tr>
                                    <th id="pxCreditLabel" colspan="5" class="text-end">Patient Credit</th>
                                    <th id="pxCreditTH">
                                        <a id="pxCreditDisplay" href="javascript:;">0.00</a>
                                        <input id="pxAvailableCredit" type="hidden" value="" />
                                        <input id="pxCreditVal" type="hidden" value="" />
                                        <div id="pxCreditEditorContainer" class="input-group input-group-sm">
                                            <input id="pxCreditEditor" type="text"
                                                class="form-control form-control-sm editor" value="0" />
                                        </div>
                                    </th>
                                    <th id="totalSubTotal"></th>
                                    <th id="totalAmountToPay"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mb-2 posted-hide">
                    <div class="col">
                        <button type="button" id="addPayment" class='btn btn-primary'>
                            Add Payment
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form id="paymentForm">
                            <div class="table-responsive">
                                <table id="paymentsTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="bg-silver">
                                            <th width="1%"></th>
                                            <th class="w-150px">Payment Option</th>
                                            <th class="w-150px">Amount</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Total</th>
                                            <th id="paymentTotal" colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <textarea id="notes" name="notes" type="text" class="form-control form-control-sm"
                            placeholder="Notes" rows="4"></textarea>
                    </div>
                </div>
                <hr class="bg-gray-600 opacity-2" />
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control form-control-sm" id="refNo" placeholder="Reference No.">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control form-control-sm" id="doctor"
                            placeholder="Attending Doctor">
                    </div>
                </div>
                @if (\Auth::user()->is_administrator)
                    <div class="row">
                        <div class="col">
                            <textarea id="transactionRemarks" name="transactionRemarks" type="text"
                                class="form-control form-control-sm" placeholder="Transaction Remarks" rows="4"></textarea>
                        </div>
                    </div>
                    @if (config('app.show_include_invoice_remarks'))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="includeInvoiceRemarks" />
                                    <label class="form-check-label" for="includeInvoiceRemarks">Include remarks in the printed invoice</label>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <input type="hidden" id="transactionRemarks">
                    <input type="hidden" id="includeInvoiceRemarks">
                @endif
                <input type="hidden" id="printHeader">
                <input type="hidden" id="coRegNo">
                <input type="hidden" id="telNo">
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <div class="btn-group me-1">
                        <a href="javscript:;" class="btn btn-warning">Print</a>
                        <a href="javscript:;" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a id="printInvoice" href="javascript:;" class="dropdown-item">Invoice</a>
                            <a id="printPatientLabel" href="javascript:;" class="dropdown-item">Patient Label</a>
                            <a id="printItemLabel" href="javascript:;" class="dropdown-item">Item Label</a>
                        </div>
                    </div>
                    <button type="button" id="saveAsDraftTransaction" class="btn btn-dark-blue posted-hide me-1"
                        style="display:none;">Save as Draft</button>
                    <button type="button" id="saveTransaction" class="btn btn-primary"
                        style="display:none;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>