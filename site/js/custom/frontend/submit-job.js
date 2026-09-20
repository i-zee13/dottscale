$(document).on('click','#btn-application-form',function(){
    let dirty       = false;
    let focusFields = false;
    $('.required-career').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
            if(focusFields == false){
                $(this).focus();
                focusFields = true;
            }
        }
    });

    var emailReg    =   /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var numberReg   =   /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
    var lettersReg  =   /^(?![\s.]+$)[a-zA-Z\s.]*$/;

    var phone       =   $('#phone').val().trim();
    var first       =   $('#firstName').val().trim();
    var last        =   $('#lastName').val().trim();
    var email       =   $('#email').val();
    console.log(dirty);

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
        $('#firstName').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct first name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (lettersReg.test(last)==false && last != '') {
        $('#lastName').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct last name');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (emailReg.test(email)==false && email != '') {
        $('#email').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct email');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (numberReg.test(phone)==false && phone != '') {
        $('#phone').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter correct phone number');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }

    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Sending...');
    $('#application-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/submit-job-application",
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Submit');
            if (response.status == 'success'){
                $('#application-form')[0].reset();
                $('#placeholder-resume').text('Attach Resume *');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Your form has been submitted successfully. We will contact you soon.');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                  
                }, 3000);
            }else if(response.status == 'resume_missing'){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please Attach File');
                setTimeout(() => {
                    $('#notifDiv').fadeOut(); 
                }, 3000);
            }else if (response.status == 'validation_error'){
                $('#application-form')[0].reset();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Please provide all the required information (*)');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    // window.location = '/admin/blogs';
                }, 1000);
            }else{
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Something went wrong. Please try again later');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error   :   function(xhr){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Submit');
            if(xhr.status === 422){ // Laravel validation error
                let errors = xhr.responseJSON.errors;
                let firstError = Object.values(errors)[0][0]; // get first error message

                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(firstError);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            } else {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Something went wrong. Please try again later.');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    })
});

// for text type inputs which are required to accept only numeric values
$(document).on('input','.only_numerics , .numeric' , function(){
    this.value = this.value.replace(/[^0-9]/gi,'');
})