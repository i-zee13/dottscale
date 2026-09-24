$(document).ready(function () {
    var id = ''
    let meta_array = [];
    
    getStaff();

    $(".save_form").on('click', function () {
        let dirty = false;
        var count = 1;
        $('.required').each(function () {
            
            if (!$(this).val() || !$(this).val().trim() || $(this).val().trim().length <1) {
                if(count == 1){
                    $(this).focus();
                }
                count++;
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
   
    
        meta_array = [];
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
            url: '/admin/about-us/store',
            data    :{
                meta_array  :  meta_array
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
                        window.location = "/admin/about-us";
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
    $(document).on('click', '.openSideBarForAddingStaff', function () {
        $('input[name="staff_id"').val('');
        $('input[name="staff_img_hidden"').val('');

        $('input[name="staff_name"]').val('');
        $('input[name="staff_name"]').blur();

        $('input[name="staff_designation"]').val('');
        $('input[name="staff_designation"]').blur();

        $('textarea[name="staff_description"]').val('');
        $('textarea[name="staff_description"]').blur();

        $('input[name="staff_smallheading"]').val('');
        $('input[name="staff_smallheading"]').blur();

        $('textarea[name="staff_description2"]').val('');
        $('textarea[name="staff_description2"]').blur();
        $('input[name="text_alignment"]').prop('checked', false);

        $('.staff_img').parent().find(".dropify-clear").trigger('click');
        openSidebar();
    });
    $(document).on('click', '.openDataSidebarForUpdateStaff', function () {

        id = $(this).attr('id');
        $('#staff_id').val(id);
        $.ajax({
            type: 'GET',
            url: '/admin/get-staff-form/' + id,
            success: function (response) {
                console.log(response)

                $('input[name="staff_name"]').focus();
                $('input[name="staff_name"]').val(response.staff.staff_name);
                $('input[name="staff_name"]').blur();

                $('input[name="staff_designation"]').focus();
                $('input[name="staff_designation"]').val(response.staff.staff_designation);
                $('input[name="staff_designation"]').blur();

                $('textarea[name="staff_description"]').focus();
                $('textarea[name="staff_description"]').val(response.staff.staff_description);
                $('textarea[name="staff_description"]').blur();

                $('input[name="staff_smallheading"]').focus();
                $('input[name="staff_smallheading"]').val(response.staff.staff_smallheading);
                $('input[name="staff_smallheading"]').blur();

                $('textarea[name="staff_description2"]').focus();
                $('textarea[name="staff_description2"]').val(response.staff.staff_description2);
                $('textarea[name="staff_description2"]').blur();

                if (response.staff.text_alignment == 1) {
                    $('.right').prop('checked', true);
                } else {
                    $('.left').prop('checked', true);
                }
                var input = `<input type="hidden"  name="staff_img_hidden" value="${response.staff.staff_img}"/> <input type="file" id="input-file-now" class="dropify  staff_img"  name="staff_img" data-old_input="staff_img_hidden"  data-default-file = "/storage/${response.staff.staff_img}" value="${response.staff.staff_img}"/>`
                // $('input[name="staff_img"]').val(response.staff.staff_img);
                $('.img').empty();
                $('.img').html(input);
                $('.dropify').dropify();


            }
        })
        openSidebar();
    });
    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });
    $(document).on('click', '#saveStaffBtn', function () {

        let validate = false;
        $('.required_field').each(function () {
            if (!$(this).val()) {
                validate = true;
            }
        });
        if (validate) {
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'red');
            $('#notifDiv').text('Fill All Required Fields (*)');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
            return;
        }
        $('#staff_form').ajaxSubmit({
            url: '/admin/save-staff-form',
            type: 'POST',
            success: function (response) {

                if (response.status == "error") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Red');
                    $('#notifDiv').text('Image Should Not be Empty');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
                if (response.status == "success") {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'Green');
                    $('#notifDiv').text('Data has been Addedd Successfully');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    $('input[name="staff_name"]').val('');
                    $('input[name="staff_designation"]').val('');
                    $('textarea[name="staff_description"]').val('');
                    $('input[name="staff_smallheading"]').val('');
                    $('textarea[name="staff_description2"]').val('');
                    $('.staff_img').parent().find(".dropify-clear").trigger('click');
                    getStaff();
                    closeSidebar();
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
        });

    });
    function getStaff() {
        $('.staff_div').empty();
        $.ajax({
            type: 'GET',
            url: '/admin/staff-list',
            success: function (response) {
                $('.staff_div').append(`
                <table class="table table-hover dt-responsive nowrap staff_table" id="example" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody >
                </tbody>
            </table>
                `);
                $('.staff_table tbody').empty();
                response.staff.forEach(element => {
                    $('.staff_table tbody').append(`
                            <tr>
                                <td><img style="width:auto; height:35px; margin-right:10px;" src="/storage/${element.staff_img}" alt="">
                                ${element.staff_name}
                                </td>
                                <td> ${element.staff_designation}</td>
                                <td><a id="${element['id']}" class="btn btn-default btn-line m-b openDataSidebarForUpdateStaff">Edit</a>
                                <a href="javascript:void(0);"   id="${element['id']}" class="btn btn-default red-bg staff_delete"  >Delete</a>

                                </td>
                            </tr> `)
                });
                $('.staff_table').fadeIn();
                $('.staff_table').DataTable();
                $('.loader').hide();

            }
        });
    }
  
    $(document).on('click', '.staff_delete', function () {
        var staff_id = $(this).attr('id');
        var url = '/admin/staff-delete/' + staff_id;
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        getStaff();
                    }
                });
            } else {
                getStaff();
            }
        });
    });

    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });
});