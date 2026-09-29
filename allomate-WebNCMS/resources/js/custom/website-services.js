var lastOp = '';

function reinitServiceDropify(preview) {
    var $input = $('input[name="icon_file"]');
    if (!$input.length) return;
    var dr = $input.data('dropify');
    if (dr) {
        dr.resetPreview();
        dr.clearElement();
        if (preview) {
            dr.settings.defaultFile = preview;
            dr.destroy();
            $input.attr('data-default-file', preview);
            $input.dropify();
        }
    } else {
        if (preview) $input.attr('data-default-file', preview);
        $input.addClass('dropify').dropify();
    }
}

$(document).ready(function () {
    fetchServices();
    if ($('input[name="icon_file"]').length && !$('input[name="icon_file"]').data('dropify')) {
        $('input[name="icon_file"]').addClass('dropify').dropify();
    }

    $(document).on('click', '.add-service', function () {
        lastOp = 'add';
        $('input[name="hidden_service_id"]').val('');
        $('input[name="hidden_icon"]').val('');
        $('input[name="service_name"]').val('');
        $('textarea[name="description"]').val('');
        $('input[name="icon_path"]').val('');
        $('input[name="route"]').val('');
        $('input[name="sort_order"]').val('0');
        $('#svc_yes').prop('checked', true);
        reinitServiceDropify('');
        openSidebar();
    });

    $(document).on('click', '.update-service, .edit-service', function () {
        lastOp = 'update';
        $('#dataSidebarLoader').show();
        var id = $(this).attr('id') || $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/get-website-service/' + id,
            success: function (response) {
                $('#dataSidebarLoader').hide();
                var s = response.service;
                $('input[name="hidden_service_id"]').val(s.id);
                $('input[name="hidden_icon"]').val(s.icon || '');
                $('input[name="service_name"]').val(s.service_name);
                $('textarea[name="description"]').val(s.description || '');
                $('input[name="icon_path"]').val(s.icon || '');
                $('input[name="route"]').val(s.route || '');
                $('input[name="sort_order"]').val(s.sort_order || 0);
                if (s.status == 1) {
                    $('#svc_yes').prop('checked', true);
                } else {
                    $('#svc_no').prop('checked', true);
                }
                reinitServiceDropify(s.icon || '');
            }
        });
        openSidebar();
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
        var id = $(this).attr('id') || $(this).data('id');
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
        data: { _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val() },
        success: function () {
            fetchServices();
            $('#notifDiv').fadeIn().css('background', '#212529').text('Service deleted');
            setTimeout(function () { $('#notifDiv').fadeOut(); }, 3000);
        }
    });
}

function fetchServices() {
    $.get('/admin/get-website-services', function (response) {
        var $tbody = $('#servicesTable tbody');
        if (!$tbody.length) {
            $('.services-list, .website-services-list').empty();
        }
        $tbody.empty();
        (response.services || []).forEach(function (s, i) {
            $tbody.append(
                '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + (s.service_name || '') + '</td>' +
                '<td>' + (s.route || '') + '</td>' +
                '<td>' + (s.sort_order || 0) + '</td>' +
                '<td>' + (parseInt(s.status, 10) === 1 ? 'Active' : 'Inactive') + '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-sm btn-primary edit-service update-service" data-id="' + s.id + '" id="' + s.id + '">Edit</button> ' +
                '<button type="button" class="btn btn-sm btn-danger delete-service" data-id="' + s.id + '" id="' + s.id + '">Delete</button>' +
                '</td>' +
                '</tr>'
            );
        });
    });
}
