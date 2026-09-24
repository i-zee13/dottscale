let error_url;
let lessons;
let href = '';
$(document).ready(function () {

    href = String(location.href ).replace( /#/, "" );
    var segments = href.split('/');
    action = segments[4];
    if(action != 'jobs'){
        CKEDITOR.replace('ckeditor',
        {
            height: '400px',
            toolbar: 'Classic',
            removePlugins: 'blockquote,about',
            toolbarStartupExpanded: false,
            contentsCss: [
                '../css/menu.css?v=6.4'
            ],
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;div',
        });
    CKEDITOR.config.fontSize_defaultLabel = '12px';
    CKEDITOR.config.fontSize_defaultParagraph = '12px';
    CKEDITOR.config.fontSize = '12 Pixels/12px;Big/2.3em;30 Percent More/130%;Bigger/larger;Very Small/x-small';
    }else{
        $('#tblLoader').hide()
        $('.body').fadeIn()
    }
    $(".save_form").on('click', function () {
        var currentRef = $(this);
        var description = CKEDITOR.instances['ckeditor'].getData();
        if (description == '' || $('#title').val().trim() == '' || $('#location').val().trim() == '') {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        currentRef.attr('disabled',true);
        currentRef.text('Processing...');
        $('#form').ajaxSubmit({
            type: 'post',
            url: '/admin/job-store',
            data: {
                description: description,
            },
            success: function (response) {
                currentRef.attr('disabled',false);
                currentRef.text('Save');
                if (response.status == "error") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Red');
                    $('#notifDiv').text('Logo Image Should Not be Empty');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
                if(response.status =="title_duplicate") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Red');
                    $('#notifDiv').text(response.msg);
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
                 if (response.status == "success") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Green');
                    $('#notifDiv').text('Career has been Added Successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                        window.location = '/admin/jobs';
                    }, 2000);
                }
            },
            error: function (e) {
                currentRef.attr('disabled',false);
                currentRef.text('Save');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Not Added at this Moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
        })
    })
})
$(document).on('click', '.career_delete', function () {
    dtrecord = $('#example').DataTable();
    // dtrecord.clear();
   var deleteRef = $(this);
    var id = $(this).attr('id');
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/job-delete/'+id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    CurrentRef.attr('disabled', false);
                    CurrentRef.text('Delete');
                    if (response.status == 'success') {
                        $('input[name="email"').val('');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'Green');
                        $('#notifDiv').text('Successfully deleted !');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }else{
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Not deleted at this moment');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
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
$(document).on('click','.change-status',function(){
    var q_id            =  $(this).attr('data-id');
    var current_status  =  $(this).attr('data-value');
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    var  status         =   '';
    if(current_status == 0){
        status = 1;
    }else{
        status = 0;
    }
    $.ajax({
        url     :  '/admin/change-job-status',
        type    :   'get',
        data    :   {
                     'status'  :   status,
                     'id'      :   q_id,
                    },
        success :  function(response){
            if(response.status == 'success'){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Status has been Updated');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    location.reload();
                }, 1500);
                CurrentRef.attr('disabled', false);
            }else{
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
