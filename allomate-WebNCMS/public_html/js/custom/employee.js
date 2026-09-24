var employees = [];
$(document).ready(function () {
    fetchEmployeeList();
    geographical_data();
});
function fetchEmployeeList() {
    $.ajax({
        type: 'GET',
        url: '/admin/employees-records',
        success: function (response) {
            $('.bodyEmployee').empty();
            $('.bodyEmployee').append(`<table class="table table-hover dt-responsive nowrap mt-10" id="employeeTable" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>State</th> 
                    <th>City</th>
                    <th>Phone Number</th> 
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('#employeeTable tbody').empty();
            if (response.status == 'success') {
                employees = response.employees;
                if (employees?.length > 0) {
                    employees.forEach(element => {
                        var text = element.active ? 'Deactive' : 'Active';
                        var status = element.active ? 'Active' : 'Deactive';
                        $('#employeeTable tbody').append(`
                <tr> 
                <td>${element['id']}</td>
                <td>${element['name'] ?? 'NA'}</td>
                <td>${element['email'] ?? 'NA'}</td>
                <td>${element['country_name'] ?? 'NA'}</td>
                <td>${element['state_name'] ?? 'NA'}</td>
                <td>${element['city_name'] ?? 'NA'}</td>
                <td>${element['phone'] ?? 'NA'}</td>
                <td id='dt-status-text-${element.id}'>${status ?? "NA"}</td>
                <td>
                <button id="${element['id']}" class="btn btn-default btn-line mb-0 openDataSidebarForAddingEmployees">Edit</button>
                <button type="button" id="${element.id}" class="btn btn-default mb-0 ${element.active ? 'red-bg' : 'btn-line'} changeStatusEmployee">${text}</button>
                </td> 
                </tr>`);
                    });
                }
                $('#tblLoader').hide();
                $('.bodyEmployee').fadeIn();
                $('#employeeTable').DataTable();
            }

        }
    });
}
$(document).on('click', '.openDataSidebarForAddingEmployees', function () {
    var id = $(this).attr('id');
    $('#dropifyImgDiv').empty();
    $('#dropifyImgDiv').append('<input type="file" name="employeePicture" id="employeePicture" accept="image/*"data-allowed-file-extensions="jpg png jpeg tif tiff pjp xbm jxl jfif bmp avif ico gif" />');
    $('#employeePicture').dropify();
    $('#saveEmployeeForm')[0].reset();
    if (id) {
        $('#employee_id').val(id);
        var data = employees.find(x => x.id == id);
        if (data) {
            console.log(data);
            $('#country').val(data.country_id).trigger('change');
            setTimeout(() => {
                $('#state').val(data.state_id).trigger('change');
            }, 1000);
            setTimeout(() => {
                $('#city').val(data.city_id).trigger('change');
            }, 2000);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#id_no').val(data.cnic);
            $('#phone_number').val(data.phone);
            $('#username').val(data.username);
            $('#designation').val(data.designation).trigger('change');
            $('#department').val(data.department_id).trigger('change');
            $('#reporting').val(data.reporting_to).trigger('change');
            $('#address').val(data.address);
            if (data.hiring) {
                $('#hiring').val(data.hiring).datepicker("setDate", data.hiring).focus().blur();;
            }
            if (data.picture) {
                $('#employeePicture').attr('data-default-file', data.picture);
                var dropifyPreviewWrapper = $('#employeePicture').closest('.dropify-wrapper');
                var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
                dropifyPreview.css('display', 'block');
                dropifyPreview.find('.dropify-render').html(`<img src="${data.picture}" alt="Preview Image">`);
            }
            $('#employeePicture').dropify();
            $('#saveEmployeeForm input').focus().blur();
        }
    } else {
        $('#employee_id').val('');
    }
    openSidebar();
    $('#dataSidebarLoader').hide();
});
country = $('#hidden_country').val();
state = $('#hidden_state').val();
city = $('#hidden_city').val();
function geographical_data() {
    $.ajax({
        url: '/admin/get-countries',
        success: function (response) {
            $("#country").append(`<option value="0">Select Country</option>`)
            $("#state").append(`<option value="0">Select State</option>`)
            $("#city").append(`<option value="0">Select City</option>`)
            response.result.countries.forEach(data => {
                $("#country").append(
                    `<option data-id="${data.id}" value="${data.id}">${data.name}</option>`
                )
            })
        },
    });
}
$("#country").change(function () {
    $('#state').empty();
    $('#city').empty();
    var country_id = $(this).val();
    $.ajax({
        url: `/admin/get-state-against-country/${country_id}`,
        success: function (response) {
            $("#state").append(`<option value="0">Select State</option>`);
            $.when(response.states.forEach(data => {
                $("#state").append(`<option value="${data.id}">${data.name}</option>`)
            })).then(function () {
                if (state) {
                    $('#state').val(state).trigger('change');
                }
            })
        }
    });
})
$("#state").change(function () {
    $('#city').empty();
    var city_id = $(this).val();
    $.ajax({
        url: `/admin/get-city-against-states/${city_id}`,
        success: function (response) {
            $("#city").append(`<option value="0">Select City</option>`);
            $('select[name="city_id"]').val('-1').trigger('change');
            $.when(response.cities.forEach(data => {
                $("#city").append(`<option value="${data.id}">${data.name}</option>`)
            })).then(function () {
                if (city) {
                    $('#city').val(city).trigger('change');
                }
            })
        }
    });
})
$(document).on('click', '#saveEmployee', function () {
    var dirty = false;
    var count = 1;
    $('.employee-required').each(function () {
        if (!$(this).val() || $(this).val() == 0 || $(this).val().trim() == "" || $(this).val() == undefined) {
            dirty = true;
            console.log($(this).attr('name'));
            if (count == 1) {
                $(this).focus();
                count++;
            }
        }
    });

    if (dirty == true) {
        showMessage('red', 'Please Provide All required Information');
        return
    }
    if ($('#email').val()) {
        if (!emailValidate($('#email').val())) {
            showMessage('red', 'Email Formate is Invalid')
            $('#email').focus();
            return;
        }

    }
    if (!$('#employee_id').val().trim()) {
        if (!$('#password').val()) {
            showMessage('red', 'Password field is required');
            return;
        }
        if ($('#password').val().trim().length < 6) {
            showMessage('red', 'The Password Must be Greater Than Six Characters (*)');
            return;
        }
    }
    const curentRef = $(this);
    curentRef.removeAttr('disabled', true);
    curentRef.text('Processing...');
    var ajaxUrl = "/admin/save-employee";
    $('#saveEmployeeForm').ajaxSubmit({
        type: 'POST',
        url: ajaxUrl,
        cache: false,
        success: function (response) {
            curentRef.removeAttr('disabled');
            curentRef.text('Save');
            if (response.status == "success") {
                fetchEmployeeList();
                closeSidebar();
                showMessage('green', 'Employee Added Successfully');
                return;
            } else if (response.status == 'username_exist' || response.status == 'email_exists') {
                showMessage('red', response.msg);
                return;
            }
            else {
                showMessage('red', 'Failed to add Employee. Please try again later');
            }
        },
        error: function (err) {
            curentRef.removeAttr('disabled');
            $('#cancelType').removeAttr('disabled');
            curentRef.text('Save');

            if (err.status == 422) {
                showMessage('red', 'Please Provide All Required Information in an appropriate manner');
                $('.smallTag').remove();
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    if (i == 'country' || i == 'city' || i == 'state') {
                        el.closest('.form-s2').after($('<small name="' + i + '" class="smallTag" style="color: red;display:block; font-size-12px;line-height:1; margin-bottom:8px    ">' + error[0] + '</small>'));
                    }
                    else {
                        el.closest('.form-group').after($('<small name="' + i + '" class="smallTag" style="color: red; display:block; font-size-12px;line-height:1; margin-bottom:8px">' + error[0] + '</small>'));
                    }
                });

            } else {
                showMessage('red', 'Failed to add employee please try again later');
                return;
            }
        }
    });


});
$(document).on('click', '.changeStatusEmployee', function () {
    var id = $(this).attr('id');
    thisRef = $(this);
    thisRef.attr('disabled', true);
    thisRef.text('Processing');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: '/admin/employee-status-change',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            id: id,
        },
        success: function (response) {
            thisRef.attr('disabled', false);
            var d = response.status;
            console.log(d);
            showMessage('green', `Employee Status Updated Successfully to ${d ? 'Active' : 'Deactive'}`)
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
            fetchInvestorsList();
            showMessage('red', 'Unable to change status please try again later');
        }
    });
});