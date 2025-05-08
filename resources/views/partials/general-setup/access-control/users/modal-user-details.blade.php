<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="userDetailsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="userDetailsModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <div class="row">
          <div class="col-md-3 order-md-2">
            <img id="photoPreview" src="{{ asset('/assets/images/new-user.png') }}" class="w-100 img-thumbnail"
              alt="...">
          </div>
          <div class="col-md-9 order-md-1">
            <div class="row">
              <div class="col-md-6">
                <dl class="row">
                  <dt class="col-md-4">User ID</dt>
                  <dd id="userId" class="col-md-8"></dd>
                </dl>
              </div>
              <div class="col-md-6">
                <dl class="row">
                  <dt class="col-md-4">Email Address</dt>
                  <dd id="email" class="col-md-8"></dd>
                </dl>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">First Name</dt>
                        <dd id="firstName" class="col-md-7 ms-3"></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">Last Name</dt>
                        <dd id="lastName" class="col-md-7 ms-3"></dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">Nationality</dt>
                        <dd id="nationality" class="col-md-7 ms-3"></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">NRIC</dt>
                        <dd id="nric" class="col-md-7 ms-3"></dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">Mobile No.</dt>
                        <dd id="mobileNo" class="col-md-7 ms-3"></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-md-4">Status</dt>
                        <dd id="status" class="col-md-7"></dd>
                    </dl>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <dl class="row">
                  <dt class="col-md-2">Role</dt>
                  <dd id="role" class="col-md-10"></dd>
                </dl>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <dl class="row">
                  <dt class="col-md-2">Branches</dt>
                  <dd id="branches" class="col-md-10"></dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>