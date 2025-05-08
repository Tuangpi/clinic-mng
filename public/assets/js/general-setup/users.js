var userDetails = function () {
    let userDetailsModal = $('#userDetailsModal'),
        userDetailsModalTitle = $('#userDetailsModalTitle'),
        photoPreview = userDetailsModal.find('#photoPreview'),
        
        userId = userDetailsModal.find('#userId'),
        firstName = userDetailsModal.find('#firstName'),
        lastName = userDetailsModal.find('#lastName'),
        nationality = userDetailsModal.find('#nationality'),
        nric = userDetailsModal.find('#nric'),
        mobileNo = userDetailsModal.find('#mobileNo'),
        email = userDetailsModal.find('#email'),
        status = userDetailsModal.find('#status'),
        role = userDetailsModal.find('#role'),
        branches = userDetailsModal.find('#branches');

    return {
        view: view
    }
    function view() {
        cms.get(`${_url}/${_id}`, null, function (data) {
            populateDetailsValues(data.user);
            userDetailsModal.modal('show');
        })
    }
    function populateDetailsValues(user) {
        userDetailsModalTitle.text(`${user.code} - ${user.full_name}`);
        userId.text(user.code);
        email.text(user.email);
        firstName.text(user.first_name);
        lastName.text(user.last_name);
        nationality.text(user.nationality?.description);
        nric.text(user.nric);
        role.text(user.user_role?.description);
        mobileNo.text(user.mobile_number);
        status.text(user.is_active ? 'Active' : 'Inactive');

        let br = user.user_role_id == 1 ? 'All' : user.branches.map(function(o) {
            return o.description
        }).join(', ');
        branches.text(br);

        if (user.photo_ext != null) {
            photoPreview.attr('src', `/storage/user-profile/${user.id}.${user.photo_ext}?v=${moment(user.updated_at).format('MMDDYYYYHHmmss')}`)
        }
        else {
            photoPreview.attr('src', _defaultPhotoSrc);
        }
    }
}();
var userForm = function () {
    let userFormModal = $('#userFormModal'),
        userFormModalTitle = $('#userFormModalTitle'),

        userForm = $('#userForm'),
        photoExt,

        photoPreview = $('#photoPreview'),
        removePhoto = $('#removePhoto'),
        photo = $('#photo'),
        photoImage = $('#photoImage'),
        photoReader = new FileReader(),
        photoCamera = $('#photoCamera'),
        cameraModal = $('#cameraModal'),
        capture = $('#capture'),

        firstName = userForm.find('#firstName'),
        lastName = userForm.find('#lastName'),
        username = userForm.find('#username'),
        email = userForm.find('#email'),
        nationality = userForm.find('#nationality'),
        nric = userForm.find('#nric'),
        mobileNo = userForm.find('#mobileNo'),
        role = userForm.find('#role'),
        status = userForm.find('#status'),
        branchContainer = userForm.find('#branchContainer'),
        branch = userForm.find('#branch'),

        saveUser = userForm.find('#saveUser');

    return {
        init: init,
        view: view,
    }
    function init() {
        initFormPlugins();
        
        photoImage.click((e) => {
            e.stopPropagation();
            photo.click();
        });

        photo.on('change', () => {
            photoReader.readAsDataURL(photo.prop('files')[0]);
        });

        photoReader.onloadend = (evt) => {
            photoPreview.attr('src', evt.target.result);
            removePhoto.removeClass('hide');
        }

        removePhoto.click(function () {
            photo.val('');
            photoPreview.attr('src', _defaultPhotoSrc);
            removePhoto.addClass('hide');
        });

        photoCamera.click(async function () {
            let video = document.querySelector('#video');
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
            cameraModal.modal('show');
        });

        cameraModal.on('hidden.bs.modal', function () {
            let video = document.querySelector("#video");
            const mediaStream = video.srcObject;
            const tracks = mediaStream.getTracks();
            tracks[0].stop();
            tracks.forEach(track => track.stop())
        });

        capture.click(function (e) {
            let canvas = document.querySelector("#canvas");
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            photoPreview.attr('src', canvas.toDataURL('image/jpeg'));
            photo.val('');
            removePhoto.removeClass('hide');
        });

        role.change(function () {
            if (this.value == 1) {
                branch.val('').trigger('change');
                branchContainer.hide();
            } else {
                branchContainer.show();
            }
        });

        saveUser.click(function () {
            save();
        });

        userFormModal.on('hidden.bs.modal', function () {
            resetForm();
        });
    }
    function initFormPlugins() {
        nationality.select2({ placeholder: "Select Nationality", dropdownParent: userForm });
        role.select2({ placeholder: "Select Role", dropdownParent: userForm });
        branch.select2({ placeholder: "Select Branches", dropdownParent: userForm, multiple: true });
        status.select2({ placeholder: "Select Status", dropdownParent: userForm });
    }
    function view() {
        if (_id == 0) {
            userFormModalTitle.text('Create New User');
            removePhoto.addClass('hide');
            userFormModal.modal('show');

        } else {
            userFormModalTitle.text('Edit User Details');
            removePhoto.removeClass('hide');
            cms.get(`${_url}/${_id}/edit`, null, function (data) {
                populateFormValues(data.user);
                userFormModal.modal('show');
            });
        }
    }
    function populateFormValues(user) {
        firstName.val(user.first_name);
        lastName.val(user.last_name);
        username.val(user.username);
        email.val(user.email);
        nationality.val(user.nationality_id).trigger('change');
        nric.val(user.nric);
        mobileNo.val(user.mobile_number);
        status.val(user.is_active).trigger('change');
        role.val(user.user_role_id).trigger('change');
        branch.val(user.branch_ids).trigger('change');
        photoExt = user.photo_ext;

        if (user.photo_ext != null) {
            photoPreview.attr('src', `/storage/user-profile/${user.id}.${user.photo_ext}?v=${moment(user.updated_at).format('MMDDYYYYHHmmss')}`)
        }
        else {
            removePhoto.addClass('hide');
        }
    }
    function resetForm() {
        photoPreview.attr('src', _defaultPhotoSrc);
        userForm[0].reset();
        userForm.parsley().reset();
        userForm.find('select').trigger('change');
        branchContainer.hide();
    }
    function save() {
        let formValid = userForm.parsley().validate();
        if (formValid) {

            let user = {
                firstName: firstName.val(),
                lastName: lastName.val(),
                username: username.val(),
                email: email.val(),
                nationality: nationality.val(),
                nric: nric.val(),
                mobileNo: mobileNo.val(),
                status: status.val(),
                role: role.val(),
                branch: branch.val(),
                photoExt: photoExt
            };

            if (photoPreview.attr('src') != _defaultPhotoSrc) {
                if (photoReader.result != null && photo.prop('files').length > 0) {
                    user.photo = photoReader.result.split("base64,")[1];
                    user.photoExt = photo.prop('files')[0].name.split('.').pop();
                }
                else if (photoPreview.attr('src').indexOf('base64') >= 0) {
                    user.photo = photoPreview.attr('src').split("base64,")[1];
                    user.photoExt = 'jpg';
                }
            }
            else {
                user.photoExt = null;
            }

            cms.saveForm(_id, user, _url, function () {
                userList.reload();
                if (_id == 0) {
                    resetForm();
                }
            });

        }
    }
}();
var userList = function () {
    let addUser = $('#addUser'),
        table = $("#usersTable"),
        dt;
    return {
        init: init,
        reload: reload
    }

    function init() {

        initDataTable();

        addUser.click(function () {
            _id = 0;
            userForm.view();
        });
    }
    function reload() {
        dt.ajax.reload(null, false);
    }
    function initDataTable() {
        dt = table.DataTable({
            processing: true,
            serverSide: true,
            ajax: _url,
            columns: [
                { data: null, name: 'actions', searchable: false, orderable: false },
                { data: null, name: 'image', searchable: false, orderable: false },
                { data: 'code', name: 'code' },
                { data: 'username', name: 'username' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'mobile_number', name: 'mobile_number' },
                { data: 'role', name: 'role' },
                { data: 'is_active', name: 'is_active', render: function(data) {
                    let status = 'Active',
                        color = 'success';
                        if (data == false) {
                            status = 'Inactive';
                            color = 'danger';
                        }
                    return `<span class="text-${color}">${status}</span>`;
                } }
            ],
            order: [[2, 'asc']],
            createdRow: function (row, data, index) {
                let tr = $(row);
                tr.find('td:eq(0)').addClass('text-center').html(
                    `<div class="btn-group dropend">
                        <a href="#" class="dropdown-toggle text-primary" data-bs-toggle="dropdown">
                        <i class="fa fa-ellipsis-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><button id="edit${data.id}" class="dropdown-item edit fs-11px" type="button">Edit</button></li>
                            <li><button id="del${data.id}" class="dropdown-item delete fs-11px" type="button">Delete</button></li>
                        </ul>
                    </div>`
                );
                tr.find('td:eq(1)').addClass('text-center').html(
                    `<img src="${data.photo_ext != null ? `/storage/user-profile/${data.id}.${data.photo_ext}?v=${moment(data.updated_at).format('MMDDYYYYHHmmss')}` : _defaultPhotoSrc}" class="rounded h-30px my-n1 mx-n1">`
                );
                tr.find('td:eq(2)').html(`<a href="javascript:;" id="view${data.id}" class='view'>${data.code}</a>`)
            },
            drawCallback: function () {
                table.find('.edit').unbind('click').click(function () {
                    _id = this.id.replace('edit', '')
                    userForm.view();
                });

                table.find('.delete').unbind('click').click(function () {
                    cms.confirm('Delete User', 'Are you sure you want to delete this record?', () => {
                        cms.delete(`${_url}/${this.id.replace('del', '')}`, null, () => {
                            toastr.success('User has been deleted.', 'Delete User');
                            reload();
                        });
                    });
                });

                table.find('.view').unbind('click').click(function () {
                    _id = this.id.replace('view', '')
                    userDetails.view();
                });
            },
            initComplete: function () {
                $("#usersTable_filter input").unbind();
                $("#usersTable_filter input").keyup(function (e) {
                    if (e.keyCode == 13) {
                        dt.search(this.value).draw();
                    }
                });
            }
        });
    }
}();
$(function () {
    $(document).ready(function () {
        userList.init();
        userForm.init();
    });
});