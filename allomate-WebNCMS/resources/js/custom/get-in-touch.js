let meta_array = [];
$(document).on('click', '#save-contact', function () {
    let dirty = false;
    $('.contact-required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
            if ($(this).hasClass('formselect') || $(this).hasClass('sd-type') ) {
                $(this).parent().find('.select2-container').css('border', '0px solid red');
            }else{
                $(this).css('border', '0px solid red');
            }   
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
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $('#SaveContactForm').ajaxSubmit({
        type    :   "POST",
        url     :   "/admin/save-contact",
        data    :{
            meta_array  :  meta_array
        },
        cache   :   false,
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Save');
            if(response.msg == 'contact_added'){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Contact Details Added');
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