<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="caseNoteTemplateFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="caseNoteTemplateFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="caseNoteTemplateForm">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input id="name" name="name" type="text" class="form-control form-control-sm"
                                placeholder="Name" required />
                        </div>
                        <div class="col-md-12 mb-2">
                            <textarea class="summernote" id="description" required
                                data-parsley-errors-container="#description-error"
                                data-parsley-summernote-required=""></textarea>
                            <div id="description-error"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveCaseNoteTemplate" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>