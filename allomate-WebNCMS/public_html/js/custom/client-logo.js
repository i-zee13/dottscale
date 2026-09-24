var lastOp = "";
var glob_type = '';
var deleteRef = '';
var segments = location.href.split('/');
$(document).ready(function () {
    var action = segments[3];
    action = action.split('#')[0];
    clientLogoList();

    function clientLogoList() {
        $('.body').empty();
        $('#tblLoader').show();
        $.ajax({
            type: 'GET',
            url: '/admin/all-client-list',
            success: function (response) {
                $('.body').empty();
                $('.body').append(`
                    <table class="table table-hover dt-responsive nowrap prompts-table" style="width:100%">
                        <thead>
                            <tr>
                            <th>Sequence</th>
                            <th>logo</th>
                            <th>Name</th>
                            <th>Alt Text</th> 
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>`);
                $('.prompts-table tbody').empty();
                response.records.forEach((element, key) => {
                    $('.prompts-table tbody').append(`
                        <tr>
                            <td>${element['sequence']}</td>
                            <td><img  src="/storage/${element['logo']}"   width="40px" height="40px" /></td> 
                            <td>${element['name']}</td> 
                            <td>${element['alt_text']}</td>
                            <td>
                            <button 
                                    data-id="${element['id']}" 
                                    sequence="${element['sequence']}" 
                                    name="${element['name']}" 
                                    logo="${element['logo']}" 
                                    alt_text="${element['alt_text']}" 
                                    class="btn btn-default btn-line openDataSidebarForUpdateClient" >Edit</button>
                                <button data-id="${element['id']}" class="btn btn-default red-bg delete-section" >Delete</button>
                            </td>
                        </tr>`);
                });
                $('#tblLoader').hide();
                $('.tbl-list-div').fadeIn();
                $('.prompts-table').DataTable();
                $('.body').show()

            }
        });
    }
    $(document).on('click', '.delete-section', function () {
        $('#hidden_btn_to_open_modal_for_type').click();
        var id = $(this).attr('data-id');
        $('.del_type').attr('id', id);
        deleteRef = $(this);
    });
    $(document).on('click', '.del_type', function () {
        var id = $(this).attr('id');
        var CurrentRef = $(this);
        CurrentRef.attr('disabled', 'disabled');
        CurrentRef.text('Processing...');
        var url = "/admin/delete-client";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                id: id
            },
            success: function (e) {
                CurrentRef.attr('disabled', false);
                CurrentRef.text('Yes');
                if (e.status == "success") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Deleted Successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    $('.cancel_delete_modal').click();

                    clientLogoList();
                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Unable to delete at the moment!');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        })
    });
    $(document).on('click', '.openDataSidebarForAddingClient', function () {
        $('input[name="hidden_client_id"]').val("");
        $('input[name="name"]').val("");
        $('input[name="alt_text"]').val('');
        $('input[name="sequence"]').val('');
        $('.dropify-clear').click();
        $('#dataSidebarLoader').hide();
        $('.dz-image-preview').remove();
        $('.dz-default').show();
        if (lastOp == "update") {
            $('input[name="name"]').val("");
            $('input[name="name"]').blur();

        }
        lastOp = 'add';

        if ($('#saveClientForm input[name="_method"]').length) {
            $('#saveClientForm input[name="_method"]').remove();
        }

        $('input[id="operation"]').val('add');
        openSidebar();
    });

    $(document).on('click', '.openDataSidebarForUpdateClient', function () {
        $('input[id="operation"]').val('update');
        lastOp = 'update';
        $('#dataSidebarLoader').hide();
        $('._cl-bottom').hide();
        $('.pc-cartlist').hide();

        var id = $(this).attr('data-id');
        var sequence = $(this).attr('sequence');
        var name = $(this).attr('name');
        var logo = $(this).attr('logo');
        var alt_text = $(this).attr('alt_text');
        $('input[name="hidden_client_id"]').val(id);

        $('input[name="sequence"]').focus();
        $('input[name="sequence"]').val(sequence);
        $('input[name="sequence"]').blur();

        $('input[name="alt_text"]').focus();
        $('input[name="alt_text"]').val(alt_text);
        $('input[name="alt_text"]').blur();

        $('input[name="name"]').focus();
        $('input[name="name"]').val(name);
        $('input[name="name"]').blur();

        var input = `<input type="hidden"  name="logo_hidden" value="${logo}"/> 
          <input type="file" id="input-file-now" class="dropify logo"  name="logo" data-old_input="logo_hidden"  data-default-file = "/storage/${logo}" value="${logo}" accept="image/jpg, image/png, , image/svg image/jpeg, image/JPEG , image/SVG" data-allowed-file-extensions="jpg png jpeg JPEG SVG svg" data-max-file-size="25M" />`
        $('.img').empty();
        $('.img').html(input);
        $('.dropify').dropify();
        $('._cl-bottom').show();
        $('.pc-cartlist').show();
        openSidebar();
    });
    $(document).on('click', '#saveClientBtn', function () {
        let dirty = false;
        if (!$('input[name="sequence"]').val()) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        if (!$('input[name="name"]').val()) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        if (!$('input[name="alt_text"]').val()) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        if (!$('input[name="logo"]').val() && !$('input[name="logo_hidden"]').val()) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }

        $('#saveClientBtn').attr('disabled', 'disabled');
        $('#cancelMainCat').attr('disabled', 'disabled');
        $('#saveClientBtn').text('Processing..');

        $('#saveClientForm').ajaxSubmit({
            type: "POST",
            url: "/admin/save-client",
            data: $('#saveClientForm').serialize(),
            cache: false,
            success: function (response) {

                if (response.status == "success") {
                    clientLogoList();
                    $('#saveClientBtn').removeAttr('disabled');
                    $('#cancelMainCat').removeAttr('disabled');
                    $('#saveClientBtn').text('Save');

                    $('#notifDiv').text('CLient has updated successfully');
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    closeSidebar();
                } else {
                    if (response.msg == "duplicate") {
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('CLient Already Exist');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                        $('#saveClientBtn').removeAttr('disabled');
                        $('#cancelMainCat').removeAttr('disabled');
                        $('#saveClientBtn').text('Save');
                    }
                    if (response.msg == "failed") {
                        $('#saveClientBtn').removeAttr('disabled');
                        $('#cancelMainCat').removeAttr('disabled');
                        $('#saveClientBtn').text('Save');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Failed to add category at the moment');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                    if (response.msg == "logo_missing") {
                        $('#saveClientBtn').removeAttr('disabled');
                        $('#cancelMainCat').removeAttr('disabled');
                        $('#saveClientBtn').text('Save');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Logo Is missing');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }


            },
            error: function (err) {
                if (err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<small style="color: red; position: absolute; width:100%; text-align: right; margin-left: -30px">' + error[0] + '</small>'));
                    });
                }
            }
        });

    });
    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });
})
