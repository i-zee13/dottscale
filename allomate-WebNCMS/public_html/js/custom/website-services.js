var lastOp = '';

function reinitServiceDropify(preview) {
    var $input = $('input[name="icon_file"]');
    if (!$input.length) return;
    var dr = $input.data('dropify');
    if (dr) {
        try {
            dr.resetPreview();
            dr.clearElement();
            dr.destroy();
        } catch (e) {}
    }
    $input = $('input[name="icon_file"]');
    if (preview) {
        $input.attr('data-default-file', preview);
    } else {
        $input.removeAttr('data-default-file');
        $input.val('');
    }
    $input.addClass('dropify').dropify();
}

function showServiceForm() {
    $('#dataSidebarLoader').hide();
    $('.pc-cartlist').show();
    $('._cl-bottom').show();
}

function hideServiceFormLoader() {
    $('#dataSidebarLoader').hide();
}

$(document).ready(function () {
    showServiceForm();
    fetchServices();

    if ($('input[name="icon_file"]').length) {
        try { $('input[name="icon_file"]').dropify(); } catch (e) {}
    }

    $(document).on('click', '.add-service', function () {
        lastOp = 'add';
        showServiceForm();
        $('input[name="hidden_service_id"]').val('');
        $('input[name="hidden_icon"]').val('');
        $('input[name="service_name"]').val('').blur();
        $('textarea[name="description"]').val('');
        $('input[name="icon_path"]').val('');
        $('input[name="route"]').val('');
        $('input[name="sort_order"]').val('0');
        $('#svc_yes').prop('checked', true);
        reinitServiceDropify('');
        openSidebar();
    });

    $(document).on('click', '.update-service', function () {
        lastOp = 'update';
        $('#dataSidebarLoader').show();
        $('._cl-bottom').hide();
        $('.pc-cartlist').hide();

        var id = $(this).attr('id');
        openSidebar();
        $.ajax({
            type: 'GET',
            url: '/admin/get-website-service/' + id,
            success: function (response) {
                showServiceForm();
                var s = response.service || {};
                $('input[name="hidden_service_id"]').val(s.id || '');
                $('input[name="hidden_icon"]').val(s.icon || '');
                $('input[name="service_name"]').val(s.service_name || '').blur();
                $('textarea[name="description"]').val(s.description || '');
                $('input[name="icon_path"]').val(s.icon || '');
                $('input[name="route"]').val(s.route || '');
                $('input[name="sort_order"]').val(s.sort_order || 0);
                if (parseInt(s.status, 10) === 1) {
                    $('#svc_yes').prop('checked', true);
                } else {
                    $('#svc_no').prop('checked', true);
                }
                reinitServiceDropify(s.icon || '');
            },
            error: function () {
                showServiceForm();
                $('#notifDiv').fadeIn().css('background', '#212529').text('Failed to load service');
                setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
            }
        });
    });

    $(document).on('click', '#saveService', function () {
        if (!$('input[name="service_name"]').val() || !$('input[name="service_name"]').val().trim()) {
            $('#notifDiv').fadeIn().css('background', '#212529').text('Service name is required');
            setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
            return;
        }
        $('#saveService').attr('disabled', 'disabled').text('Processing..');
        $('#saveServiceForm').ajaxSubmit({
            url: '/admin/save-website-service',
            type: 'POST',
            success: function (response) {
                $('#saveService').removeAttr('disabled').text('Save');
                if (response.status == 'success') {
                    fetchServices();
                    $('#notifDiv').fadeIn().css('background', '#212529').text('Service saved');
                    setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
                    closeSidebar();
                } else if (response.msg == 'duplicate') {
                    $('#notifDiv').fadeIn().css('background', '#212529').text('Service already exists');
                    setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
                } else {
                    $('#notifDiv').fadeIn().css('background', '#212529').text('Could not save');
                    setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
                }
            },
            error: function () {
                $('#saveService').removeAttr('disabled').text('Save');
                $('#notifDiv').fadeIn().css('background', '#212529').text('Failed to save');
                setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
            }
        });
    });

    $(document).on('click', '.delete-service', function () {
        var id = $(this).attr('id');
        if (typeof swal === 'function') {
            swal({ title: 'Are you sure?', icon: 'warning', buttons: true, dangerMode: true }).then(function (ok) {
                if (ok) deleteService(id);
            });
        } else if (confirm('Delete this service?')) {
            deleteService(id);
        }
    });
});

function deleteService(id) {
    $.ajax({
        type: 'POST',
        url: '/admin/delete-website-service/' + id,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val() },
        success: function () {
            fetchServices();
            $('#notifDiv').fadeIn().css('background', '#212529').text('Service deleted');
            setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
        }
    });
}

function fetchServices() {
    $('#tblLoader').show();
    $('.services-body').hide();
    $.ajax({
        type: 'GET',
        url: '/admin/get-website-services',
        success: function (response) {
            var $body = $('.services-body');
            $body.empty();
            $body.append('<table class="table table-hover dt-responsive nowrap servicesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Name</th><th>Route</th><th>Order</th><th>Status</th><th>Action</th></tr></thead><tbody></tbody></table>');
            var rows = response.services || [];
            rows.forEach(function (s, key) {
                $('.servicesListTable tbody').append(
                    '<tr>' +
                    '<td>' + (key + 1) + '</td>' +
                    '<td>' + (s.service_name || '') + '</td>' +
                    '<td>' + (s.route || '') + '</td>' +
                    '<td>' + (s.sort_order || 0) + '</td>' +
                    '<td>' + (parseInt(s.status, 10) === 1 ? 'Active' : 'Deactive') + '</td>' +
                    '<td>' +
                    '<button type="button" id="' + s.id + '" class="btn btn-default btn-line update-service">Edit</button> ' +
                    '<button type="button" id="' + s.id + '" class="btn btn-default red-bg delete-service">Delete</button>' +
                    '</td>' +
                    '</tr>'
                );
            });
            $('#tblLoader').hide();
            $body.fadeIn();
            if ($.fn.DataTable) {
                if ($.fn.DataTable.isDataTable('.servicesListTable')) {
                    $('.servicesListTable').DataTable().destroy();
                }
                $('.servicesListTable').DataTable();
            }
        },
        error: function () {
            $('#tblLoader').hide();
            $('.services-body').html('<p class="p-3">Failed to load services. Check /admin/get-website-services</p>').show();
        }
    });
}
