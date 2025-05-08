<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="roleFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="roleFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="roleForm">
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
                        <div class="col-md-12">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-2">Modules</label>
                                <div class="col-md-10">
                                    <select id="module" name="module" class="form-select form-select-sm" multiple="multiple" required
                                    data-parsley-errors-container="#module-error">
                                        @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="module-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveRole" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>