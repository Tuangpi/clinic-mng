<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="adjustmentDetailsModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="adjustmentDetailsModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Adjustment Date</dt>
              <dd id="adjustmentDate" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Type</dt>
              <dd id="type" class="col-md-9"></dd>
            </dl>
          </div>
          <div id="branchContainer" class="col-md-4" style="display:none;">
            <dl class="row">
              <dt class="col-md-3">Branch</dt>
              <dd id="branch" class="col-md-9"></dd>
            </dl>
          </div>
          <div id="supplierContainer" class="col-md-4" style="display:none;">
            <dl class="row">
              <dt class="col-md-3">Supplier</dt>
              <dd id="supplier" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <table id="itemsTable" class="table table-badjustmented table-striped table-hover">
          <thead>
            <tr class="bg-silver">
              <th>Item</th>
              <th width="100px">UOM</th>
              <th width="100px">Current Stock</th>
              <th width="100px">Qty</th>
              <th width="100px">Updated Stock</th>
              <th width="100px">Batch No. (Opt.)</th>
              <th width="100px">Expiry Date</th>
              <th width="100px">Remarks</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Created By</dt>
              <dd id="createdBy" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Date Created</dt>
              <dd id="createdDate" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>