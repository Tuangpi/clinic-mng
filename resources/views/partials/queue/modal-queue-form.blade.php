<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="queueFormModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Queue</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="queueForm">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-lg-3 col-md-2 required">Patient</label>
                                <div class="col-lg-9 col-md-10">
                                    <select id="patient" name="patient" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#patient-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" data-email="{{ $patient->email }}">{{$patient->code}} - {{
                                            $patient->first_name }} {{ $patient->last_name }}{{ ($patient->email ? ' ('
                                            . $patient->email . ')' : '') }}</option>
                                        @endforeach
                                    </select>
                                    <div id="patient-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-lg-3 col-md-2 required">Time
                                    In</label>
                                <div class="col-lg-9 col-md-10">
                                    <div class="input-group date">
                                        <input id="timeIn" name="timeIn" type="text"
                                            class="form-control form-control-sm" placeholder="DD/MM/YYYY --:-- --"
                                            required data-parsley-errors-container="#timeIn-error" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-clock"></i></span>
                                    </div>
                                    <div id="timeIn-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-1">Notes</label>
                                <div class="col ms-md-2_1rem">
                                    <textarea id="notes" name="notes" type="text" class="form-control form-control-sm"
                                        placeholder="Enter notes here..." rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hide">
                        <div class="col">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveQueue" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>