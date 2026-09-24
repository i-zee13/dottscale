var report_types = [];
var reports = [];
var currentEmpId = 0;
var segments = location.href.split('/');
$(document).ready(function () {
    if (segments[4] == 'reports-types') {
        fetchReportTypes();
        fetchBlocks();
    }
    else if (segments[4] == 'reports') {
        fetchReports();
        $('.dropify-message p:first').text('Upload Report File');
        initializeCKEditor("report_description", "200px");
    }
});
$(document).on('click', '.openDataSidebarForAddingReportsTypes', function () {
    $('.smallTag').remove();
    openSidebar();
    $('#saveReportType')[0].reset();
    var id = $(this).attr('id');
    if (id) {
        $('#report_type_id').val(id);
        $('#operation').val('update');
        var report_type = report_types.find(x => x.id == id);
        if (report_type) {
            $('#report_type').val(report_type.report_type);
        }
    } else {
        $('#report_type_id').val('');
        $('#operation').val('add');
    }
    $('#saveReportType input').focus().blur();
    $('#dataSidebarLoader').fadeOut();

});
$(document).on('click', '.openDataSidebarForAddingReports', function () {
    $('.smallTag').remove();
    $('.dropify-clear').click();
    $('#view_document_btn').remove();
    openSidebar();
    $('#saveReports')[0].reset();
    var id = $(this).attr('id');
    if (id) {
        $('#report_id').val(id);
        $('#operation').val('update');
        console.log(reports);
        var findReport = reports.find(x => x.id == id);
        if (findReport) {
            $('#report_title').val(findReport.report_title);
            $('#publish_date').val(findReport.publish_date);
            $('#hidden_report_file').val(findReport.report_file);
            $('#report_type_id').val(findReport.report_type_id).trigger('change');
            $("#publish_date").datepicker("setDate", findReport.publish_date);
            CKEDITOR.instances.report_description.setData(findReport.report_description);
            if (findReport.report_file) {
                $('#report_file').attr('data-default-file', findReport.report_file);
                $('.view_doc_div').append(`<a href="${findReport.report_file}" id="view_document_btn" class="btn btn-default btn-line mb-0 view_document_btn btn-sm" target="_blank">View Report</a>`);
            }
            $('.dropify-preview').show();
            $('#report_file').dropify();

        }
    } else {
        $('#hidden_report_file').val("");
        $('#report_type_id').val('').trigger('change');
        $('#report_id').val('');
        $('#operation').val('add');
        CKEDITOR.instances.report_description.setData("");
    }
    $('#saveReports input').focus().blur();
    $('#dataSidebarLoader').fadeOut();

});



$(document).on('click', '#saveType', function () {
    $('.smallTag').remove();
    if (!$('#report_type').val() || !$('#report_type').val().trim()) {
        showMessage('red', 'Please Provide all required information (*)');
        $('#report_type').focus();
        return;
    }
    $('#saveType').attr('disabled', 'disabled');
    $('#cancelType').attr('disabled', 'disabled');
    $('#saveType').text('Processing..');

    var ajaxUrl = "/admin/save-report-type";
    $('#saveReportType').ajaxSubmit({
        type: 'POST',
        url: ajaxUrl,
        cache: false,
        success: function (response) {
            $('#saveType').removeAttr('disabled');
            $('#cancelType').removeAttr('disabled');
            $('#saveType').text('Save');
            if (response.status == "success") {
                fetchReportTypes();
                closeSidebar();
                showMessage('green', 'Report Type saved successfully');
                return;
            } else if (response.status == "exist") {
                showMessage('red', 'Report Type with the same title already Exist');
            } else {
                showMessage('red', 'Failed to add report type please try again later');
            }
        },
        error: function (err) {
            $('#saveType').removeAttr('disabled');
            $('#cancelType').removeAttr('disabled');
            $('#saveType').text('Save');

            if (err.status == 422) {
                showMessage('red', 'Please Provide All Required Information in an appropriate manner');
                $('.smallTag').remove();
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.closest('.form-group').after($('<small name="' + i + '" class="smallTag" style="color: red; display:block; font-size-12px;line-height:1; margin-bottom:8px">' + error[0] + '</small>'));
                });

            } else {
                showMessage('red', 'Failed to add report type please try again later');
                return;
            }
        }
    });

});
$(document).on('click', '#saveReport', function () {
    $('.smallTag').remove();
    var count = 1;
    var dirty = false;
    var report_description = CKEDITOR.instances.report_description.getData();
    var fileInput = $('#report_file')[0];
    var hiddenReport = $('#hidden_report_file').val();
    $('.report-required').each(function () {
        if (!$(this).val() || $(this).val() == 0 || $(this).val().trim() == "" || $(this).val() == undefined) {
            dirty = true;
            console.log($(this).attr('name'));
            if (count == 1) {
                $(this).focus();
                count++;
            }
        }

    });
    if (!report_description) {
        dirty = true;
    }
    else if (fileInput.files.length == 0 && !hiddenReport) {
        dirty = true;
    }

    if (dirty) {
        showMessage('red', 'Please Provide All required Information (*)')
        return;
    }
    $('#saveReport').attr('disabled', 'disabled');
    $('#cancelReport').attr('disabled', 'disabled');
    $('#saveReport').text('Processing..');
    var ajaxUrl = "/admin/save-report";
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('#saveReports').ajaxSubmit({
        type: 'POST',
        url: ajaxUrl,
        cache: false,
        data: {
            report_description: report_description
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            $('#saveReport').removeAttr('disabled');
            $('#cancelReport').removeAttr('disabled');
            $('#saveReport').text('Save');
            if (response.status == "success") {
                fetchReports();
                closeSidebar();
                showMessage('green', 'Report  saved successfully');
                return;
            } else if (response.status == "exist") {
                showMessage('red', 'Report  with the same title already Exist');
            } else {
                showMessage('red', 'Failed to add report please try again later');
            }
        },
        error: function (err) {
            $('#saveReport').removeAttr('disabled');
            $('#cancelReport').removeAttr('disabled');
            $('#saveReport').text('Save');

            if (err.status == 422) {
                showMessage('red', 'Please Provide All Required Information in an appropriate manner');
                $('.smallTag').remove();
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.closest('.form-group').after($('<small name="' + i + '" class="smallTag" style="color: red; display:block; font-size-12px;line-height:1; margin-bottom:8px">' + error[0] + '</small>'));
                });

            } else {
                showMessage('red', 'Failed to add report  please try again later');
                return;
            }
        }
    });

});

