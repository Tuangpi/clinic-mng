<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="unknownItemFormModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Unknown Item</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="unknownItemForm">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-lg-3 col-md-2 required">Name</label>
                                <div class="col-lg-9 col-md-10">
                                    <input id="name" name="name" type="text" class="form-control form-control-sm"
                                        placeholder="Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-lg-3 col-md-2 required">Price</label>
                                <div class="col-lg-9 col-md-10">
                                    <input id="price" price="name" type="text" class="form-control form-control-sm"
                                        placeholder="Price" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="addItem" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>