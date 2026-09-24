// import swal from 'sweetalert';
let deleteRef   = '';
let all_services= '';


function all_applications_list(){
    $('.loader').show();

    $('.applications_list').empty();
    $.ajax({
        type    :   'GET',
        url     :   '/admin/all-applications-list',
        success :   function(response){
            $('.applications_list').append(`
            <table class="table table-hover dt-responsive nowrap applicationsListTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Application For</th>
                        <th>Message</th>
                        <th>Attachment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('.applicationsListTable tbody').empty();
            response.applications.forEach((element, key) => {
                $('.applicationsListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['first_name'] ? element['first_name'] : 'N/A'} ${element['last_name'] ? element['last_name'] : 'N/A'}</td>
                        <td>${element['email']}</td>
                        <td>${element['phone_number'] ? element['phone_number'] : 'N/A'}</td>
                        <td>${element['title']}</td>
                        <td>${element['message'].substr(0, 40)+'...'}<br><a href="javascript:void(0);" class="btn btn-default btn-line view-more" data-message="${element['message']}">View more</a></td>

                        <td>
                            <a href="${element.resume}" target="_blank" data-id="/storage/${element['resume']}" class="link-doc " download>
                            <img src="/admin/images/form-avatar-icon.svg" class="doc-img" alt="" width="30px" height="30px" style="cursor:pointer">
                            </a> 
                        </td>
                        <td>
                            <button id="${element['id']}" class="btn btn-default red-bg delete_application">Delete</button>
                        </td>
                    </tr>`);
            });
            $('.applicationsListTable').fadeIn();
            $('.applicationsListTable').DataTable();
            $('.loader').hide();
        }
    })
}
$(document).on('click','.view-more',function(){
    $('p').empty();
    $('#hidden_btn_to_open_modal_for_message').click();
    var message           = $(this).attr('data-message');
    $('p').append(message);
})
//Delete Lead
$(document).on('click', '.delete_application', function () {
    var id = $(this).attr('id');
    deleteRef = $(this);
    swal({
        title   : "Are you sure?",
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
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/admin/delete-application',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: id
                },
                success: function (response) {
                    if (response.status == 'success') {
                        all_applications_list();
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
      
})

 
all_applications_list();