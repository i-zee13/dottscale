let url = '';
$(document).ready(function(){
    CKEDITOR.replace( 'ckeditor',
        {
            height: '500px',
            toolbar : 'Classic',
            removePlugins: 'blockquote,about',
            toolbarStartupExpanded : false,
            contentsCss: [
                '../css/menu.css?v=6.4'
                ],
                format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;div',
        });
    // CKEDITOR.config.extraPlugins                =   'justify';
    CKEDITOR.config.fontSize_defaultLabel       =   '12px';
    CKEDITOR.config.fontSize_defaultParagraph   =   '12px';
    CKEDITOR.config.fontSize                    =   '12 Pixels/12px;Big/2.3em;30 Percent More/130%;Bigger/larger;Very Small/x-small';
})
$(document).on('click', '#save-static', function () {
    var privacy_details    =   CKEDITOR.instances['ckeditor'].getData();
    if (privacy_details == '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please provide all the required information (*)');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    if($('#static_id') == 1){
        url = "/admin/save-privacy";
    }else{
        url = "/admin/save-terms";
    }

    $('#SavePrivacyForm').ajaxSubmit({
        type    :   "POST",
        url     :   url,
        data    :   {
            privacy_details    :   privacy_details,
        },
        cache   :   false,
        success :   function(response){
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Save');
            if(response.msg == 'static_added'){
                $('.cke_editable p').empty();
                $('.dropify-preview').css('display','none');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Data Added');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    window.location.reload();
                }, 1000);
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
