
var blocks_media = [];
$(document).ready(function () {
    fetchMedia();
    fetchBlocks();
});

$(document).on('click', '.openDataSidebarForAddingMedia', function () {
    openSidebar();
    $('#saveBlocksMedia')[0].reset();
    $('.dropify-clear').click();
    $('#block_id').focus().blur();
    $('#dataSidebarLoader').fadeOut();
});
$(document).on('click', '#saveMedia', function () {
    $('.smallTag').remove();
    var dirty = false;
    var fileInput = $('#media_dekstop_image')[0];
    if (!$('#block_id').val()) {
        dirty = true;
    }
    else if (fileInput.files.length == 0 && !$('#hidden_dekstop_image').val()) {
        dirty = true;
    }
    if (dirty) {
        showMessage('red', 'Please Provide all required information (*)');
        return;
    }
    $('#saveMedia').attr('disabled', 'disabled');
    $('#cancelMedia').attr('disabled', 'disabled');
    $('#saveMedia').text('Processing..');
    var ajaxUrl = "/admin/save-block-media";
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('#saveBlocksMedia').ajaxSubmit({
        type: 'POST',
        url: ajaxUrl,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            $('#saveMedia').removeAttr('disabled');
            $('#cancelMedia').removeAttr('disabled');
            $('#saveMedia').text('Save');
            if (response.status == "success") {
                fetchMedia();
                fetchBlocks();
                closeSidebar();
                showMessage('green', 'Page Builder Block Media added successfully');
                return;
            } else if (response.status == "exist") {
                showMessage('red', response.msg);
            } else {
                showMessage('red', 'Failed to add add Page Builder Block Media, Please try again later');
            }
        },
        error: function (err) {
            $('#saveMedia').removeAttr('disabled');
            $('#cancelMedia').removeAttr('disabled');
            $('#saveMedia').text('Save');
            showMessage('red', 'Failed to add add Page Builder Block Media, Please try again later');
        }
    });

});
function fetchMedia() {

    $.ajax({
        type: 'GET',
        url: '/admin/get-blocks-media-records',
        success: function (response) {
            $('.body_media').empty();
            $('.body_media').append(`<table class="table table-hover dt-responsive nowrap mt-10" id="blocksMediaTable" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Block Title</th>
                    <th>Media Type</th>
                    <th>Media URL</th>  
                    <th>Action</th>
                   
                </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('#blocksMediaTable tbody').empty();
            if (response.status == 'success') {
                blocks_media = response.blocks_media;
                if (blocks_media?.length) {
                    blocks_media.forEach(element => {

                        $('#blocksMediaTable tbody').append(`
                <tr>
                <td>${element['id']}</td>
                <td>${element['block_title'] ?? 'NA'}</td>  
                <td>${element['block_media_type_title'] ?? 'NA'}</td>  
                <td>${element['media_url'] ?? 'NA'}</td>    
                <td><button id="${element.id}" class="btn btn-default red-bg deleteMedia">Delete </button></td>
                </tr>`);
                    });
                }
                $('#tblLoader').hide();
                $('.body_media').fadeIn();
                $('#blocksMediaTable').DataTable();
            }
        }
    });
}
function fetchBlocks() {
    $("#block_id").empty();
    $("#block_id").append(`<option value="" selected>Loading...</block>`);
    $.ajax({
        type: 'GET',
        url: '/admin/fetch-blocks',
        success: function (response) {
            $("#block_id").empty();
            $("#block_id").append(`<option value="">Select Block</block>`);
            if (response.blocks) {
                response.blocks.forEach(element => {
                    $("#block_id").append(`<option value="${element['id']}">${element['title']}</block>`);
                });
            }
        }, error: function (err) {
            $("#block_id").empty();
        }
    });
}
$(document).on('change', '#block_id', function () {
    $('.dropify-clear').click();
    $('#hidden_dekstop_image').val('')
    var block_id = $(this).val();
    // if (block_id) {
    //     console.log(block_id);
    //     var dekstopRecord = blocks_media.find(x => x.block_id == block_id && x.media_type == 1);
    //     if (dekstopRecord) {
    //         $('#media_dekstop_image').attr('data-default-file', dekstopRecord.media_url);
    //         var dropifyPreviewWrapper = $('#media_dekstop_image').closest('.dropify-wrapper');
    //         var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
    //         dropifyPreview.css('display', 'block');
    //         dropifyPreview.find('.dropify-render').html(`<img src="${dekstopRecord.media_url}" alt="">`);
    //         $('#hidden_dekstop_image').val(`${dekstopRecord.media_url}`)
    //     }
    //     var mobileRecord = blocks_media.find(x => x.block_id == block_id && x.media_type == 3);
    //     if (mobileRecord) {
    //         $('#media_mobile_image').attr('data-default-file', mobileRecord.media_url);
    //         var dropifyPreviewWrapper = $('#media_mobile_image').closest('.dropify-wrapper');
    //         var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
    //         dropifyPreview.css('display', 'block');
    //         dropifyPreview.find('.dropify-render').html(`<img src="${mobileRecord.media_url}" alt="">`);
    //     }
    //     var tabletRecord = blocks_media.find(x => x.block_id == block_id && x.media_type == 2);
    //     if (tabletRecord) {
    //         $('#media_tablet_image').attr('data-default-file', tabletRecord.media_url);
    //         var dropifyPreviewWrapper = $('#media_tablet_image').closest('.dropify-wrapper');
    //         var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
    //         dropifyPreview.css('display', 'block');
    //         dropifyPreview.find('.dropify-render').html(`<img src="${tabletRecord.media_url}" alt="">`);
    //     }
    // }

});
$(document).on('click', '.deleteMedia', function () {
    var id = $(this).attr('id');
    var curentRef = $(this);

    if (id) {
        curentRef.attr('disabled', true);
        curentRef.text('Deleting');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'post',
            url: `/admin/delete-media/${id}`,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                curentRef.attr('disabled', false);
                curentRef.text('Delete');
                fetchMedia();
                showMessage('green', 'Media deleted successfully')
            }, error: function (err) {
                curentRef.attr('disabled', false);
                curentRef.text('Delete');
                showMessage('red', 'Unable to deleted media at the moment')

            }
        });
    } else { 
        showMessage('red', 'Invalid Media Record') 
    }

});



