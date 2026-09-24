
$(document).on('click', '.submit-subscriber-form', function () {
    var emailReg            =   /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var lettersReg          =   /^(?![\s.]+$)[a-zA-Z\s.]*$/;
    var form_name           =   $('.sub_form_name').val().trim();
    var form_email          =   $('.sub_form_email').val().trim();
    let dirty = false;
    $('.subscription-required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
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

    if (lettersReg.test(form_name)==false && form_name != '') {
        $('.sub_form_name').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }

    if (emailReg.test(form_email)==false && form_email != '') {
        $('.sub_form_email').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct email');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }

    var CurrentRef = $(this);
    CurrentRef.addClass('disabled-link');
    CurrentRef.text('Processing...');
    $('#subscriber-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/save-subscription-form",
        data:
            { _token: $('[name="csrf_token"]').attr('content')},
        cache   :   false,
        success :   function(response){
            CurrentRef.removeClass('disabled-link');
            CurrentRef.text('Subscribe');
            if(response.status == 'success'){
                $('#subscriber-form')[0].reset();
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
            CurrentRef.removeClass('disabled-link');
            $('#subscriber-form')[0].reset();
            CurrentRef.attr('disabled', false).text('Subscribe');
            if (xhr.status === 409) {
                $('#notifDiv').fadeIn().css('background', 'red').text(xhr.responseJSON.msg);
            }
            // if (xhr.status === 422) {
            //     let errors = xhr.responseJSON.errors;
            //     let firstError = Object.values(errors)[0][0];

            //     $('#notifDiv').fadeIn().css('background', 'red').text(firstError);
            //     setTimeout(() => $('#notifDiv').fadeOut(), 3000);
            // } else {
            // }
            else{
                $('#notifDiv').fadeIn().css('background', 'red').text('Something went wrong. Try again later.');
            }
            setTimeout(() => $('#notifDiv').fadeOut(), 3000);
        }
    })
})