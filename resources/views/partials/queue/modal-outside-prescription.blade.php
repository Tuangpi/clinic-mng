<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="outsidePrescriptionModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="outsidePrescriptionModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="outsidePrescriptionForm">
                    <div class="row mb-2">
                        <div id="addOutsidePrescriptionContainer" class="col">
                            <button type="button" id="addOutsidePrescription" class='btn btn-primary'>
                                Add Outside Prescription
                            </button>
                        </div>
                    </div>
                    <div id="formContainer" style="display: none;">
                        <div class="row mb-2">
                            <div class="col">
                                <button type="button" id="addMedicine" class='btn btn-primary'>
                                    Add Medicine
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table id="medicinesTable" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr class="bg-silver">
                                                <th width="1%"></th>
                                                <th class="w-150px">Medicine</th>
                                                <th class="w-150px">Dosage</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" id="cancelOutsidePrescription"
                                    class="btn btn-white me-1">Cancel</button>
                                <button type="button" id="draftOutsidePrescription" class="btn btn-dark-blue me-1">Save
                                    as
                                    Draft</button>
                                <button type="button" id="saveOutsidePrescription" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="bg-gray-600 opacity-2" />
                <div class="table-responsive">
                    <table id="outsidePrescriptionsTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Outside Prescriptions</th>
                                <th>Created Date and Time</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Outside Prescriptions</th>
                                <th>Created Date and Time</th>
                                <th>Created By</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="outsidePrescriptionPrint" class="print-container">
                    <div class="row text-center">
                        <div class="col">
                            <h1>{{ $currentBranch->print_header ?? '' }}</h1>
                            <p id="branchAddress">{{ $currentBranch->address ?? '' }}</p>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <strong>Patient: <span id="patientName"></span> - <span
                                    id="patientId"></span></strong><br />
                            <span id="patientAddress"></span>
                        </div>
                        <div class="col-md-4">
                            Date: <span id="prescriptionDate"></span><br />
                            Prescription: #<span id="prescriptionNo"></span><br />
                            Ref No: <span id="queueId"></span><br />
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <div class="col">
                            <h3>Prescription</h3>
                        </div>
                    </div>
                    <div class="row mb-50px">
                        <div class="col">
                            <table id="medicinesPrintTable" class="table table-print table-bordered">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Dosage</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <hr class="bg-gray-600 opacity-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>