var lastOp = "";
var glob_type = '';
var deleteRef = '';
$(document).ready(function() {

    var segments = location.href.split('/');
    var action = segments[4];
    if (action == "portfolio-categories") {
        fetchMainCategories();
    }   
    $(document).on('click', '.add-category', function() {
        $('input[name="hidden_category_id"]').val("");
        $('input[name="service_name"]').val("");
        $('input[name="publish_service"]').prop('checked', false);
        $('#dataSidebarLoader').hide();
        $('.dz-image-preview').remove();
        $('.dz-default').show();
        if (lastOp == "update") {
            $('input[name="service_name"]').val("");
            $('input[name="service_name"]').blur();
            $('input[name="publish_service"]').prop('checked', false);
        }
        lastOp = 'add';
        openSidebar();
    });

    $(document).on('click', '.update-blog-cate', function() {
        lastOp = 'update';
        $('#dataSidebarLoader').show();
        $('._cl-bottom').hide();
        $('.pc-cartlist').hide();

        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: `/admin/get-portfolio-category/${id}`,
            success: function(response) {
                $('#dataSidebarLoader').hide();
                $('._cl-bottom').show();
                $('.pc-cartlist').show();

                $('input[name="service_name"]').focus();
                $('input[name="service_name"]').val(response.category.service_name);
                $('input[name="service_name"]').blur();

                if (response.category.publish ==1) {
                    $('.yes').prop('checked', true);
                }else{
                    $('.no').prop('checked', true);

                } 
               $('input[name="hidden_category_id"]').val(response.category.id);

            }
        });
        openSidebar();

    });
    $(document).on('click', '#saveMainCat', function() {
        if (!$('input[name="service_name"]').val() || !$('input[name="service_name"]').val().trim()) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Please provide all the required information (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        $('#saveMainCat').attr('disabled', 'disabled');
        $('#cancelMainCat').attr('disabled', 'disabled');
        $('#saveMainCat').text('Processing..');
        $('#saveMainCatForm').ajaxSubmit({
            url   : `/admin/save-portfolio-cat`,
            type  : "POST",
            success: function(response) { 
                if (response.status == "success") {
                    fetchMainCategories();
                    $('#saveMainCat').removeAttr('disabled');
                    $('#cancelMainCat').removeAttr('disabled');
                    $('#saveMainCat').text('Save');
                    $('#notifDiv').text('Category have been updated successfully');
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
                        $('#notifDiv').text('Portfolio Category Already Exist');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                        $('#saveMainCat').removeAttr('disabled');
                        $('#cancelMainCat').removeAttr('disabled');
                        $('#saveMainCat').text('Save');
                    }
                    if(response.msg == "failed") {
                    $('#saveMainCat').removeAttr('disabled');
                    $('#cancelMainCat').removeAttr('disabled');
                    $('#saveMainCat').text('Save');
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Failed to add category at the moment');
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
    // $(document).on('click', '.delete_cat', function(){
    //     var id = $(this).attr('id');
    //     glob_type = $(this).attr('name');
    //     $('.confirm_delete').attr('id', id);
    //     deleteRef = $(this); 
    //     $('#hidden_btn_to_open_modal').click();
    // })
    // $(document).on('click', '.confirm_delete', function() {
    //     var categoryId = $(this).attr('id');
      
    //     var thisRef = $(this); 
    //     deleteRef.attr('disabled', 'disabled');
    //     var url = glob_type == 'main_cat' ? '/Services/' + categoryId : glob_type == 'sub_secondary_service' ? '/DelSubSecondartService/' + categoryId :'/DelSubCat/' + categoryId;
    //     var type = glob_type == 'main_cat' ? 'POST' : 'GET';
    //     $.ajax({
    //         type: type,
    //         url: url,
    //         data: deleteRef.parent().serialize(),
    //         cache: false,
    //         success: function(response) { 
    //             if (response) {
    //                 $('#notifDiv').fadeIn();
    //                 $('#notifDiv').css('background', 'green');
    //                 $('#notifDiv').text('Service have been deleted');
    //                 setTimeout(() => {
    //                     $('#notifDiv').fadeOut();
    //                 }, 3000); 
    //                 thisRef.removeAttr('disabled');
    //                 deleteRef.parent().parent().parent().remove();
    //                 $('.cancel_delete_modal').click();
    //             } else {
    //                 document.write(response);
    //                 $('#notifDiv').fadeIn();
    //                 $('#notifDiv').css('background', 'red');
    //                 $('#notifDiv').text('Unable to delete the Service at this moment');
    //                 setTimeout(() => {
    //                     thisRef.removeAttr('disabled');
    //                     $('#notifDiv').fadeOut();
    //                 }, 3000);
    //             }
    //         }
    //     });
    // });
});

function fetchMainCategories() {
    $.ajax({
        type: 'GET',
        url: '/admin/get-portfolio-categories',
        success: function(response) {
            $('.body').empty();
            $('.body').append('<table class="table table-hover dt-responsive nowrap mainCatsListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Service</th><th>Status</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.mainCatsListTable tbody').empty();
            var sNo = 1;
            response.categoires.forEach((element, key) => {
                $('.mainCatsListTable tbody').append(`
                <tr>
                    <td>${key + 1}</td>
                    <td> ${element['service_name']}</td>
                    <td> ${element['publish'] == 1 ? "Active" :"Deactive"}</td>
                    <td>
                        <button id="${element['id']}" class="btn btn-default btn-line update-blog-cate">Edit</button>
                        <button   type="button" id="${element['id']}" class="btn btn-default red-bg cate_delete" >Delete</button>
                    </td>
                </tr>`);
            });
            $('#tblLoader').hide();
            $('.body').fadeIn();
            $('.mainCatsListTable').DataTable();
        }
    });
}

$(document).on('click', '.cate_delete', function () {
    var cat_id = $(this).attr('id');
    swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/delete-portfolio-category/'+cat_id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    fetchMainCategories();
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('Category Deleted Successfully');
                    setTimeout(() => {
               
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    
                }
            });
        } else {
            fetchMainCategories();
        }
    });
})

