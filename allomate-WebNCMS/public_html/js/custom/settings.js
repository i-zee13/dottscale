

var segments = location.href.split('/');
var last_operation = 'add';
var opp_name = '';

var all_attributes = [];
var all_properties = [];
var all_brands = [];

var glob_type = '';
var deleteRef = '';


$('#dataSidebarLoader').hide();
$(document).ready(function () {
    fetchAllData();
    $(".loader").hide();
    $('.first-pill').show();
});

$(document).on('click', '.save_form', function () {
    const currentRef = $(this);
    var contentInput = currentRef.closest('.tab-pane').find('form').find('textarea[name="content"]');
    var contentForm = currentRef.closest('.tab-pane').find('form');
    var contentFormID = contentForm.attr('id');
    if (!contentInput.val() || !contentInput.val().trim()) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please Provide Required Information(*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    currentRef.attr('disabled', 'disabled');
    currentRef.text('Processing..');

    $(`#${contentFormID}`).ajaxSubmit({
        type: "POST",
        url: '/admin/save-theme-css',
        cache: false,
        success: function (response) {
            currentRef.removeAttr('disabled');
            currentRef.text('Save');

            if (response.status == "success") {
                getAllContent();
                $('#notifDiv').text('Saved Successfully!');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
            else {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Failed to save at the moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error: function (err) {
            currentRef.removeAttr('disabled');
            currentRef.text('Save');
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Failed to save at this moment');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        }
    });

});
 
function getAllContent() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'get',
        url: '/admin/get-all-css-config',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            if (response.status == 'success') {
                if (response.themeData) {
                    for (const key in response.themeData) {
                        if (response.themeData.hasOwnProperty(key)) {
                            response.themeData[key].forEach(element => {
                                $(`#content-id-${key}`).val(element.id ?? '');
                                $(`#content-${key}`).val(element.content ?? '');
                            });
                        }
                    }
                }

            }
        }
    });
}
$(document).on('click', '.openDataSidebarForAddingDesignation', function () {

    if (last_operation == 'update') {
        $('input[name="designation_name"]').val('');
        $('input[name="designation_name"]').blur();

        $('.custom_checkbox').prop('checked', false);
    }
    $('#opp_name').text('Designation');
    $('.designation_form_div').show();
    $('.department_form_div').hide();
    $('.event_type_div').hide();
    $('.vendorType_form_div').hide();
    $('.leaveType_form_div').hide();
    $('.industry_form_div').hide();
    $('.attribute_form_div').hide();
    $('.attribute_assignment_form_div').hide();
    $('.relation_form_div').hide();
    $('.brands_form_div').hide();
    $('.tax_class_form_div').hide();
    $('.gross_class_form_div').hide();
    openSidebar();
    last_operation = 'add';
    opp_name = 'designation';
    $('#operation').val('add');
    $('#opp_name_input').val('designation');
});
$(document).on('click', '.openDataSidebarForAddingDepartment', function () {
    if (last_operation == 'update') {
        $('input[name="department_name"]').val('');
        $('input[name="department_name"]').blur();
    }
    $('#opp_name').text('Department');
    $('.designation_form_div').hide();
    $('.department_form_div').show();
    $('.event_type_div').hide();
    $('.vendorType_form_div').hide();
    $('.leaveType_form_div').hide();
    $('.industry_form_div').hide();
    $('.attribute_form_div').hide();
    $('.tax_class_form_div').hide();
    $('.gross_class_form_div').hide();
    $('.attribute_assignment_form_div').hide();
    $('.relation_form_div').hide();
    $('.brands_form_div').hide();
    openSidebar();
    last_operation = 'add';
    opp_name = 'department';
    $('#operation').val('add');
    $('#opp_name_input').val('department');
});
$(document).on('click', '.openDataSidebarForUpdatedepartment', function () {
    var id = $(this).attr('id');
    $('#dataSidebarLoader').show();
    $('.designation_form_div').hide();
    $('.vendorType_form_div').hide();
    $('.event_type_div').hide();
    $('.leaveType_form_div').hide();
    $('.tax_class_form_div').hide();
    $('.gross_class_form_div').hide();
    $('.industry_form_div').hide();
    $('.attribute_form_div').hide();
    $('.attribute_assignment_form_div').hide();
    $('.relation_form_div').hide();
    $('.brands_form_div').hide();
    $('#opp_name').text('Department');
    $('#opp_id').val(id);
    openSidebar();
    last_operation = 'update';
    opp_name = 'department';
    $('#operation').val('update');
    $('#opp_name_input').val('department');
    $.ajax({
        type: 'GET',
        url: '/admin/GetDepartment/' + id,
        success: function (response) {
            var response = JSON.parse(response);
            $('#dataSidebarLoader').hide();
            $('._cl-bottom').show();
            $('.pc-cartlist').show();

            $('input[name="department_name"]').focus();
            $('input[name="department_name"]').val(response.department);
            $('input[name="department_name"]').blur();

            $('.designation_form_div').hide();
            $('.department_form_div').show();
            $('.vendorType_form_div').hide();
            $('.leaveType_form_div').hide();
            $('.tax_class_form_div').hide();
            $('.gross_class_form_div').hide();
            $('.industry_form_div').hide();
            $('.event_type_div').hide();
            $('.attribute_form_div').hide();
            $('.attribute_assignment_form_div').hide();
            $('.relation_form_div').hide();
            $('.brands_form_div').hide();
        }
    });
});
$(document).on('click', '.openDataSidebarForUpdateDesignation', function () {
    var id = $(this).attr('id');
    $('#dataSidebarLoader').show();
    $('.designation_form_div').hide();
    $('.department_form_div').hide();
    $('.vendorType_form_div').hide();
    $('.leaveType_form_div').hide();
    $('.tax_class_form_div').hide();
    $('.gross_class_form_div').hide();
    $('.industry_form_div').hide();
    $('.event_type_div').hide();
    $('.attribute_form_div').hide();
    $('.attribute_assignment_form_div').hide();
    $('.relation_form_div').hide();
    $('.brands_form_div').hide();
    $('#opp_name').text('Designation');
    $('#opp_id').val(id);
    $('.custom_checkbox').prop('checked', false);
    openSidebar();
    last_operation = 'update';
    opp_name = 'designation';
    $('#operation').val('update');
    $('#opp_name_input').val('designation');
    $.ajax({
        type: 'GET',
        url: '/admin/GetDesignation/' + id,
        success: function (response) {
            var response = JSON.parse(response);
            $('#dataSidebarLoader').hide();
            $('._cl-bottom').show();
            $('.pc-cartlist').show();

            $('input[name="designation_name"]').focus();
            $('input[name="designation_name"]').val(response.designation);
            $('input[name="designation_name"]').blur();

            if (response.designation_rights) {
                $('.custom_checkbox').each(function () {
                    if (JSON.parse(response.designation_rights).includes($(this).attr('id'))) {
                        $(this).prop('checked', true);
                    }
                });
            }

            $('.designation_form_div').show();
            $('.department_form_div').hide();
            $('.vendorType_form_div').hide();
            $('.leaveType_form_div').hide();
            $('.industry_form_div').hide();
            $('.attribute_form_div').hide();
            $('.tax_class_form_div').hide();
            $('.gross_class_form_div').hide();
            $('.attribute_assignment_form_div').hide();
            $('.relation_form_div').hide();
            $('.brands_form_div').hide();
        }
    });
});
$(document).on('click', '#saveBtn', function () {
    var invalidSave = [];
    var designation_rights = [];
    console.log(opp_name)
    if (opp_name == 'designation') {
        $('.required_designation').each(function () {
            if (!$(this).val()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                invalidSave.push(true);
            } else {
                invalidSave.push(false);
            }
        });
        $('.custom_checkbox').each(function () {
            if ($(this).prop('checked')) {
                designation_rights.push($(this).attr('id'));
            }
        });
    } else if (opp_name == 'department') {
        $('.required_department').each(function () {
            if (!$(this).val()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                invalidSave.push(true);
            } else {
                invalidSave.push(false);
            }
        });
    }
    if (invalidSave.includes(true)) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;

    }

    $('#saveBtn').attr('disabled', 'disabled');
    $('#btn-cancel').attr('disabled', 'disabled');
    $('#saveBtn').text('Processing..');

    $('#saveSettingsForm').ajaxSubmit({
        type: "POST",
        url: '/admin/save_settings',
        cache: false,
        success: function (response) {
            $('#saveBtn').removeAttr('disabled');
            $('#btn-cancel').removeAttr('disabled');
            $('#saveBtn').text('Save');

            if (JSON.parse(response) == "success") {
                fetchAllData();
                $('#notifDiv').text('Saved Successfully!');
                if ($('#operation').val() == "add") {
                    $('input[name="designation_name"]').val('');
                    $('input[name="department_name"]').val('');
                    $('#pl-close').click();
                }
                closeSidebar();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            } else if (JSON.parse(response) == "already_exist") {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Already Exist!');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            } else {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Failed to save at the moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error: function (err) {
            $('#saveBtn').removeAttr('disabled');
            $('#btn-cancel').removeAttr('disabled');
            $('#saveBtn').text('Save');
            if (err.status == 422) {
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<small style="color: red; position: absolute; width:100%; text-align: right; margin-left: -30px">' + error[0] + '</small>'));
                });
            }
        }
    });

});

