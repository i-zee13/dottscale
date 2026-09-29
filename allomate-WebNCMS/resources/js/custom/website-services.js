var lastOp = '';
$(document).ready(function () {
    fetchServices();

    $(document).on('click', '.add-service', function () {
        lastOp = 'add';
        $('input[name="hidden_service_id"]').val('');
        $('input[name="hidden_icon"]').val('');
        $('input[name="service_name"]').val('');
        $('textarea[name="description"]').val('');
        $('input[name="icon"]').val('');
        $('input[name="route"]').val('');
        $('input[name="sort_order"]').val('0');
        $('#svc_yes').prop('checked', true);
        $('input[name="icon_file"]').val('');
        openSidebar();
    });

    $(document).on('click', '.update-service', function () {
        lastOp = 'update';
        $('#dataSidebarLoader').show();
        var id = $(this).attr('id');
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
                $('input[name="icon"]').val(s.icon || '');
                $('input[name="route"]').val(s.route || '');
                $('input[name="sort_order"]').val(s.sort_order || 0);
                if (s.status == 1) {
                    $('#svc_yes').prop('checked', true);
                } else {
                    $('#svc_no').prop('checked', true);
                }
            }
        });
        openSidebar();
    });

    $(document).on('click', '#saveService', function () {
        if (!$('input[name="service_name"]').val() || !$('input[name="service_name"]').val().trim()) {
            $('#notifDiv').fadeIn().css('background', 'red').text('Service name is required');
            setTimeout(() => $('#notifDiv').fadeOut(), 3000);
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
                    $('#notifDiv').fadeIn().css('background', 'green').text('Service saved');
                    setTimeout(() => $('#notifDiv').fadeOut(), 3000);
                    closeSidebar();
                } else if (response.msg == 'duplicate') {
                    $('#notifDiv').fadeIn().css('background', 'red').text('Service already exists');
                    setTimeout(() => $('#notifDiv').fadeOut(), 3000);
                }
            },
            error: function () {
                $('#saveService').removeAttr('disabled').text('Save');
                $('#notifDiv').fadeIn().css('background', 'red').text('Failed to save');
                setTimeout(() => $('#notifDiv').fadeOut(), 3000);
            }
        });
    });

    $(document).on('click', '.delete-service', function () {
        var id = $(this).attr('id');
        swal({
            title: 'Are you sure?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/delete-website-service/' + id,
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        fetchServices();
                    }
                });
            }
        });
    });
});

function fetchServices() {
    $.ajax({
        type: 'GET',
        url: '/admin/get-website-services',
        success: function (response) {
            $('.body').empty().append(
                '<table class="table table-hover dt-responsive nowrap servicesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Service</th><th>Route</th><th>Order</th><th>Status</th><th>Action</th></tr></thead><tbody></tbody></table>'
            );
            (response.services || []).forEach((el, key) => {
                $('.servicesListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${el.service_name || ''}</td>
                        <td>${el.route || ''}</td>
                        <td>${el.sort_order || 0}</td>
                        <td>${el.status == 1 ? 'Active' : 'Deactive'}</td>
                        <td>
                            <button id="${el.id}" class="btn btn-default btn-line update-service">Edit</button>
                            <button type="button" id="${el.id}" class="btn btn-default red-bg delete-service">Delete</button>
                        </td>
                    </tr>`);
            });
            $('#tblLoader').hide();
            $('.body').fadeIn();
            $('.servicesListTable').DataTable();
        }
    });
}
