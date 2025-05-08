<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="packageDetailsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="packageDetailsModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Package ID</dt>
              <dd id="packageId" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Package Code</dt>
              <dd id="code" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <dl class="row">
              <dt class="col-md-2">Name</dt>
              <dd id="name" class="col-md-10"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Type</dt>
              <dd id="type" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Category</dt>
              <dd id="category" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <dl class="row">
              <dt class="col-md-2">Description</dt>
              <dd id="description" class="col-md-10 text-pre-line"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Selling Price</dt>
              <dd id="sellingPriceDisplay" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Cost Price</dt>
              <dd id="costPrice" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">No. of Sessions</dt>
              <dd id="sessionCount" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Status</dt>
              <dd id="status" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="table-responsive">
          <table id="itemsTable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-silver">
                <th>Item</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Created By</dt>
              <dd id="createdBy" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Date Created</dt>
              <dd id="createdDate" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Modified By</dt>
              <dd id="modifiedBy" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-6">
            <dl class="row">
              <dt class="col-md-4">Date Modified</dt>
              <dd id="modifiedDate" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>