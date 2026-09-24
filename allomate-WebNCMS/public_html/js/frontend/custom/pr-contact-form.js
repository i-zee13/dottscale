var segments = location.href.split('/');

$(document).on('click', '.pr-form-submit', function () {
    var btn_attr    =   $(this).attr('data-btn');
    var emailReg    =   /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var numberReg   =   /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
    var lettersReg  =   /^(?![\s.]+$)[a-zA-Z\s.]*$/;
    var phone       =   $(`#phone`).val().trim();
    var first       =   $(`#firstName`).val();
    var last        =   $(`#lastName`).val();
    var email       =   $(`#email`).val();
    let dirty       =   false;
    let field_focus =   false;
    $(`.pr-form-required`).each(function () {
        var selectedID  =   $(this).attr('id');
        if (!$(this).val() || $(this).val() == 0 || !$(this).val().trim()) {
            dirty = true;
            if (field_focus == false) {
                $(this).focus();
                field_focus = true;
            }
            $(`.${selectedID}-error`).show();
        }else{
            $(`.${selectedID}-error`).hide();
        }
    });
    if (dirty) {
        return;
    }
    if (lettersReg.test(first) == false && first != '') {
        $(`input[name="first_name"]`).focus();
        $(`.firstName-error`).show();
        return;
    }
    if (lettersReg.test(last) == false && last != '') {
        $(`input[name="last_name"]`).focus();
        $(`.lastName-error`).show();
        return;
    }
    if (emailReg.test(email) == false && email != '') {
        $(`input[name="email"]`).focus();
        $(`.email-error`).show();
        return;
    }
    // if (numberReg.test(phone) == false && phone != '') {
    //     $(`#phone`).focus();
    //     $('#notifDiv').fadeIn();
    //     $('#notifDiv').css('background', 'red');
    //     $('#notifDiv').text('Please enter a valid phone number');
    //     setTimeout(() => {
    //         $('#notifDiv').fadeOut();
    //     }, 3000);
    //     return;
    // }
    if ($(`#pr-form-checkbox`).filter(':checked').length < 1) {
        $(`.pr-form-checkbox-error`).show();
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    CurrentRef.attr('style', 'color:white!important');
    $(`#propertForm`).ajaxSubmit({
        type: "POST",
        url: "/save-pr-contact",
        data:
        {
            _token: $('[name="csrf_token"]').attr('content'),
            page_reference: segments[3] == '' ? 'home' : segments[3],
        },
        cache: false,
        success: function (response) {
            console.log('after submit');
            CurrentRef.attr('disabled', false);
            CurrentRef.removeAttr('style');
            CurrentRef.text('Submit');
            if (response.msg == 'form_submit') {
                $(`#propertForm`)[0].reset();
                $('.invalid-feedback').hide();
                $('.form-group').removeClass('focused');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Your request has been successfully submitted! A member of our team will be in touch with you shortly. Thank you for choosing Allomate Solutions!');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                return;

            }
            else {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('An unknown error occurred. Please try again later');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    })
});

$(document).on('input keyup change','.pr-form-required',function(){
    var selectedID  =   $(this).attr('id');
    if(($(this).hasClass('pr-form-required')) && ($(this).val() == '' || $(this).val() == 0) ){
        $(`.${selectedID}-error`).show();
    }else{
        $(`.${selectedID}-error`).hide();
    }
});
