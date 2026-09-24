let meta_array = [];
$(document).ready(function(){
    $(".save_form").on('click', function () {
        let dirty = false;
        $('.req').each(function () {
            if (!$(this).val()) {
                dirty = true;
                console.log(this)
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
        meta_array.push({
            'meta_name_author'          :  $('#meta_name_author').val(),
            'meta_name_keywords'        :  $('#meta_name_keywords').val(),
            'meta_name_description'     :  $('#meta_name_description').val(),
            'meta_content_author'       :  $('#meta_content_author').val(),
            'meta_content_keywords'     :  $('#meta_content_keywords').val(),
            'meta_content_description'  :  $('#meta_content_description').val(),
            'meta_og_title'             :  $('#meta_og_title').val(),
            'meta_og_description'       :  $('#meta_og_description').val(),
        })
        $('#form').ajaxSubmit({
            type: 'post',
            url: '/admin/home-store',
            data    :   {
                meta_array         :   meta_array
            },
            success: function (response) {

                if (response.status == "error") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Red');
                    $('#notifDiv').text('Image Should Not be Empty');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } if (response.status == "success") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Green');
                    $('#notifDiv').text('Data has been Addedd Successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 1500);
                    setTimeout(() => {
                        window.location = "/admin/home";
                        $('#notifDiv').fadeOut();
                    }, 1000);
                }

            },
            error: function (e) {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Not Added at this Moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        })
    })
    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });

})