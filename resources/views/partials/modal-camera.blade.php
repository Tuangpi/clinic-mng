<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="cameraModal">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Take Photo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <video id="video" width="320" height="240" autoplay></video>
                        <canvas id="canvas" width="320" height="240" class="img-thumbnail hide"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="capture" type="button" class="btn btn-primary">Capture</button>
            </div>
        </div>
    </div>
</div>