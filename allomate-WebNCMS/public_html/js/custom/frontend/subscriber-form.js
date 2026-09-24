$(document).on('click','.subscriber-btn-submit',function(){
    var emailReg    =   /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email       =   $('input[name="subscriber_email"]').val().trim();
    let dirty       =   false;
    if (!email) {
        dirty = true;
        $('input[name="subscriber_email"]').focus();
    }
    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter email address.');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    if (emailReg.test(email)==false && email != '') {
        $('input[name="subscriber_email"]').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please enter a valid email address.');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', true);
    CurrentRef.text('Processing...');
    $('input[name="subscriber_email"]').attr('readonly',true);
    $(`#subscriberForm`).ajaxSubmit({
        type    :   "POST",
        url     :   "/save-customer-subscription",
        data:
            { 
                _token          : $('[name="csrf_token"]').attr('content')
            },
        cache   :   false,
        success :   function(response){
            $('input[name="subscriber_email"]').attr('readonly',false);
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Join');
            if(response.status == "success"){
                $('input[name="subscriber_email"]').val("");
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Subscribed Successfully');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }else if(response.status == "failed"){
                $('input[name="subscriber_email"]').val("");
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }else{
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('An unknown error occurred. Please try again later');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    });
});