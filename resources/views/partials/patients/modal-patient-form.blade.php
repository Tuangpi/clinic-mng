<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="patientFormModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="patientFormModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="patientForm">
                    <div class="row">
                        <div class="col-md-2 order-md-2">
                            <input id="photo" type="file" accept="image/*" style="display:none;">
                            <div class="photo-container mb-2">
                                <img id="photoPreview" src="{{ asset('/assets/images/new-user.png') }}" class="w-100" alt="...">
                                <a href="javascript:;" id="removePhoto" class="remove-photo" style=""><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="btn-group btn-group-sm w-100">
                                <button id="photoCamera" type="button" class="btn btn-outline-primary">
                                    <i class="fa fa-camera"></i>
                                </button>
                                <button id="photoImage" type="button" class="btn btn-outline-primary">
                                    <i class="fa fa-image"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-10 order-md-1">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4">Patient
                                            ID</label>
                                        <div class="col-md-8">
                                            <input id="patientId" name="patientId" type="text"
                                                class="form-control form-control-sm" placeholder="[Auto-Generate]"
                                                disabled readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4">Title</label>
                                        <div class="col-md-8">
                                            <select id="title" name="title" class="form-select form-select-sm">
                                                <option value="" disabled selected></option>
                                                @foreach ($titles as $title)
                                                <option value="{{ $title->id }}">{{ $title->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">First
                                            Name</label>
                                        <div class="col-md-8">
                                            <input id="firstName" name="firstName" type="text"
                                                class="form-control form-control-sm" placeholder="First Name"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Last
                                            Name</label>
                                        <div class="col-md-8">
                                            <input id="lastName" name="lastName" type="text"
                                                class="form-control form-control-sm" placeholder="Last Name" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Date
                                            of
                                            Birth</label>
                                        <div class="col-md-8">
                                            <div class="input-group date">
                                                <input id="birthDate" name="birthDate" type="text"
                                                    class="form-control form-control-sm datepicker"
                                                    placeholder="Select Date" required data-parsley-errors-container="#birthdate-error" />
                                                <span class="input-group-text input-group-addon bg-primary"><i
                                                        class="fa fa-calendar"></i></span>
                                            </div>
                                            <div id="birthdate-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4">Birth
                                            Place</label>
                                        <div class="col-md-8">
                                            <input id="birthPlace" name="birthPlace" type="text"
                                                class="form-control form-control-sm" placeholder="Birth Place" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">Gender</label>
                                        <div class="col-md-8">
                                            <select id="gender" name="gender" class="form-select form-select-sm"
                                                required data-parsley-errors-container="#gender-error">
                                                <option value="" disabled selected></option>
                                                @foreach ($genders as $gender)
                                                <option value="{{ $gender->id }}">{{ $gender->description }}</option>
                                                @endforeach
                                            </select>
                                            <div id="gender-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="form-label col-form-label col-form-label-sm col-md-4">Marital
                                            Status</label>
                                        <div class="col-md-8">
                                            <select id="maritalStatus" name="maritalStatus"
                                                class="form-select form-select-sm">
                                                <option value="" disabled selected></option>
                                                @foreach ($maritalStatuses as $maritalStatus)
                                                <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->description
                                                    }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4">Nationality</label>
                                        <div class="col-md-8">
                                            <select id="nationality" name="nationality"
                                                class="form-select form-select-sm">
                                                <option value="" disabled selected></option>
                                                @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">{{ $nationality->description }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label
                                            class="form-label col-form-label col-form-label-sm col-md-4 required">NRIC</label>
                                        <div class="col-md-8">
                                            <input id="nric" name="nric" type="text"
                                                class="form-control form-control-sm" placeholder="NRIC" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-1 required">Address</label>
                                <div class="col-md-10 ms-md-4_1rem">
                                    <input id="address" name="address" type="text" class="form-control form-control-sm"
                                        placeholder="Address" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4">State/Region</label>
                                <div class="col-md-8">
                                    <select id="state" name="state" class="form-select form-select-sm" data-parsley-errors-container="#state-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="state-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label
                                    class="form-label col-form-label col-form-label-sm col-md-4">City</label>
                                <div class="col-md-8">
                                    <select id="city" name="city" class="form-select form-select-sm" data-parsley-errors-container="#city-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->description }}</option>
                                        @endforeach
                                    </select>
                                    <div id="city-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Postal/Zip
                                    Code</label>
                                <div class="col-md-8">
                                    <input id="zipCode" name="zipCode" type="text" class="form-control form-control-sm"
                                        placeholder="Postal/Zip Code" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required"
                                    required>Mobile
                                    Number</label>
                                <div class="col-md-8">
                                    <input id="mobileNo" name="mobileNo" type="text"
                                        class="form-control form-control-sm" placeholder="Mobile Number" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4">Email
                                    Address</label>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" class="form-control form-control-sm"
                                        placeholder="Email Address" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-gray-600 opacity-2" />
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required"
                                    required>Drug
                                    Allergies</label>
                                <div class="col-md-8">
                                    <select id="hasDrugAllergies" name="hasDrugAllergies"
                                        class="form-select form-select-sm" required data-parsley-errors-container="#hasDrugAllergies-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($yesNoUnknown as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['description'] }}</option>
                                        @endforeach
                                    </select>
                                    <div id="hasDrugAllergies-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="drugAllergies" name="drugAllergies" type="text"
                                        class="form-control form-control-sm" placeholder="If yes, please specify" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-4 required"
                                    required>Other Conditions</label>
                                <div class="col-md-8">
                                    <select id="hasFoodAllergies" name="hasFoodAllergies"
                                        class="form-select form-select-sm" required data-parsley-errors-container="#hasFoodAllergies-error">
                                        <option value="" disabled selected></option>
                                        @foreach ($yesNoUnknown as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['description'] }}</option>
                                        @endforeach
                                    </select>
                                    <div id="hasFoodAllergies-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="foodAllergies" name="foodAllergies" type="text"
                                        class="form-control form-control-sm" placeholder="If yes, please specify" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="form-label col-form-label col-form-label-sm col-md-1">Notes</label>
                                <div class="col-md-10 ms-md-4_1rem">
                                    <textarea id="notes" name="notes" type="text" class="form-control form-control-sm"
                                        placeholder="Enter notes here..." rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <div id="addPatientToTheQueueContainer" class="form-check">
                    <input class="form-check-input" type="checkbox" id="addPatientToTheQueue" />
                    <label class="form-check-label" for="addPatientToTheQueue">Add the patient to the queue</label>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="savePatient" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
