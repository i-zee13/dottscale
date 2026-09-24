let deleteRef;
let dtrecord ;
$(document).ready(function(){


$(document).on('click', '.subscription_form_btn', function () {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
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
    $('#subscription_form').ajaxSubmit({
        url: '/subscription-email',
        type: 'post',
        success: function (response) {
            if (response.status == 'duplicate') {
                $('input[name="email"').val('');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'Red');
                $('#notifDiv').text("You'd already Subscribed with this Email");
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
            if (response.status == 'success') {
                $('input[name="email"').val('');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'Green');
                $('#notifDiv').text('Successfully Subscribed !');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    })
});
$(document).on('click', '.email_delete', function () {
    dtrecord = $('#example').DataTable();
    // dtrecord.clear();
    deleteRef = $(this);
    var email_id = $(this).attr('id');
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/subscribe-email-delete/' + email_id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    dtrecord.destroy();
                    deleteRef.parent().parent().remove();
                    dtrecord = $('#example').DataTable();
                }
            });
        } else {
            dtrecord = $('#example').DataTable();
        }
    });
})
})