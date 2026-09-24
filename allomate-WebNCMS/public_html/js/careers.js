// import swal from 'sweetalert';
let deleteRef   = '';
let all_services= '';
$(document).ready(function(){
    $(document).on('click', '.openSideBarForAddingcareer', function () {
        $('input[name="career_id"').val('');

        $('input[name="career_name"]').val('');
        $('input[name="career_name"]').blur();

        $('input[name="phone_no"]').val('');
        $('input[name="phone_no"]').blur();

        $('input[name="career_address"]').val('');
        $('input[name="career_address"]').blur();

        $('input[name="career_email"]').val('');
        $('input[name="career_email"]').blur();

        $('input[name="longitude"]').val('');
        $('input[name="longitude"]').blur();

        $('input[name="latitude"]').val('');
        $('input[name="latitude"]').blur();

        $('input[name="career_postal_code_id"]').val('');
        $('input[name="career_postal_code_id"]').blur();

        $('#countries_2').val('0').trigger('change');
        $('#states_2').val('0').trigger('change');
        $('#cities_2').val('0').trigger('change');
        openSidebar();
    });
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
                        <th>Application Type</th>
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
                        <td>${element['phone'] ? element['phone'] : 'N/A'}</td>
                        <td>${element['application_for']==1 ? 'Bussnies Development' : element['application_for']== 2 ? 'SQA ' :  element['application_for']== 2 ? 'SQA ' :  element['application_for']== 3 ? 'IOS Developer' : 'Field Trainy Officer'}</td>
                        <td>
                            <a data-toggle="modal" data-target="#ViewDocumentImg"  data-id="${element['resume']}" class="link-doc openModel" download>
                            <img src="/admin/images/form-avatar-icon.svg" class="doc-img" alt="" width="30px" height="30px">
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

$(document).on('click','.openModel',function() {
    var id = $(this).attr('data-id');
    var extension = id.substr((id.lastIndexOf('.') + 1));
    $('.btn_modal_download').attr('href', `/storage/${id}`);
    $('.preview  .modal-body').empty();
    if (extension == 'pdf') {
        $('.preview  .modal-body').html
            ('<iframe src ="/storage/' + `${id}` + '" width="100%" height="500px max-height="500"></iframe>');
    } else {
        $('.preview  .modal-body').html('<img src="/storage/' + `${id}` + '" class="cnicCardimg" />');
    }
});
all_applications_list();
})
