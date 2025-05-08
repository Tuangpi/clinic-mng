<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="orderAttachmentsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Attachments</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">
                <form action="/" class="dropzone needsclick" id="orderAttachmentsForm">
                    {{ csrf_field() }}
                    <div class="dz-message needsclick">
                        <i class="fa fa-upload text-primary"></i><br />
                        <span class="dz-note needsclick">
                            Drag your file here or <br />
                            <strong><u>browse</u></strong>
                        </span>
                    </div>
                </form>
                <hr class="bg-gray-600 opacity-2" />
                <div class="table-responsive">
                    <table id="orderAttachmentsTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th>File name</th>
                                <th>Size</th>
                                <th>Uploaded Date</th>
                                <th>Uploaded By</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>File name</th>
                                <th>Size</th>
                                <th>Uploaded Date</th>
                                <th>Uploaded By</th>
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