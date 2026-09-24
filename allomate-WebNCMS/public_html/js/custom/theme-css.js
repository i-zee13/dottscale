$(document).ready(function(){

});
$(document).on('click','.save_form', function () {
    let dirty = false;
    $('.required').each(function () {
        if (!$(this).val().trim()) {
            dirty = true;
        }
    });

    if (dirty) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Fill All Required Fields (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var currentRef  =   $(this);
    currentRef.text('Processing...').attr('disabled',true);
    $('#ThemeCssForm').ajaxSubmit({
        type: 'post',
        url : '/admin/save-theme-css',
        success: function (response) {
            if(response.status == "success"){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    location.reload();
                    $('#notifDiv').fadeOut();
                }, 3000);
            }else{
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        }
    });
})