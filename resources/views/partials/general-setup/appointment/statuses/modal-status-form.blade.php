<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="statusFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="statusFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-2 required">Description</label>
                                <div class="col-md-10">
                                    <input id="description" name="description" type="text"
                                        class="form-control form-control-sm" placeholder="Description" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4 required">Seq. No.</label>
                                <div class="col-md-8">
                                    <input id="seqNo" name="seqNo" type="text"
                                        class="form-control form-control-sm" placeholder="Seq. No." required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Color</label>
                                <div class="col-md-9">
                                    <input id="color" name="color" type="text"
                                        class="form-control form-control-sm" placeholder="Color" required data-parsley-errors-container="#color-error"/>
                                        <div id="color-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveStatus" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>