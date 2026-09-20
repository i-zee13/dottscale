
var segments = location.href.split('/');
$(document).on('click', '.save-contact', function () {
    var emailReg            =   /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var numberReg           =   /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
    var lettersReg          =   /^(?![\s.]+$)[a-zA-Z\s.]*$/;
    var phone               =   $('.contact_phone').val().trim();
    var first               =   $('.contact_first_name').val().trim();
    var last                =   $('.contact_last_name').val().trim();
    var email               =   $('.contact_email').val().trim();
    let dirty = false;
    let focusFields = false;
    $('.inquiry-required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
            if(focusFields == false){
                $(this).focus();
                focusFields = true;
            }
        }
    });
    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (lettersReg.test(first)==false && first != '') {
        $('.contact_first_name').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct first name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (lettersReg.test(last)==false && last != '') {
        $('.contact_last_name').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct last name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (emailReg.test(email)==false && email != '') {
        $('.contact_email').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct email');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (numberReg.test(phone)==false && phone != '') {
        $('.contact_phone').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct phone number');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    // if ($('.check-service').filter(':checked').length < 1){
    //     $('#notifDiv').fadeIn();
    //     $('#notifDiv').css('background', 'red');
    //     $('#notifDiv').text('Please Check at least one service');
    //     setTimeout(() => {
    //         $('#notifDiv').fadeOut();
    //     }, 3000);
    //     return;
    // }
    // if ($('.contact-accept-agreement').filter(':checked').length < 1){
    //     $('#notifDiv').fadeIn();
    //     $('#notifDiv').css('background', 'red');
    //     $('#notifDiv').text('Please Check Disclaimer');
    //     setTimeout(() => {
    //         $('#notifDiv').fadeOut();
    //     }, 3000);
    //     return;
    // }

    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $('#contact-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/save-contact",
        data:
            { _token: $('[name="csrf_token"]').attr('content'), page_reference : segments[3]},
        cache   :   false,
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Submit');

            if(response.status == 'success'){
                $('#contact-form')[0].reset();
                $('.form-group').removeClass('focused');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
            else{
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error: function(xhr) {
            $('#contact-form')[0].reset();
            CurrentRef.attr('disabled', false).text('Submit');
            if (xhr.status === 409) {
                $('#notifDiv').fadeIn().css('background', 'red').text(xhr.responseJSON.msg);
            }
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstError = Object.values(errors)[0][0];

                $('#notifDiv').fadeIn().css('background', 'red').text(firstError);
                setTimeout(() => $('#notifDiv').fadeOut(), 3000);
            }
            else{
                $('#notifDiv').fadeIn().css('background', 'red').text('Something went wrong. Try again later.');
            }
            setTimeout(() => $('#notifDiv').fadeOut(), 3000);
        }
    })
})