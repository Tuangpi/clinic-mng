<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="taxFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="taxFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="taxForm">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Scheme No.</label>
                                <div class="col-md-9">
                                    <input id="schemeNo" name="schemeNo" type="text"
                                        class="form-control form-control-sm" placeholder="Scheme No." required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Percentage</label>
                                <div class="col-md-9">
                                    <input id="percentage" name="percentage" type="text"
                                        class="form-control form-control-sm" placeholder="Percentage" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveTax" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>