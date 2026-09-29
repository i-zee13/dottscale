$(document).ready(function () {
    let meta_array = [];

    $(".save_form").on('click', function () {
        let dirty = false;
        $('.required').each(function () {
            if (!$(this).val() || !$(this).val().trim()) {
                dirty = true;
            }
        });
        if (dirty) {
            $('#notifDiv').fadeIn().css('background', 'red').text('Fill All Required Fields (*)');
            setTimeout(() => $('#notifDiv').fadeOut(), 3000);
            return;
        }

        meta_array = [{
            'meta_name_author': $('#meta_name_author').val(),
            'meta_name_keywords': $('#meta_name_keywords').val(),
            'meta_name_description': $('#meta_name_description').val(),
            'meta_content_author': $('#meta_content_author').val(),
            'meta_content_keywords': $('#meta_content_keywords').val(),
            'meta_content_description': $('#meta_content_description').val(),
            'meta_og_title': $('#meta_og_title').val(),
            'meta_og_description': $('#meta_og_description').val(),
        }];

        $('#form').ajaxSubmit({
            type: 'post',
            url: '/admin/about-us/store',
            data: { meta_array: meta_array },
            success: function (response) {
                if (response.status == "error") {
                    $('#notifDiv').fadeIn().css('background', 'Red').text(response.msg || 'Error');
                    setTimeout(() => $('#notifDiv').fadeOut(), 3000);
                }
                if (response.status == "success") {
                    $('#notifDiv').fadeIn().css('background', 'Green').text('Data has been saved successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                        window.location = "/admin/about-us";
                    }, 1000);
                }
            },
            error: function () {
                $('#notifDiv').fadeIn().css('background', 'red').text('Not saved at this moment');
                setTimeout(() => $('#notifDiv').fadeOut(), 3000);
            }
        });
    });

    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });
});
