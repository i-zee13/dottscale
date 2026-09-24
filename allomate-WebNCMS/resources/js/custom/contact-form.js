
$(document).on('click', '.save-contact', function () {
    var emailReg            =   /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var numberReg           =   /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
    var lettersReg          =   /^(?![\s.]+$)[a-zA-Z\s.]*$/;
    var phone               =   $('#phone').val();
    var first               =   $('#first_name').val();
    var last                =   $('#last_name').val();
    var email               =   $('#email').val();
    let dirty = false;
    $('.inquiry-required').each(function () {
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
    if (lettersReg.test(first)==false && first != '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Enter Correct First Name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (lettersReg.test(last)==false && last != '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Enter Correct Last Name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (emailReg.test(email)==false && email != '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Enter Correct Email');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (numberReg.test(phone)==false && phone != '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Enter Correct Phone Number');
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
    if ($('.check-disclaimer').filter(':checked').length < 1){
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please Check Disclaimer');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $('#SaveContactForm').ajaxSubmit({
        type    :   "POST",
        url     :   "/save-contact",
        data:
            { _token: $('[name="csrf_token"]').attr('content')},
        cache   :   false,
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Save');
            if(response.msg == 'form_submit'){
                $('#SaveContactForm')[0].reset();
                $('.form-group').removeClass('focused');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Enquiry Form Submit');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
            else{
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Not added at this moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    })
})