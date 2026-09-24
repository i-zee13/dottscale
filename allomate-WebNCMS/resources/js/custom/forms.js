
$(document).on('click','#btn-demo-form',function(){
    let dirty = false;
    $('.required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
        }
    });
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
  
    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if ((emailReg.test(email) == false && email != '') || email == '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        if (email == '') {
            $('#notifDiv').text('Please enter Email');
        } else {
            $('#notifDiv').text('Enter Correct Email');
        }
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 2000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $('#demo-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/store-demo-form",
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('BOOK A FREE DEMO');
            if (response.status == 'success'){
                $('#demo-form')[0].reset();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Demo request has been Submitted');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    // window.location = '/admin/blogs';
                }, 1000);
            }else if(response.status == 'duplicate'){
                $('#contact-form')[0].reset();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Email Already Exist');
                setTimeout(() => {
                    $('#notifDiv').fadeOut(); 
                }, 3000);
            }else if (response.status == 'validation_error'){
                $('#demo-form')[0].reset();
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
                $('#notifDiv').text('Not added at this moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error   :   function(e){
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Not added at this moment');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        }
    })
})

$(document).on('click','#btn-contact-form',function(){
    let dirty = false;
    $('.required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
        }
    });
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
  
    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if ((emailReg.test(email) == false && email != '') || email == '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        if (email == '') {
            $('#notifDiv').text('Please enter Email');
        } else {
            $('#notifDiv').text('Enter Correct Email');
        }
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 2000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Sending...');
    $('#contact-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/store-contact-form",
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('SEND');
            if (response.status == 'success'){
                $('#contact-form')[0].reset();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Your request has been Sent, We will respond You Soon.');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    // window.location = '/admin/blogs';
                }, 3000);
            }else if(response.status == 'duplicate'){
                $('#contact-form')[0].reset();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Email Already Exist');
                setTimeout(() => {
                    $('#notifDiv').fadeOut(); 
                }, 3000);
            }else if (response.status == 'validation_error'){
                $('#demo-form')[0].reset();
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
                $('#notifDiv').text('Not added at this moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error   :   function(e){
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Not added at this moment');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        }
    })
})

$(document).on('click','#btn-application-form',function(){
    let dirty = false;
    $('.required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
        }
    });
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
  
    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if ((emailReg.test(email) == false && email != '') || email == '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        if (email == '') {
            $('#notifDiv').text('Please enter Email');
        } else {
            $('#notifDiv').text('Enter Correct Email');
        }
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 2000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Sending...');
    $('#application-form').ajaxSubmit({
        type    :   "POST",
        url     :   "/store-application-form",
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('SEND');
            if (response.status == 'success'){
                $('#application-form')[0].reset();
                $('#placeholder-resume').text('Attach Resume *');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Your request has been Sent, We will respond You Soon.');
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
                $('#demo-form')[0].reset();
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
                $('#notifDiv').text('Not added at this moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        },
        error   :   function(e){
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Not added at this moment');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        }
    })
})

// for text type inputs which are required to accept only numeric values
$(document).on('input','.only_numerics , .numeric' , function(){
    this.value = this.value.replace(/[^0-9]/gi,'');
})