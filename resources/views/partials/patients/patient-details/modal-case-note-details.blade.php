<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="caseNoteDetailsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="caseNoteDetailsModalTitle" class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body fs-11px">
                <div class="d-flex">
                    <img id="userPhoto" src="{{ asset('/assets/images/new-user.png') }}" alt=""
                        class="w-60px h-60px rounded" />
                    <div class="ps-3 flex-1">
                        <strong id="userName" class="mb-1"></strong> - <span id="caseDate"></span><br />
                        <strong>Case Type - <span id="caseType"></span></strong>
                        <div id="caseContent" class="mt-2"></div>
                    </div>
                </div>
                <hr class="bg-gray-500" />
                <div class="widget-input-container">
                    <div id="userPhotoContainer" class="widget-img widget-img-sm rounded me-3"
                        style="background-image: url({{ \Auth::user()->photoUrl }})">
                    </div>
                    <div class="widget-input-box">
                        <input id="message" type="text" class="form-control pe-40px" placeholder="Write a comment...">
                    </div>
                    <a id="saveComment" href="javascript:;" class="position-absolute end-30px fs-15px" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-title="Press enter to reply"><i class="fa fa-reply"></i></a>
                </div>
                <hr class="bg-gray-500" />
                <div id="commentsContainer"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>