<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="descriptionFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="descriptionFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="descriptionForm">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveDescription" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>