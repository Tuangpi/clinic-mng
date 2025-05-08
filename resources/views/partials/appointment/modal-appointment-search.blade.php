<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="appointmentSearchModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Search Appointment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">
                <div class="table-responsive">
                    <table id="appointmentsTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Recurring</th>
                                <th>Category</th>
                                <th>Patient</th>
                                <th>Guest</th>
                                <th>Mobile No.</th>
                                <th>Branch</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Recurring</th>
                                <th>Category</th>
                                <th>Patient</th>
                                <th>Guest</th>
                                <th>Mobile No.</th>
                                <th>Branch</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>