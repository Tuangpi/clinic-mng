<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="patientDetailsModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="patientDetailsModalTitle" class="modal-title"></h4>
        <div class="float-end">
          <button id="showCredits" class="btn btn-dark-blue">
            <i class="fa fa-wallet me-2"></i>
            <span id="creditDisplay">0.00</span>
          </button>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
      </div>
      <div class="modal-body fs-11px">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a id="patientRecordsLink" href="#tabPatientRecords" data-bs-toggle="tab" class="nav-link active">Patient Records</a>
          </li>
          <li class="nav-item">
            <a id="patientVisitsLink" href="#tabVisits" data-bs-toggle="tab" class="nav-link">Visits</a>
          </li>
        </ul>

        <div class="tab-content panel p-3 rounded">
          <div class="tab-pane fade active show" id="tabPatientRecords">

            <ul class="nav nav-tabs tab-blue">
              <li class="nav-item">
                <a id="patientDetailsLink" href="#tabPatientDetails" data-bs-toggle="tab" class="nav-link active">Patient Details</a>
              </li>
              <li class="nav-item">
                <a href="#tabCaseNotes" data-bs-toggle="tab" class="nav-link">Case Notes</a>
              </li>
            </ul>
            <div class="tab-content panel p-3 rounded-0 rounded-bottom">
              <div class="tab-pane fade active show" id="tabPatientDetails">
                @include('partials.patients.patient-details.tab-patient-details')
              </div>
              <div class="tab-pane fade" id="tabCaseNotes">
                @include('partials.patients.patient-details.tab-case-note')
              </div>
            </div>

          </div>
          <div class="tab-pane fade" id="tabVisits">
                @include('partials.patients.tab-visits')
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
