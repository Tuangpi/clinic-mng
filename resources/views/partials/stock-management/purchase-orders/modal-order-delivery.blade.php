<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="orderDeliveryModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="orderDeliveryModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <form id="deliveryForm">
          <button type="button" id="addDelivery" class='btn btn-primary mb-2'>
            Add Delivery
          </button>
          <div class="table-responsive">
            <table id="deliveriesTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-silver">
                  <th width="1%"></th>
                  <th width="150px">Delivery Date</th>
                  <th width="100px">DR No.</th>
                  <th width="100px">Delivered Qty</th>
                  <th width="100px">Pack Size (Opt.)</th>
                  <th width="100px">Batch No.</th>
                  <th width="150px">Expiry</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveDelivery" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>