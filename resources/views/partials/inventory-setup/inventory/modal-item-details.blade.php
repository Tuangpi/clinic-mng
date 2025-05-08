<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="itemDetailsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="itemDetailsModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body fs-11px">
        <div class="row">
          <div class="col-md-3 order-md-2">
            <img id="photoPreview" src="{{ asset('/assets/images/image-regular.svg') }}" class="w-100 img-thumbnail"
              alt="...">
          </div>
          <div class="col-md-9 order-md-1">
            <div class="row">
              <div class="col-md-6">
                <dl class="row">
                  <dt class="col-md-4">Item ID</dt>
                  <dd id="itemId" class="col-md-8"></dd>
                </dl>
              </div>
              <div class="col-md-6">
                <dl class="row">
                  <dt class="col-md-4">Item Code</dt>
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
              <div class="col-md-6">
                <dl class="row">
                  <dt class="col-md-4">UOM</dt>
                  <dd id="uom" class="col-md-8"></dd>
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
          </div>
        </div>
        <div id="dosageContainer" style="display: none;">
          <hr class="bg-gray-600 opacity-2" />
          <div class="row mb-2">
              <div class="col-md-4">
                <dl class="row">
                  <dt class="col-md-4">Usage</dt>
                  <dd id="usage" class="col-md-8"></dd>
                </dl>
              </div>
              <div class="col-md-4">
                <dl class="row">
                  <dt class="col-md-4">Dosage</dt>
                  <dd id="dosage" class="col-md-8"></dd>
                </dl>
              </div>
              <div class="col-md-4">
                <dl class="row">
                  <dt class="col-md-4">Unit</dt>
                  <dd id="unit" class="col-md-8"></dd>
                </dl>
              </div>
          </div>
          <div class="row mb-2">
              <div class="col-md-8">
                <dl class="row">
                  <dt class="col-md-2">Frequency</dt>
                  <dd id="frequency" class="col-md-10"></dd>
                </dl>
              </div>
              <div class="col-md-4">
                <dl class="row">
                  <dt class="col-md-4">Total Dosage</dt>
                  <dd id="totalDosage" class="col-md-8"></dd>
                </dl>
              </div>
          </div>
      </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Selling Price</dt>
              <dd id="sellingPriceDisplay" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4 ms-md-2rem">
            <dl class="row">
              <dt class="col-md-4">Cost Price</dt>
              <dd id="costPriceDisplay" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Supplier</dt>
              <dd id="supplier" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4 ms-md-2rem">
            <dl class="row">
              <dt class="col-md-4">Manufacturer</dt>
              <dd id="manufacturer" class="col-md-8"></dd>
            </dl>
          </div>
        </div>
        <hr class="bg-gray-600 opacity-2" />
        <div class="row">
          <div class="col-md-4">
            <dl class="row">
              <dt class="col-md-4">Critical Level</dt>
              <dd id="criticalLevelDisplay" class="col-md-8"></dd>
            </dl>
          </div>
          <div class="col-md-4 ms-md-2rem">
            <dl class="row">
              <dt class="col-md-4">Status</dt>
              <dd id="status" class="col-md-8"></dd>
            </dl>
          </div>
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