function fetchReportTypes() {
    $.ajax({
        type: 'GET',
        url: '/admin/report-types-records',
        success: function (response) {
            $('.body_report_types').empty();
            $('.body_report_types').append(`<table class="table table-hover dt-responsive nowrap mt-10" id="reportTypesTable" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Report Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('#reportTypesTable tbody').empty();
            if (response.status == 'success') {
                report_types = response.reportsTypes;
                if (report_types?.length) {
                    report_types.forEach(element => {
                        var text = element.status ? 'Deactive' : 'Active';
                        var status = element.status ? 'Active' : 'Deactive';
                        $('#reportTypesTable tbody').append(`
                <tr>
                   
                
                <td>${element['id']}</td>
                <td>${element['report_type'] ?? 'NA'}</td> 
                <td id='dt-status-text-${element.id}'>${status ?? "NA"}</td>
                <td>
                <button id="${element['id']}" class="btn btn-default btn-line mb-0 openDataSidebarForAddingReportsTypes">Edit</button>
                <button type="button" entity="reportTypes" id="${element.id}" class="btn btn-default mb-0 ${element.status ? 'red-bg' : 'btn-line'} changeStatusReportTypes">${text}</button>
                </td>

                </tr>`);
                    });
                }
                $('#tblLoader').hide();
                $('.body_report_types').fadeIn();
                $('#reportTypesTable').DataTable();
            }

        }
    });
}
function fetchReports() {
    $.ajax({
        type: 'GET',
        url: '/admin/reports-records',
        success: function (response) {
            $('.body_reports').empty();
            $('.body_reports').append(`<table class="table table-hover dt-responsive nowrap mt-10" id="reportsTable" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Report Type</th>
                    <th>Report Title</th>
                    <th>Publish Date</th> 
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('#reportsTable tbody').empty();
            if (response.status == 'success') {
                reports = response.reports;
                if (reports?.length) {
                    reports.forEach(element => {
                        var text = element.status ? 'Deactive' : 'Active';
                        var status = element.status ? 'Active' : 'Deactive'; 
                        $('#reportsTable tbody').append(`
                <tr>
                <td>${element['id']}</td>
                <td>${element['report_type_name'] ?? 'NA'}</td>  
                <td>${element['report_title'] ?? 'NA'}</td>  
                <td>${element['publish_date'] ?? 'NA'}</td>  
                <td id='dt-status-text-${element.id}'>${status ?? "NA"}</td>
                <td>
                <button id="${element['id']}" class="btn btn-default btn-line mb-0 openDataSidebarForAddingReports">Edit</button> 
                <button type="button" entity="reports" id="${element.id}" class="btn btn-default mb-0 ${element.status ? 'red-bg' : 'btn-line'} changeStatusReportTypes">${text}</button>
               
                </td>

                </tr>`);
                    });
                }
                $('#tblLoader').hide();
                $('.body_reports').fadeIn();
                $('#reportsTable').DataTable();
            }

        }
    });
}
const inputElements = document.querySelectorAll('input');
function handleChange(event) {
    const changedInput = event.target;
    $('small[name="' + changedInput.name + '"]').remove();
}

inputElements.forEach(input => {
    input.addEventListener('focus', handleChange);
    input.addEventListener('change', handleChange);
});
$('.formselect').on('change', function () {
    var smallTag = $(`small[name="${$(this).attr('name')}"]`);
    if (smallTag) {
        smallTag.remove();
    }
});
$(document).on('click', '.changeStatusReportTypes', function () {
    var id       = $(this).attr('id');
    var entity   = $(this).attr('entity');
    thisRef = $(this);
    thisRef.attr('disabled', true);
    thisRef.text('Processing');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: '/admin/report-type-status-change',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            id: id,
            entity: entity,
        },
        success: function (response) {
            thisRef.attr('disabled', false);
            var d = response.status;
            console.log(d);
            showMessage('green', ` Status Updated Successfully to ${d ? 'Active' : 'Deactive'}`)
            if (d == true || d == 1) {
                thisRef.addClass('red-bg');
                thisRef.removeClass('btn-line');
                thisRef.text('Deactive');
                $(`#dt-status-text-${id}`).text('Active');
            } else {
                thisRef.removeClass('red-bg');
                thisRef.addClass('btn-line');
                thisRef.text('Active');
                $(`#dt-status-text-${id}`).text('Deactive');
            }
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        },
        error: function (response) {
            thisRef.attr('disabled', false);
            fetchReportTypes();
            showMessage('red', 'Unable to change status please try again later');
        }
    });
});


