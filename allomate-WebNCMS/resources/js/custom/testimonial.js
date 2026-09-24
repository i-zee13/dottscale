var segments    =   location.href.split('/');
let deleteRef   =   '';
let all_records =   [];
let testimonial_record = [];
$(document).ready(function(){
    all_testimonial_list();
});
function testimonal_table(){
    
}
function all_testimonial_list(){
    $('.all-testimonial-list').empty();
    $.ajax({
        url :   '/admin/testimonial_records',
        success : function(response){
            all_records         =   response.records;
            TestimonialHtml();
        }
    });
}
function TestimonialHtml(){
    $('.loader').show();
    $('.all-testimonial-list').empty();
    $('.all-testimonial-list').append(`
    <table class="table table-hover dt-responsive nowrap TestimonialListTable" style="width:100%;">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>`);
    $('.TestimonialListTable tbody').empty();
    all_records.forEach((element, key) => {
        $('.TestimonialListTable tbody').append(`
            <tr>
                <td>${key + 1}</td>
                <td>${element['name']}</td>
                <td>${element['designation']}</td>
                <td>
                    <button id="${element['id']}" type="button" data-object='${JSON.stringify(element).replace(/"/g, '&quot;').replace(/'/g, "&#39;")}' class="btn btn-default btn-line edit_testimonial">Edit</button>
                    <button id="${element['id']}" class="btn btn-default red-bg delete_testimonial">Delete</button>
                </td>
            </tr>`);
    });
    $('.TestimonialListTable').fadeIn();
    $('.TestimonialListTable').DataTable();
    $('.loader').hide();
}
// $(document).on('click','#saveSingleTestimonialBtn',function(){
//     let uid     = (Date.now() + Math.random()).toString().replace(".", "");
//     let dirty   = false;
//     $('.testi_required').each(function () {
//         if (!$(this).val() || $(this).val() == 0) {
//             dirty = true;
//             if ($(this).hasClass('formselect')) {
//                 $(this).parent().find('.select2-selection--single').css('border', '1px solid red');
//             }else{
//                 $(this).css('border', '1px solid red');
//             }   
//         }else{
//             $(this).css('border', '1px solid #f6f6f6');
//             $(this).parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
//         }
//     });
//     if (dirty) {
//         $('#notifDiv').fadeIn();
//         $('#notifDiv').css('background', 'red');
//         $('#notifDiv').text('Please provide all the required information (*)');
//         setTimeout(() => {
//             $('#notifDiv').fadeOut();
//         }, 3000);
//         return;
//     }
//     console.log($('#user_image')[0].files[0]);
//     var img             =   $('#user_image')[0].files[0];
//     all_records.push({
//         'id'            :   uid,
//         'name'          :   $('#name').val(),   
//         'designation'   :   $('#designation').val(),   
//         'description'   :   $('#description').val(),   
//         'user_img'      :   img,
//         'type'          :   'new'
//     });
//     console.log(all_records);
//     TestimonialHtml();
//     closeSidebar();
// });
// $(document).on('click','.delete_testimonial',function(){
//     all_records         =   all_records.filter(x=> x.id != $(this).attr('id').replace(/&quot;/g, '"').replace(/&#39;/g, "'"));
//     console.log(all_records);
//     $(this).parent().parent().remove();
// });
$(document).on('click','.edit_testimonial',function(){
    var object_value    =   JSON.parse($(this).attr('data-object'));
    $('.sidebarForm input,.sidebarForm textarea').val("");
    $('.sidebarForm select').val("").trigger('change');
    $('.dropify-preview').find('.dropify-render').empty();
    $('.dropify-preview').hide();
    $('.form-control').css('border', '1px solid #f6f6f6');
    $('.form-control').parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
    if(object_value){
        $('#testimonail_id').val(object_value.id);
        $('#name').val(object_value.name);
        $('#designation').val(object_value.designation);
        $('#description').val(object_value.content);
        $('.dropify-preview').find('.dropify-render').empty();
        $('.dropify-preview').show();
        $('.dropify-preview').find('.dropify-render').append(`
            <img src="${window.location.origin+'/storage/'+object_value.image}">
        `);
        $('#user_image').attr('data-default-file',window.location.origin+'/storage/'+object_value.image);
        $('#hidden_block_thumbnail').val(object_value.image);
    }
    openSidebar();
});
$(document).on('input keyup change','.testi_required,.main-required',function(){
    if(($(this).hasClass('testi_required') || $(this).hasClass('main-required')) && ($(this).val() == '' || $(this).val() == 0) ){
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
$(document).on('click', '.add_testimonial', function() {
    $('.sidebarForm input,.sidebarForm textarea').val("");
    $('.sidebarForm select').val("").trigger('change');
    $('.dropify-preview').find('.dropify-render').empty();
    $('.dropify-preview').hide();
    $('.form-control').css('border', '1px solid #f6f6f6');
    $('.form-control').parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
    openSidebar();
});
$(document).on('click', '.saveTestimonial', function() {
    let dirty   = false;
    $('.testi_required').each(function () {
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
    // $('.main-required').each(function () {
    //     if (!$(this).val() || $(this).val() == 0) {
    //         dirty = true;
    //         if ($(this).hasClass('formselect')) {
    //             $(this).parent().find('.select2-selection--single').css('border', '1px solid red');
    //         }else{
    //             $(this).css('border', '1px solid red');
    //         }   
    //     }else{
    //         $(this).css('border', '1px solid #f6f6f6');
    //         $(this).parent().find('.select2-selection--single').css('border', '1px solid #f6f6f6');
    //     }
    // });
    
    // if(all_records.length == 0){
    //     $('#notifDiv').fadeIn();
    //     $('#notifDiv').css('background', 'red');
    //     $('#notifDiv').text('Add Some Testimonial');
    //     setTimeout(() => {
    //         $('#notifDiv').fadeOut();
    //     }, 3000);
    //     return;
    // }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled',true);
    CurrentRef.text('Processing...');
    $('#page-cancel').attr('disabled',true);
    // var formData    =   new FormData();
    // for (var i = 0; i < all_records.length; i++) {
    //     var record = all_records[i];
    //     formData.append('all_records[' + i + '][id]', record.id);
    //     formData.append('all_records[' + i + '][name]', record.name);
    //     formData.append('all_records[' + i + '][designation]', record.designation);
    //     formData.append('all_records[' + i + '][description]', record.description);
    //     formData.append('all_records[' + i + '][user_img]', record.user_img);
    // }
    // formData.append('main_heading',$('#main_heading').val());
    // formData.append('sub_heading',$('#sub_heading').val());
    // formData.append('testimonail_id',$('#testimonail_id').val());
    $('#sideBarForm').ajaxSubmit({
        url     : `/admin/save-testimonial`,
        type    : "POST",
        // data    : formData,
        headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        processData: false,
        contentType: false,
        success : function(response) { 
            if (response.status == "success") {
                CurrentRef.attr('disabled',false);
                $('#page-cancel').attr('disabled',false);
                CurrentRef.text('Save');
                $('#notifDiv').text('Testimonials added successfully');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    // location.reload();
                }, 3000);
                $('.loader').show();
                all_testimonial_list();
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
                $('#notifDiv').text('Failed to add testimonial at the moment');
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
$(document).on('click', '.delete_testimonial', function () {
    var id              =   $(this).attr('id');
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
                url: '/admin/delete-testimonial',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id          : id
                },
                success: function (response) {
                    if (response.status == 'success') {
                        $('.loader').show();
                        all_testimonial_list();
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