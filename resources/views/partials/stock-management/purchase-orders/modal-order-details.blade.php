<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="orderDetailsModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="orderDetailsModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Order Date</dt>
              <dd id="orderDate" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">PO No.</dt>
              <dd id="poNo" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Supplier</dt>
              <dd id="supplier" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="table-responsive">
          <table id="itemsTable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-silver">
                <th>Item</th>
                <th width="100px">UOM</th>
                <th width="100px">Unit Price</th>
                <th width="100px">Ordered Qty</th>
                <th width="100px">Total</th>
                <th width="100px">Delivered Qty</th>
                <th width="100px">Pending Qty</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Discount</dt>
              <dd id="discountDisplay" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Tax</dt>
              <dd id="tax" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Total Amt.</dt>
              <dd id="totalAmount" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Total Paid Amt.</dt>
              <dd id="totalPaidAmount" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Remaining Bal.</dt>
              <dd id="remainingBalance" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Payment Status</dt>
              <dd id="paymentStatus" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        @include('partials.stock-management.purchase-orders.order-payment')
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Created By</dt>
              <dd id="createdBy" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Date Created</dt>
              <dd id="createdDate" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Modified By</dt>
              <dd id="modifiedBy" class="col-md-9"></dd>
            </dl>
          </div>
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-3">Date Modified</dt>
              <dd id="modifiedDate" class="col-md-9"></dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="attachFile" class="btn btn-primary">Attach File</button>
        <div class="actions">
          <button type="button" class="btn btn-white me-1" data-bs-dismiss="modal">Close</button>
          <button type="button" id="savePayment" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>