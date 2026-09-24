var investors = [];
var currentEmpId = 0;
$(document).ready(function () {
    fetchInvestorsList();
    geographical_data();
    var lastOp = "add";
});
$(document).on('click', '.openDataSidebarForAddingInvestors', function () {
    $('.smallTag').remove();
    openSidebar();
    $('#saveInvestorsForm')[0].reset();
    var id = $(this).attr('id');
    if (id) {
        $('#investor_id').val(id);
        $('#operation').val('update');
        var investor = investors.find(x => x.id == id);
        console.log(investors)
        console.log(id)
        if (investor) {
            console.log(investor);
            $('#country').val(investor.country).trigger('change');
            $('#first_name').val(investor.first_name);
            $('#last_name').val(investor.last_name);
            $('#phone_number').val(investor.phone);
            $('#address').val(investor.address);
            $('#email').val(investor.email);
            setTimeout(() => {
                $('#state').val(investor.state).trigger('change');
                setTimeout(() => {
                    $('#city').val(investor.city).trigger('change');
                }, 1000);
            }, 1000);
        } else {

        }
    } else {
        $('#country').val(0).trigger('change');
        $('#state').empty();
        $('#city').empty();
        $('#investor_id').val('');
        $('#operation').val('add');
    }
    $('#saveInvestorsForm input').focus().blur();
    $('#dataSidebarLoader').fadeOut();

});



$(document).on('click', '#saveInvestors', function () {
    $('.smallTag').remove();
    var count = 1;
    var dirty = false;
    $('.investor-required').each(function () {
        if (!$(this).val() || $(this).val() == 0 || $(this).val().trim() == "" || $(this).val() == undefined) {
            dirty = true;
            console.log($(this).attr('name'));
            if (count == 1) {
                $(this).focus();
                count++;
            }
        }
    });
    
    if (dirty) {
        showMessage('red', 'Please Provide all required information (*)');
        return;
    }
    if (!$('#investor_id').val() && !$('#investor_id').val().trim()) {
        if (!$('#password').val()) {
            showMessage('red', 'Password field is required');
            return;
        }
        if ($('#password').val().trim().length < 6) {
            showMessage('red', 'The Password Must be Greater Than Six Characters (*)');
            return;
        }
    }
    $('#saveInvestors').attr('disabled', 'disabled');
    $('#cancelInvestors').attr('disabled', 'disabled');
    $('#saveInvestors').text('Processing..');

    var ajaxUrl = "/admin/save-investor";
    $('#saveInvestorsForm').ajaxSubmit({
        type: 'POST',
        url: ajaxUrl,
        cache: false,
        success: function (response) {
            $('#saveInvestors').removeAttr('disabled');
            $('#cancelInvestors').removeAttr('disabled');
            $('#saveInvestors').text('Save');
            if (response.status == "success") {
                fetchInvestorsList();
                closeSidebar();
                showMessage('green', 'Investor saved successfully');
                return;
            } else if (response.status == "exist") {
                showMessage('red', 'Investor with the same email already Exist');
            } else {
                showMessage('red', 'Failed to add investor please try again later');
            }
        },
        error: function (err) {
            $('#saveInvestors').removeAttr('disabled');
            $('#cancelInvestors').removeAttr('disabled');
            $('#saveInvestors').text('Save');

            if (err.status == 422) {
                showMessage('red', 'Please Provide All Required Information in an appropriate manner');
                $('.smallTag').remove();
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    if (i == 'country_id' || i == 'city_id' || i == 'state_id') {
                        el.closest('.form-s2').after($('<small name="' + i + '" class="smallTag" style="color: red;display:block; font-size-12px;line-height:1; margin-bottom:8px    ">' + error[0] + '</small>'));
                    }
                    else {
                        el.closest('.form-group').after($('<small name="' + i + '" class="smallTag" style="color: red; display:block; font-size-12px;line-height:1; margin-bottom:8px">' + error[0] + '</small>'));
                    }
                });

            } else {
                showMessage('red', 'Failed to add investor please try again later');
                return;
            }
        }
    });

});






function fetchInvestorsList() {
    $.ajax({
        type: 'GET',
        url: '/admin/investors-records',
        success: function (response) {
            $('.body_investors').empty();
            $('.body_investors').append(`<table class="table table-hover dt-responsive nowrap mt-10" id="investorsTable" style="width:100%;">
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
            $('#investorsTable tbody').empty();
            if (response.status == 'success') {
                investors = response.investors;
                if (investors?.length) {
                    investors.forEach(element => {
                        var text = element.active ? 'Deactive' : 'Active';
                        var status = element.active ? 'Active' : 'Deactive';
                        $('#investorsTable tbody').append(`
                <tr>
                   
                
                <td>${element['id']}</td>
                <td>${element['first_name'] + ' ' + element['last_name']}</td>
                <td>${element['email']}</td>
                <td>${element['country_name'] ?? 'NA'}</td>
                <td>${element['state_name'] ?? 'NA'}</td>
                <td>${element['city_name'] ?? 'NA'}</td>
                <td>${element['phone'] ?? 'NA'}</td>
                <td id='dt-status-text-${element.id}'>${status ?? "NA"}</td>
                <td>
                <button id="${element['id']}" class="btn btn-default btn-line mb-0 openDataSidebarForAddingInvestors">Edit</button>
                <button type="button" id="${element.id}" class="btn btn-default mb-0 ${element.active ? 'red-bg' : 'btn-line'} changeStatusInvestor">${text}</button>
                </td>

                </tr>`);
                    });
                }

                $('#tblLoader').hide();
                $('.body_investors').fadeIn();
                $('#investorsTable').DataTable();
            }

        }
    });
}
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
$(document).on('click', '.changeStatusInvestor', function () {
    var id = $(this).attr('id');
    thisRef = $(this);
    thisRef.attr('disabled', true);
    thisRef.text('Processing');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: '/admin/investor-status-change',
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
            showMessage('green', `Investors Status Updated Successfully to ${d ? 'Active' : 'Deactive'}`)
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


