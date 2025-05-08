<div class="modal fade" id="appointmentDetailsModal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i id="categoryIndicator" class="fa fa-square"></i>
                    Appointment Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">
                <dl class="row">
                    <dt class="col-md-4">Patient</dt>
                    <dd id="patient" class="col-md-8"></dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-4">Mobile No.</dt>
                    <dd id="mobileNo" class="col-md-8"></dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-4">Date</dt>
                    <dd id="scheduleDate" class="col-md-8"></dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-4">Time</dt>
                    <dd id="scheduleTime" class="col-md-8"></dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-4">Category</dt>
                    <dd id="category" class="col-md-8"></dd>
                </dl>
                <hr class="bg-gray-600 opacity-2" />
                <dl class="row">
                    <dt class="col-md-4">Appt. Prefix</dt>
                    <dd id="prefix" class="col-md-8"></dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-4">Details</dt>
                    <dd id="details" class="col-md-8"></dd>
                </dl>
                <hr class="bg-gray-600 opacity-2" />
                <div class="row mb-2">
                    <div class="col">
                        <select id="status" class="form-select-sm w-100">
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <button id="addPatientToTheQueue" type="button" class="btn btn-primary w-100">Add patient to the
                            queue</button>
                            <button id="addToPatientRecords" type="button" class="btn btn-primary w-100">Add to patient records</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button id="delete" type="button" class="btn btn-white" data-bs-dismiss="modal">
                    <i class="fa fa-trash-can"></i>
                </button>
                <div class="actions">
                    <button type="button" id="edit" class="btn btn-primary me-1">Edit</button>
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>