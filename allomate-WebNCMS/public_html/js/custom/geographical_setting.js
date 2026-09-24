var glob_type = '';
var deleteRef = '';
var dtrecord = '';
var city_sate_id = '';
var postal_state_id = '';
var postal_city_id = '';
$(document).ready(function () {
    $('.tabs-div').fadeIn();
    $(document).on('click', '#nav-country-tab', function () {
        $('.Product-Filter').hide();
        $('#productlist01').removeClass('openDataSidebarForAddingCities');
        $('#productlist01').removeClass('openDataSidebarForAddingStates');
        $('#productlist01').addClass('openDataSidebarForAddingCountries');
        $('#productlist01').removeClass('openDataSidebarForAddingPostalCode');
    });

    $(document).on('click', '#nav-province-tab', function () {
        $('.Product-Filter').hide();
        $('#productlist01').addClass('openDataSidebarForAddingStates');
        $('#productlist01').removeClass('openDataSidebarForAddingCities');
        $('#productlist01').removeClass('openDataSidebarForAddingCountries');
        $('#productlist01').removeClass('openDataSidebarForAddingPostalCode');
    });
    $(document).on('click', '#nav-city-tab', function () {
        $('.Product-Filter').hide();
        $('#productlist01').addClass('openDataSidebarForAddingCities');
        $('#productlist01').removeClass('openDataSidebarForAddingStates');
        $('#productlist01').removeClass('openDataSidebarForAddingCountries');
        $('#productlist01').removeClass('openDataSidebarForAddingPostalCode');
    });
    $(document).on('click', '#nav-postal-tab', function () {
        $('.Product-Filter').show();
        $('#productlist01').addClass('openDataSidebarForAddingPostalCode');
        $('#productlist01').removeClass('openDataSidebarForAddingStates');
        $('#productlist01').removeClass('openDataSidebarForAddingCountries');
        $('#productlist01').removeClass('openDataSidebarForAddingCities');
    });
    ///Open Country Form
    $(document).on('click', '.openDataSidebarForAddingCountries', function () {
        $('#dataSidebarLoader').hide();
        $('#saveCountryForm').show();
        $('#saveStateForm').hide();
        $('#saveCityForm').hide();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').addClass('saveCountry');
        $('#saveBtn').removeClass('updateCountry');
        $('#saveBtn').removeClass('saveState');
        $('#saveBtn').removeClass('updateState');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('input[name="country_name"]').focus();
        $('input[name="country_name"]').val('');
        $('input[name="country_name"]').blur();
        $('#operation').val('add_country');
        $('#page_title').text('Country');
        $('#operation_city').val('');
        $('#operation_state').val('');
        $('#operation_postalcode').val('');

    });
    $(document).on('click', '.openDataSidebarForUpdateCountry', function () {
        openSidebar();
        $('#saveCountryForm').hide();
        $('#saveStateForm').hide();
        $('#saveCityForm').hide();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').addClass('updateCountry');
        $('#saveBtn').removeClass('saveCountry');
        $('#saveBtn').removeClass('saveState');
        $('#saveBtn').removeClass('updateState');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('#operation').val('update_country');
        $('#page_title').text('Country');
        $('#dataSidebarLoader').show();
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '/admin/GetCountry/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                $('#dataSidebarLoader').hide();
                $('input[name="country_name"]').focus();
                $('input[name="country_name"]').val(response.name);
                $('input[name="country_name"]').blur();
                $('input[name="hidden_country_id"]').val(response.id);
                $('#saveCountryForm').show();
                $('#saveStateForm').hide();
                $('#saveCityForm').hide();
            }
        });

    });
    ///Open State Form
    $(document).on('click', '.openDataSidebarForAddingStates', function () {
        $('#dataSidebarLoader').hide();
        $('#saveCountryForm').hide();
        $('#saveStateForm').show();
        $('#saveCityForm').hide();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').removeClass('saveCountry');
        $('#saveBtn').removeClass('updateCountry');
        $('#saveBtn').addClass('saveState');
        $('#saveBtn').removeClass('updateState');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('#operation_state').val('add_state');
        $('#operation').val('');
        $('#operation_city').val('');
        $('#operation_postalcode').val('');
        $('select[name="country_id"]').val(0).trigger('change');
        $('input[name="state_name"]').focus();
        $('input[name="state_name"]').val('');
        $('input[name="state_name"]').blur();
        $('#page_title').text('State');

    });
    $(document).on('click', '.openDataSidebarForUpdateStates', function () {
        openSidebar();
        $('#saveCountryForm').hide();
        $('#saveStateForm').hide();
        $('#saveCityForm').hide();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').addClass('updateState');
        $('#saveBtn').removeClass('saveState');
        $('#saveBtn').removeClass('saveCountry');
        $('#saveBtn').removeClass('updateCountry');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('#operation_state').val('update_state');
        $('#dataSidebarLoader').show();
        $('#page_title').text('State');
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '/admin/GetState/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                $('#dataSidebarLoader').hide();
                $('select[name="country_id"]').val(response.country_id).trigger('change');
                $('input[name="state_name"]').focus();
                $('input[name="state_name"]').val(response.name);
                $('input[name="state_name"]').blur();
                $('input[name="hidden_state_id"]').val(response.id);
                $('#saveStateForm').show();
                $('#saveCountryForm').hide();
                $('#saveCityForm').hide();
            }
        });
    });
    //Open City Form
    $(document).on('click', '.openDataSidebarForAddingCities', function () {
        $('#dataSidebarLoader').hide();
        $('#saveStateForm').hide();
        $('#saveCountryForm').hide();
        $('#saveCityForm').show();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').removeClass('saveCountry');
        $('#saveBtn').removeClass('updateCountry');
        $('#saveBtn').removeClass('saveState');
        $('#saveBtn').removeClass('updateState');
        $('#saveBtn').addClass('saveCity');
        $('#saveBtn').removeClass('updateCity');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('#operation_city').val('add_city');
        $('#operation').val('');
        $('#operation_state').val('');
        $('#operation_postalcode').val('');
        $('select[name="country_id"]').val(0).trigger('change');
        $('select[name="state_id"]').val(0).trigger('change');
        $('input[name="city_name"]').focus();
        $('input[name="city_name"]').val('');
        $('input[name="city_name"]').blur();
        $('input[name="postal_code"]').focus();
        $('input[name="postal_code"]').val('');
        $('input[name="postal_code"]').blur();
        $('#page_title').text('City');
    });
    $(document).on('click', '.openDataSidebarForUpdateCity', function () {
        openSidebar();
        city_sate_id = $(this).attr('city-state-id');
        $('.all_states').empty();
        $('.all_states_form').empty();
        $('#saveCountryForm').hide();
        $('#saveStateForm').hide();
        $('#saveCityForm').hide();
        $('#savePostalCodeForm').hide();
        $('#saveBtn').removeClass('saveState');
        $('#saveBtn').removeClass('updateState');
        $('#saveBtn').removeClass('saveCountry');
        $('#saveBtn').removeClass('updateCountry');
        $('#saveBtn').removeClass('saveCity');
        $('#saveBtn').addClass('updateCity');
        $('#operation_city').val('update_city');
        $('#saveBtn').removeClass('savePostalCode');
        $('#saveBtn').removeClass('updatePostalCode');
        $('#dataSidebarLoader').show();
        $('#page_title').text('City');
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: '/admin/GetCity/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                $('#dataSidebarLoader').hide();
                $('select[name="country_id"]').val(response.country_id).trigger('change');
                // $('select[name="state_id"]').val(response.state_id).trigger('change');
                $('input[name="city_name"]').focus();
                $('input[name="city_name"]').val(response.name);
                $('input[name="city_name"]').blur();
                $('input[name="postal_code"]').focus();
                $('input[name="postal_code"]').val(response.postal_code);
                $('input[name="postal_code"]').blur();
                $('input[name="hidden_city_id"]').val(response.id);
                $('input[name="hidden_city_state_id"]').val(response.state_id);
                $('#saveStateForm').hide();
                $('#saveCountryForm').hide();
                $('#saveCityForm').show();
            }
        });
    });

    //Country Save
    $(document).on('click', '.saveCountry', function () {
        save_country();
    })
    $(document).on('click', '.updateCountry', function () {
        save_country();
    })
    $(document).on('click', '.saveState', function () {
        save_country();
    })
    $(document).on('click', '.updateState', function () {
        save_country();
    })
    $(document).on('click', '.saveCity', function () {
        save_country();
    })
    $(document).on('click', '.updateCity', function () {
        save_country();
    })

    function save_country() {
        var form_id;
        var url;
        if ($('#saveBtn').hasClass('saveCountry')) {
            form_id = 'saveCountryForm';
            url = '/admin/save_country';
            if (!$('input[name="country_name"]').val() || !$('input[name="country_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }
        if ($('#saveBtn').hasClass('updateCountry')) {
            form_id = 'saveCountryForm';
            url = '/admin/save_country';
            if (!$('input[name="country_name"]').val() || !$('input[name="country_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }
        if ($('#saveBtn').hasClass('saveState')) {
            form_id = 'saveStateForm';
            url = '/admin/save_country';
            if (!$('select[name="country_id"]').val() || !$('input[name="state_name"]').val() || !$('input[name="state_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }
        if ($('#saveBtn').hasClass('updateState')) {
            form_id = 'saveStateForm';
            url = '/admin/save_country';
            if (!$('select[name="country_id"]').val() || !$('input[name="state_name"]').val()  || !$('input[name="state_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }
        if ($('#saveBtn').hasClass('saveCity')) {
            form_id = 'saveCityForm';
            url = '/admin/save_country';
            if (!$('select[name="country_id"]').val() || !$('select[name="state_id"]').val() || !$('input[name="city_name"]').val() || !$('input[name="city_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }
        if ($('#saveBtn').hasClass('updateCity')) {
            form_id = 'saveCityForm';
            url = '/admin/save_country';
            if (!$('select[name="country_id"]').val() || !$('select[name="state_id"]').val() || !$('input[name="city_name"]').val() || !$('input[name="city_name"]').val().trim()) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;
            }
        }


        $(`#${form_id}`).ajaxSubmit({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (JSON.parse(response) == "success" || JSON.parse(response) == "update") {
                    $('#operation').val('');
                    $('#operation_state').val('');
                    $('input[name="country_name"]').val('');
                    $('input[name="country_name"]').focus();
                    $('input[name="city_name"]').val('');
                    $('input[name="city_name"]').focus();
                    $('input[name="country_id"]').val('');
                    $('input[name="country_id"]').focus();
                    $('input[name="state_id"]').val('');
                    $('input[name="state_id"]').focus();
                    $('input[name="state_name"]').val('');
                    $('input[name="state_name"]').focus();
                }
                if (JSON.parse(response) == "success") {
                    $('#pl-close').click();
                    var operation = $('#operation').val()
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Added successfully');
                    fetchGeoList();
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (JSON.parse(response) == "update") {
                    $('#pl-close').click();
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Updated successfully');
                    fetchGeoList();
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (JSON.parse(response) == "already_exist") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Record Already Exist');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Failed to add at this moment');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            },
            error: function (e) {
                notification(`error`, `Somthing Went Wrong`);
            }
        })
    }
    //Delete Geographical Data
    $(document).on('click', '.delete_geo', function () {
        var id = $(this).attr('id');
        glob_type = $(this).attr('name');
        $('.confirm_delete').attr('id', id);
        deleteRef = $(this);
        $('#hidden_btn_to_open_modal').click();
    })
    $(document).on('click', '.confirm_delete', function () {
        var thisRef = $(this);
        deleteRef.attr('disabled', 'disabled');
        deleteRef.text('Processing...');
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: '/admin/delete_geographical',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                type: glob_type,
                id: id
            },
            success: function (response) {
                if (JSON.parse(response) == 'success') {
                    fetchGeoList();
                    deleteRef.parent().parent().remove();
                    $('.cancel_delete_modal').click();
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Successfully deleted.');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else {
                    deleteRef.removeAttr('disabled');
                    deleteRef.text('Delete');
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Unable to delete at the moment');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        });
    });
    $('.all_countries').change(function () {
        $('.all_states').empty();
        var country_id = $(this).val();
        $.ajax({
            url: `/admin/GetStatesagianstCountry/${country_id}`,
            success: function (query) {
                $('.all_states').append(`<option>Select State</option>`);
                query.forEach((element) => {
                    $('.all_states').append(`<option value="${element['id']}">${element['name']}</option>`);
                })
            },
            error: function (e) {
                fetchGeoList();
                $('.Product-Filter').show();
            }
        });
    });
    $('.all_states').change(function () {
        $('.all_cities').empty();
        var state_id = $(this).val();
        $.ajax({
            url: `/admin/get-cities-against-state/${state_id}`,
            success: function (data) {
                $('.all_cities').append(`<option>Select City</option>`);
                data.cities.forEach((element) => {
                    $('.all_cities').append(`<option value="${element['id']}">${element['name']}</option>`);
                })
            },
            error: function (e) {
                fetchGeoList();
                $('.Product-Filter').show();
            }
        });
    });
    $('.all_cities').change(function () {
        dtrecord.clear();
        dtrecord.destroy();
        $('.postalcodeListTable tbody').empty();
        var city_id = $(this).val();
        $.ajax({
            url: `/get-postal-code-against-city/${city_id}`,
            success: function (data) {
                data.postalcodes.forEach((element, key) => {
                    $('.postalcodeListTable tbody').append(`<tr><td>${key + 1}</td><td>${element['postal_code']}</td><td>${element['city_name']}</td><td>${element['state_name']}</td><td>${element['country_name']}</td><td><button id="${element['postalcode_id']}" postal-state-id="${element['city_state']}" postal-city-id="${element['city_id']}" class="btn btn-default btn-line openDataSidebarForUpdatePostalCode">Edit</button><button id="${element['postalcode_id']}" class="btn btn-default red-bg delete_geo" name="postal_code" style="background: #e20000!important; color: #fff!important">Delete</button></td></tr>`);
                });
                dtrecord = $('.postalcodeListTable').DataTable();
                dtrecord.rows.add().draw(false);
            },
            error: function (e) {
                fetchGeoList();
                $('.Product-Filter').show();
            }
        })
    });
    // All States against Country for Add or Edit City
    $('.all_countries_form').change(function () {
        $('.all_states_form').empty();
        var country_id = $(this).val();
        $.ajax({
            url: `/admin/GetStatesagianstCountry/${country_id}`,
            success: function (query) {
                $('.all_states_form').append(`<option value="0">Select State*</option>`);
                query.forEach((element) => {
                    $('.all_states_form').append(`<option value="${element['id']}" ${city_sate_id == element.id ? 'selected' : ''} >${element['name']}</option>`);
                })
            },
            error: function (e) {
                alert('error')
            }
        });
    });


    ///Country Status Change
    $(document).on('click', '.ChangeCountryStatus', function () {
        $('.ChangeCountryStatus').attr('disabled', 'disabled');
        var thisrow = $(this);
        let change_country_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: '/admin/country-status',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: change_country_id
            },
            success: function (response) {
                $('.ChangeCountryStatus').removeAttr('disabled')
                thisrow.attr('disabled', 'disabled');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Default country updated successfully.');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }

        })
    })
});
function fetchGeoList() {
    $('.loader').show();
    $('.CountriesTbl').empty();
    $('.StatesTbl').empty();
    $('.CitiesTbl').empty();
    $('.PostalCodesTbl').empty();
    $('.Product-Filter').hide();
    $.ajax({
        type: 'GET',
        url: '/admin/GetGeoData',
        data: {
            // _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('.total_countries').text(response.total_countries);
            $('.total_states').text(response.total_states);
            $('.CountriesTbl').append('<table class="table table-hover dt-responsive nowrap countriesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Country</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.countriesListTable tbody').empty();
            response.countries.forEach((element, key) => {
                $('.countriesListTable tbody').append(`<tr><td>${key + 1}</td><td>${element['name']}</td><td><button id="${element['id']}" class="btn btn-default btn-line openDataSidebarForUpdateCountry">Edit</button><button id="${element['id']}" class="btn btn-default red-bg delete_geo" name="country">Delete</button>
                <button id="${element['id']}" class="btn btn-default  ChangeCountryStatus" country-status-default="${element['default_status']}" ${(element['default_status'] == "1" ? "disabled" : '')}>Default</button></td></tr>`);
            });
            $('.countriesListTable').fadeIn();
            $('.countriesListTable').DataTable();

            //States
            $('.StatesTbl').append('<table class="table table-hover dt-responsive nowrap statesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>State</th><th>Country</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.statesListTable tbody').empty();
            response.states.forEach((element, key) => {
                $('.statesListTable tbody').append(`<tr><td>${key + 1}</td><td>${element['name']}</td><td>${element['country_name']}</td><td><button id="${element['state_id']}" class="btn btn-default btn-line openDataSidebarForUpdateStates">Edit</button><button id="${element['state_id']}" class="btn btn-default red-bg delete_geo" name="state" style="background: #e20000!important; color: #fff!important">Delete</button></td></tr>`);
            });
            $('.statesListTable').fadeIn();
            $('.statesListTable').DataTable();

            //Cities

            $('.CitiesTbl').append('<table class="table table-hover dt-responsive nowrap citiesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>City</th><th>State</th><th>Country</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.citiesListTable tbody').empty();
            response.cities.forEach((element, key) => {
                $('.citiesListTable tbody').append(`<tr><td>${key + 1}</td><td>${element['city_name']}</td><td>${element['state_name']}</td><td>${element['countries_name']}</td><td><button id="${element['city_id']}" city-state-id="${element['city_state']}" class="btn btn-default btn-line openDataSidebarForUpdateCity">Edit</button><button id="${element['city_id']}" class="btn btn-default red-bg delete_geo" name="city">Delete</button></td></tr>`);
            });
            $('.citiesListTable').fadeIn();
            $('.citiesListTable').DataTable();

            //Postal Codes
            $('.PostalCodesTbl').append('<table class="table table-hover dt-responsive nowrap postalcodeListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Postal Code</th><th>City</th><th>State</th><th>Country</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.postalcodeListTable tbody').empty();
            response.postal_codes.forEach((element, key) => {
                $('.postalcodeListTable tbody').append(`<tr><td>${key + 1}</td><td>${element['postalcode']}</td><td>${element['city_name']}</td><td>${element['state_name']}</td><td>${element['countries_name']}</td><td><button id="${element['postalcode_id']}" postal-state-id="${element['city_state']}" postal-city-id="${element['city_id']}" class="btn btn-default btn-line openDataSidebarForUpdatePostalCode">Edit</button><button id="${element['postalcode_id']}" class="btn btn-default red-bg delete_geo" name="postal_code" style="background: #e20000!important; color: #fff!important">Delete</button></td></tr>`);
            });
            $('.postalcodeListTable').fadeIn();
            dtrecord = $('.postalcodeListTable').DataTable();
            //All Countries in select Boxs
            $('.all_countries').empty();
            $('.all_countries').append(`<option value="">Select Country</option>`);
            response.countries.forEach((element) => {
                $('.all_countries').append(`<option value="${element['id']}" >${element['name']}</option>`);
            });
            //All States in select Boxs
            $('.all_states').empty();
            $('.all_states').append(`<option value="">Select State</option>`);

            //All States in select Boxs
            $('.all_cities').empty();
            $('.all_cities').append(`<option value="">Select City</option>`);

            //All Countries in select Boxs For Edit or Add State
            $('.all_countries_form_state').empty();
            $('.all_countries_form_state').append(`<option value="0">Select Country*</option>`);
            response.countries.forEach((element) => {
                $('.all_countries_form_state').append(`<option value="${element['id']}" >${element['name']}</option>`);
            });
            //All Countries in select Boxs For Edit or Add City
            $('.all_countries_form').empty();
            $('.all_countries_form').append(`<option value="0">Select Country*</option>`);
            response.countries.forEach((element) => {
                $('.all_countries_form').append(`<option value="${element['id']}" >${element['name']}</option>`);
            });
            //All States against Country For Add or Edit City
            $('.all_states_form').empty();
            $('.all_states_form').append(`<option value="0">Select State*</option>`);


            //All Cities agianst selected state for edit or Add
            $('.all_cities_form_postal').empty();
            $('.all_cities_form_postal').append(`<option value="0">Select City*</option>`);

            $('.loader').hide();
        }
    });
}
fetchGeoList();