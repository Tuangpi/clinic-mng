<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="notesModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="notesModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <textarea id="notes" name="notes" type="text" class="form-control form-control-sm"
                            placeholder="Enter notes here..." rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveNotes" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>