$(document).on('click', '.delete_btn', function () {
    var id = $(this).attr('id');
    glob_type = $(this).attr('name');
    $('.confirm_delete').attr('id', id);
    $('.confirm_delete').attr('name', glob_type);
    deleteRef = $(this);
    $('#hidden_btn_to_open_modal').click();
});
$(document).on('click', '.confirm_delete', function () {
    var type = $(this).attr('name');
    var id = $(this).attr('id');
    var thisRef = $(this);
    thisRef.attr('disabled', 'disabled');
    thisRef.text('Processing...');
    $.ajax({
        type: "POST",
        url: '/admin/delete_from_settings',
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            'type': type,
            'id': id
        },
        cache: false,
        success: function (response) {
            thisRef.removeAttr('disabled');
            thisRef.text('Delete');
            $('.cancel_delete_modal').click();
            console.log(JSON.parse(response));
            if (JSON.parse(response) == 'success') {
                deleteRef.parent().parent().remove();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Deleted successfully');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);

            } else {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Failed to delete at the moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error: function (err) {
            thisRef.removeAttr('disabled');
            thisRef.text('Delete');
            if (err.status == 422) {
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<small style="color: red; position: absolute; width:100%; text-align: right; margin-left: -30px">' + error[0] + '</small>'));
                });
            }
        }
    });
});

