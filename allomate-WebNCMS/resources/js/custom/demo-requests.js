// import swal from 'sweetalert';
let deleteRef   = '';
let all_services= '';

function all_demo_requests_list(){
    $('.demo_requests_list').empty();
    $.ajax({
        type    :   'GET',
        url     :   '/admin/all-demo-requests-list',
        success :   function(response){
            $('.demo_requests_list').append(`
            <table class="table table-hover dt-responsive nowrap requestsListTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $('.requestsListTable tbody').empty();
            response.demo_requests.forEach((element, key) => {
                $('.requestsListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['name'] ? element['name'] : 'N/A'}</td>
                        <td>${element['email']}</td>
                        <td>${element['phone'] ? element['phone'] : 'N/A'}</td>
                        <td>${element['message']}</td>
                        <td>
                            <button id="${element['id']}" class="btn btn-default red-bg delete_lead">Delete</button>
                        </td>
                    </tr>`);
            });
            $('.requestsListTable').fadeIn();
            $('.requestsListTable').DataTable();
            $('.loader').hide();
        }
    })
}
//Delete Lead
$(document).on('click', '.delete_lead', function () {
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
                url: '/admin/delete-demo-request',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: id
                },
                success: function (response) {
                    if (response.status == 'success') {
                        all_demo_requests_list();
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
all_demo_requests_list();