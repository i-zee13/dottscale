var alreadyExistingRights = [];
var currentEmpId = 0;
$(document).ready(function () {

    fetchAccessRights();
    var lastOp = "add";
    
    $(document).on('click', '.openDataSidebarForAddingAccessRights', function () {
        $('#employee_id_hidden').val("");
        var all_employees_rights    =   $('.employee_list').val();
        var All_employees           =   [];
        if(all_employees_rights){
            All_employees           =   JSON.parse(all_employees_rights);
        }
        if (All_employees) {
            console.log(All_employees);
            console.log(alreadyExistingRights);
            All_employees = All_employees.filter(employee => !alreadyExistingRights.some(right => right.employee_id === employee.id));
            console.log(All_employees);
            var selectElement = $('select[name="employee_id"]');
            selectElement.empty();
            var option = $('<option>', {
                value: '',
                text: 'Select Employee'
            });
            selectElement.append(option);
            All_employees.forEach(employee => {
                var option = $('<option>', {
                    value: employee.id,
                    text: employee.username
                });
                selectElement.append(option);
            });
        }
        $('#dataSidebarLoader').hide();
        $('.employee_id').val('0').trigger('change');
        $('[name="rights[]"]').prop('checked', false);
        $('input[id="operation"]').val('add');
        openSidebar();
        $('#employeesRow').show();
    });

    $(document).on('click', '.openDataSidebarForUpdateAccessRights', function () {
        $('[name="rights[]"]').prop('checked', false);
        $('#dataSidebarLoader').show();
        $('._cl-bottom').hide();
        $('.pc-cartlist').hide();

        $('input[id="operation"]').val('update');
        openSidebar();

        $('#employeesRow').hide();

        currentEmpId = $(this).attr('id');
        console.log(currentEmpId);
        $('#employee_id_hidden').val(currentEmpId);
        $.ajax({
            type: "GET",
            url: '/admin/employee-AccessRights/' + currentEmpId,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response)
                response.forEach(element => {
                    $('input[value="' + element["controller_right"] + '"]').prop('checked', true);
                });

                $('#dataSidebarLoader').hide();
                $('._cl-bottom').show();
                $('.pc-cartlist').show();
            }
        });

    });

    $(document).on('click', '#saveRights', function () {
        var rights = [];

        $('.access_rights_emp').each(function () {
            if ($(this).prop('checked') == true) {
                rights.push($(this).val());
            }
        });
        if($('#operation').val() == "add"){
            if($('select[name="employee_id"]').val() == null || $('select[name="employee_id"]').val() == ''){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please Select Employee');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return
            }
        }
        if($('#operation').val() == "update"){
            if($('#employee_id_hidden').val() == "" || $('#employee_id_hidden').val() == null){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Employee not found');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return
            }
        }
        if (rights.length == 0) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please Select Access Rights');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return
        }
        $('#saveRights').attr('disabled', 'disabled');
        $('#cancelRights').attr('disabled', 'disabled');
        $('#saveRights').text('Processing..');

        var ajaxUrl = "/admin/employee-AccessRights";
        if ($('#operation').val() !== "add") {
            ajaxUrl = "/admin/employee-AccessRights/" + currentEmpId;
        }

        $('#saveRightsForm').ajaxSubmit({
            type: $('#operation').val() !== "add" ? "PUT" : "POST",
            url: ajaxUrl,

            cache: false,
            success: function (response) {
                if (response == "success") {
                    fetchAccessRights();
                    closeSidebar();

                    $('#saveRights').removeAttr('disabled');
                    $('#cancelRights').removeAttr('disabled');
                    $('#saveRights').text('Save');

                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Access Rights have been assigned successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (JSON.parse(response) == "exist") {
                    $('#saveRights').removeAttr('disabled');
                    $('#cancelRights').removeAttr('disabled');
                    $('#saveRights').text('Save');
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Rights already given. Please update this employee\'s existing rights');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else {
                    $('#saveRights').removeAttr('disabled');
                    $('#cancelRights').removeAttr('disabled');
                    $('#saveRights').text('Save');
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Failed to add rights at the moment');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
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

    $(document).on('click', '.deleteAccessRight', function () {
        var typeId = $(this).attr('id');
        var thisRef = $(this);
        thisRef.attr('disabled', 'disabled');
        $.ajax({
            type: "GET",
            url: '/admin/employee-revokeAccRight/' + typeId,
            data: thisRef.parent().serialize(),
            cache: false,
            success: function (response) {
                if (JSON.parse(response) == "success") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Access Rights have been revoked');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    console.log(typeId);
                    alreadyExistingRights = alreadyExistingRights.filter(x => (x.employee_id != typeId));
                    console.log(alreadyExistingRights);
                    thisRef.parent().parent().remove();
                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Unable to revoke rights at this moment');
                    setTimeout(() => {
                        thisRef.removeAttr('disabled');
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        });
    });
    $(document).on('click', '.access_rights_headings', function () {
        var this_heading = $(this).attr('heading');
        if ($(this).prop('checked') == true) {
            $('.access_rights_emp').each(function () {
                if ($(this).attr('heading') == this_heading) {
                    $(this).prop('checked', true);
                }
            })
        } else {
            $('.access_rights_emp').each(function () {
                if ($(this).attr('heading') == this_heading) {
                    $(this).prop('checked', false);
                }
            })
        }
    })
    $(document).on('click', '.all_rights', function () {
        if ($(this).prop('checked') == true) {
            $('.access_rights_headings').each(function () {
                $(this).prop('checked', true);
            })
            $('.access_rights_emp').each(function () {
                $(this).prop('checked', true);
            })
        } else {
            $('.access_rights_headings').each(function () {
                $(this).prop('checked', false);
            })
            $('.access_rights_emp').each(function () {
                $(this).prop('checked', false);
            })
        }

    })
});

function fetchAccessRights() {
    $.ajax({
        type: 'GET',
        url: '/admin/employee-listAllRights',
        success: function (response) {
            $('.body').empty();
            $('.body').append('<table class="table table-hover dt-responsive nowrap rightsTable" style="width:100%;"><thead><tr><th>S.No</th><th>Employee</th><th>Total Rights</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.rightsTable tbody').empty();
            var response = JSON.parse(response);
            var sNo = 1;
            response.forEach(element => {
                console.log(element);
                $('.rightsTable tbody').append('<tr><td>' + sNo++ + '</td><td>' + element['name'] + '</td><td>' + element['total_rights'] + '</td><td><button id="' + element['admin_id'] + '" class="btn btn-default btn-line openDataSidebarForUpdateAccessRights">Update</button><button type="button" id="' + element['admin_id'] + '" class="btn btn-default red-bg deleteAccessRight" title="Revoke">Revoke</button></td></tr>');
                alreadyExistingRights.push({ 'employee_id': element['admin_id'] });
            });
            $('#tblLoader').hide();
            $('.body').fadeIn();
            $('.rightsTable').DataTable()
        }
    });
}