function fetchAllData() {
    $('.loader').show();
    $('.body_designations').hide();
    $('.body_departments').hide();
    
    all_attributes = [];
    all_properties = [];
    all_brands = [];
    all_currencies = [];

    $.ajax({
        type: 'GET',
        url: '/admin/GetSettingsData',
        success: function (response) {
            console.log(response);
       
            var response = JSON.parse(response);
            $('.body_designations').empty();
            $('.body_designations').append('<table class="table table-hover dt-responsive nowrap" id="designationsTable" style="width:100%;"><thead><tr><th>ID</th><th>Designation</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('#designationsTable tbody').empty();
            response.designations.forEach(element => {
                $('#designationsTable tbody').append(`<tr><td>${element['id']}</td><td>${element['designation']}</td><td><button id="${element['id']}" class="btn btn-default btn-line openDataSidebarForUpdateDesignation">Edit</button>
                <button type="button" id="${element['id']}" class="btn btn-default red-bg delete_btn" name="designation" title="Delete">Delete</button></td></tr>`);
            });
            $('.body_designations').fadeIn();
            $('#designationsTable').DataTable();

            $('.body_departments').empty();
            $('.body_departments').append('<table class="table table-hover dt-responsive nowrap" id="departmentsTable" style="width:100%;"><thead><tr><th>ID</th><th>Department</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('#departmentsTable tbody').empty();
            response.departments.forEach(element => {
                $('#departmentsTable tbody').append(`<tr><td>${element['id']}</td><td>${element['department']}</td><td><button id="${element['id']}" class="btn btn-default btn-line openDataSidebarForUpdatedepartment">Edit</button><button type="button" id="${element['id']}" class="btn btn-default red-bg delete_btn" name="departments" title="Delete">Delete</button></td></tr>`);
            });
            $('.body_departments').fadeIn();
            $('#departmentsTable').DataTable();


            $('.loader').hide();
        }
    });
}



