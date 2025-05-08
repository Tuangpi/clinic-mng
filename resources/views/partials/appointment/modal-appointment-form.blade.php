<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="appointmentFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="appointmentFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <div id="guestFieldContainer">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="guest-field-label form-label col-form-label col-form-label-sm col-md-4 required">First
                                        Name</label>
                                    <div class="col-md-8">
                                        <input id="firstName" name="firstName" type="text"
                                            class="form-control form-control-sm guest-field" placeholder="First Name"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="guest-field-label form-label col-form-label col-form-label-sm col-md-4 required">Last
                                        Name</label>
                                    <div class="col-md-8">
                                        <input id="lastName" name="lastName" type="text"
                                            class="form-control form-control-sm guest-field" placeholder="Last Name"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label
                                        class="guest-field-label form-label col-form-label col-form-label-sm col-md-4 required">Mobile
                                        No.</label>
                                    <div class="col-md-8">
                                        <input id="mobileNo" name="mobileNo" type="text"
                                            class="form-control form-control-sm guest-field" placeholder="Mobile No."
                                            required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-gray-600 opacity-2" />
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3">Patient</label>
                                <div class="col-md-9">
                                    <select id="patient" name="patient" class="form-select form-select-sm">
                                        <option value="" disabled selected></option>
                                        @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" data-email="{{ $patient->email }}">{{
                                            $patient->first_name }} {{ $patient->last_name }} ({{ $patient->code }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Appointment
                                    Prefix</label>
                                <div class="col-md-8">
                                    <input id="prefix" name="prefix" type="text" class="form-control form-control-sm"
                                        placeholder="Appointment Prefix" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-1">Details</label>
                                <div class="col ms-md-2_1rem">
                                    <textarea id="details" name="details" type="text"
                                        class="form-control form-control-sm" placeholder="Enter details here..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3 required">Start
                                    Date</label>
                                <div class="col-md-9">
                                    <div class="input-group date">
                                        <input id="startDate" name="startDate" type="text"
                                            class="form-control form-control-sm" placeholder="DD/MM/YYYY --:-- --"
                                            required data-parsley-errors-container="#startDate-error" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <div id="startDate-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3 required">End
                                    Date</label>
                                <div class="col-md-9">
                                    <div class="input-group date">
                                        <input id="endDate" name="endDate" type="text"
                                            class="form-control form-control-sm" placeholder="DD/MM/YYYY --:-- --"
                                            required data-parsley-errors-container="#endDate-error"
                                            data-parsley-date-range="startDate" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <div id="endDate-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3">Recurring</label>
                                <div class="col-md-9">
                                    <select id="recurring" name="recurring" class="form-select form-select-sm">
                                        <option value="" disabled selected></option>
                                        @foreach ($recurringTypes as $recurringType)
                                        <option value="{{ $recurringType->id }}">{{ $recurringType->description }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Category</label>
                                <div class="col-md-9">
                                    <select id="category" name="category" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#category-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="category-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recurringIntervalContainer" class="row mb-2" style="display:none;">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Interval</label>
                                <div class="col-md-9">
                                    <input id="interval" name="interval" type="number"
                                        class="form-control form-control-sm" placeholder="Interval" min="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-3">Until</label>

                                <div class="col-md-9">
                                    <div class="input-group date">
                                        <input id="recurringEndDate" name="recurringEndDate" type="text"
                                            class="form-control form-control-sm" placeholder="DD/MM/YYYY"
                                            data-parsley-errors-container="#recurringEndDate-error"
                                            data-parsley-date-range="startDate" />
                                        <span class="input-group-text input-group-addon bg-primary"><i
                                                class="fa fa-calendar"></i></span>
                                    </div>
                                    <div id="recurringEndDate-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recurringDOWContainer" class="row mb-2" style="display:none;">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-1">WeekDay</label>
                                <div class="col ms-md-2_1rem">
                                    <select id="dow" name="dow" class="form-select form-select-sm" multiple="">
                                        <option value="MO">MO</option>
                                        <option value="TU">TU</option>
                                        <option value="WE">WE</option>
                                        <option value="TH">TH</option>
                                        <option value="FR">FR</option>
                                        <option value="SA">SA</option>
                                        <option value="SU">SU</option>

                                    </select>
                                    <div id="status-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-3 required">Status</label>
                                <div class="col-md-9">
                                    <select id="status" name="status" class="form-select form-select-sm" required
                                        data-parsley-errors-container="#status-error">
                                        @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->description }}</option>
                                        @endforeach

                                    </select>
                                    <div id="status-error"></div>
                                </div>
                            </div>
                        </div>
                        <div id="sendEmailContainer" class="col-md-6">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="sendEmail" />
                                <label class="form-check-label" for="sendEmail">Send email to notify patient <span
                                        id="patientEmail" class="text-muted"></span></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveAppointment" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>