var segments    =   location.href.split('/');
let deleteRef   =   '';
let all_records =   [];
$(document).ready(function(){
    all_blocks_list();
});
function all_blocks_list(){
    $('.all_blocks').empty();
    $.ajax({
        type    :   'GET',
        url     :   '/admin/all-blocks-list',
        success :   function(response){
            $('.all_blocks').append(`
            <table class="table table-hover dt-responsive nowrap BlockListTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('.BlockListTable tbody').empty();
            all_records =   response.records;
            all_records.forEach((element, key) => {
                $('.BlockListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['title']}</td>
                        <td>${element['category']}</td>
                        <td>
                            <button id="${element['id']}" data-object='${JSON.stringify(element).replace(/"/g, '&quot;').replace(/'/g, "&#39;")}' class="btn btn-default btn-line edit_bloack">Edit</button>
                            <button id="${element['id']}" data-object='${JSON.stringify(element).replace(/"/g, '&quot;').replace(/'/g, "&#39;")}' class="btn btn-default red-bg delete_block">Delete</button>
                        </td>
                    </tr>`);
            });
            $('.BlockListTable').fadeIn();
            $('.BlockListTable').DataTable();
            $('.loader').hide();
        }
    });
}
$(document).on('click','.edit_bloack',function(){
    var object_value    =   JSON.parse($(this).attr('data-object').replace(/&quot;/g, '"').replace(/&#39;/g, "'"));
    $('#block_id').val("");
    $('#SaveBlockForm input,#SaveBlockForm textarea').val("");
    $('#SaveBlockForm select').val("").trigger('change');
    $('.dropify-preview').find('.dropify-render').empty();
    $('.dropify-preview').hide();
    if(object_value){
        $('.block_title').val(object_value.title);
        $('.block_category').val(object_value.category).trigger('change');
        $('#block_css').val(object_value.css);
        $('#block_html').val(object_value.html);
        $('#block_slug').val(object_value.title_slug);
        $('#block_id').val(object_value.id);
        $('.dropify-preview').find('.dropify-render').empty();
        $('.dropify-preview').show();
        $('.dropify-preview').find('.dropify-render').append(`
            <img src="${window.location.origin+'/themes/demo/block-thumbs/'+object_value.thumbnail}">
        `);
        $('#block_thumbnail').attr('data-default-file',window.location.origin+'/themes/demo/block-thumbs/'+object_value.thumbnail);
        $('#hidden_block_thumbnail').val(object_value.thumbnail);
    }
    openSidebar();
});
$(document).on('input keyup change','.block_required',function(){
    if(($(this).hasClass('block_required')) && ($(this).val() == '' || $(this).val() == 0) ){
        if ($(this).hasClass('formselect')) {
            $(this).parent().find('.select2-selection--single').css('border', '1px solid red');
        }else{
            $(this).css('border', '1px solid red');
        }
    }else{
        $(this).css('border', '1px solid #f6f6f6');
        $(this).parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
    }
});
$(document).on('click', '.add-block', function() {
    $('#block_id').val("");
    $('#SaveBlockForm input,#SaveBlockForm textarea').val("");
    $('#SaveBlockForm select').val("").trigger('change');
    $('.dropify-preview').find('.dropify-render').empty();
    $('.dropify-preview').hide();
    $('.form-control').css('border', '1px solid #f6f6f6');
    $('.form-control').parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
    openSidebar();
});
$(document).on('click', '#saveBlock', function() {
    let dirty = false;
    $('.block_required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
            if ($(this).hasClass('formselect')) {
                $(this).parent().find('.select2-selection--single').css('border', '1px solid red');
            }else{
                $(this).css('border', '1px solid red');
            }   
        }else{
            $(this).css('border', '1px solid #f6f6f6');
            $(this).parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
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
    if($('#block_id').val() > 0){
        var find_slug   =   all_records.filter(x=> x.title_slug.toLowerCase() == ($('#block_slug').val().toLowerCase()).trim() && x.id != $('#block_id').val());
    }else{
        var find_slug   =   all_records.filter(x=> x.title_slug.toLowerCase() == ($('#block_slug').val().toLowerCase()).trim());
    }
    if(find_slug.length > 0){
        $('.block_title').focus();
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Block Title already exists');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled',true);
    CurrentRef.text('Processing...');
    $('#page-cancel').attr('disabled',true);
    $('#SaveBlockForm').ajaxSubmit({
        url     : `/admin/save-pagebuilder-block`,
        type    : "POST",
        data    :   {
            _token  : $('meta[name="csrf_token"]').attr('content')
        },
        success: function(response) { 
            if (response.status == "success") {
                $('.loader').show();
                all_blocks_list();
                CurrentRef.attr('disabled',false);
                $('#page-cancel').attr('disabled',false);
                CurrentRef.text('Save');
                $('#notifDiv').text('Blocks added successfully');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                closeSidebar();
            } else {
                if(response.msg == "duplicate") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Block already exists');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    CurrentRef.attr('disabled',false);
                    $('#page-cancel').attr('disabled',false);
                    CurrentRef.text('Save');
                }
                if(response.msg == "failed") {
                CurrentRef.attr('disabled',false);
                $('#page-cancel').attr('disabled',false);
                CurrentRef.text('Save');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Failed to add block at the moment');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }}
          
           
        },
        error: function(err) {
            if (err.status == 422) {
                $.each(err.responseJSON.errors, function(i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<small style="color: red; position: absolute; width:100%; text-align: right; margin-left: -30px">' + error[0] + '</small>'));
                });
            }
        }
    });
});
//Delete Blog
$(document).on('click', '.delete_block', function () {
    var id              =   $(this).attr('id');
    var object_value    =   JSON.parse($(this).attr('data-object'));
    deleteRef           =   $(this);
    swal({
        title   : "Are you sure you want to delete it?",
        // text    : "",
        icon    : "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var thisRef = $(this);
            deleteRef.attr('disabled', 'disabled');
            deleteRef.text('Processing...');
            $.ajax({
                type: 'POST',
                url: '/admin/delete-pagebuilder-block',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id          : id,
                    object_value: $(this).attr('data-object')
                },
                success: function (response) {
                    if (response.status == 'success') {
                        $('.loader').show();
                        all_blocks_list();
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'green');
                        $('#notifDiv').text('Successfully deleted.');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    } else {
                        deleteRef.removeAttr('disabled');
                        deleteRef.text('Delete');
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('Unable to delete at the moment');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                }
            });
        }
      });
      
});
$('.block_title').keyup(function(){
    $('.block_title').val($(this).val());
    var str =   $('.block_title').val().trim();
    str     =   str.replace(/\s+/g, '-').toLowerCase();
    $('#block_slug').val(str);
});