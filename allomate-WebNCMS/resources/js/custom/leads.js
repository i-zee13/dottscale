// import swal from 'sweetalert';
let deleteRef   = '';
let all_services= '';
$(document).on('click','.status_change_faq',function(){
    var faq_status      =   '';
    var id              =   $(this).attr('id');
    var current_status  =   $(this).attr('data-value');
    if(current_status == 1){
        faq_status      =   0;
    }else{
        faq_status      =   1;
    }
    var CurrentRef      =   $(this);
    CurrentRef.attr('disabled', 'disabled');
    $.ajax({
        type    :   'POST',
        url     :   `/admin/faq-status-change`,
        data    :   {
            _token      :   $('meta[name="csrf_token"]').attr('content'),
            id          :   id,
            faq_status  :   faq_status,
        },
        success :   function (response) {
            CurrentRef.attr('disabled', false);
            if(response.msg == 'status_change'){
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('FAQs Status Change');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                all_leads_list();
            }
        }
    });
})
function all_leads_list(){
    $('.loader').show();

    $('.leads_list').empty();
    $.ajax({
        type    :   'GET',
        url     :   '/admin/all-leads-list',
        success :   function(response){
            $('.leads_list').append(`<table class="table table-hover dt-responsive nowrap BlogsListTable" style="width:100%;">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Message</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>`);
            $('.BlogsListTable tbody').empty();
            response.all_leads.forEach((element, key) => {
                $('.BlogsListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['name'] ? element['name'] : ''} </td>
                        <td>${element['email']}</td>
                        <td>${element['phone']}</td>
                        <td>${element['message']}</td>
                        <td>${element['subject']}</td>
                        <td>
                            <button id="${element['id']}" class="btn btn-default red-bg delete_lead">Delete</button>
                        </td>
                    </tr>`);
            });
            $('.BlogsListTable').fadeIn();
            $('.BlogsListTable').DataTable();
            $('.loader').hide();
        }
    })
}
//open modal 
$(document).on('click','.lead-status',function(){
    $('#web_lead_status').removeAttr('checked');
    $('#client_status').removeAttr('checked');
    $('#spam').removeAttr('checked');
    $('#hidden_btn_to_open_modal').click();
    var status_id       = $(this).attr('data-status');
    var id              = $(this).attr('id');
    var fname           = $(this).attr('data-first');
    var lname           = $(this).attr('data-last');
    var email           = $(this).attr('data-email');
    var phone           = $(this).attr('data-phone');
    $('#lead_id').val(id);
    $('#f_name').val(fname);
    $('#l_name').val(lname);
    $('#m_email').val(email);
    $('#phone_no').val(phone);
    var web_lead_status = $('#web_lead_status').val();
    var client_status   = $('#client_status').val();
    var spam            = $('#spam').val();
    if(status_id == web_lead_status){
        $('#web_lead_status').attr('checked',true);
    }else if(status_id == client_status){
        $('#client_status').attr('checked',true);
    }else{
        $('#spam').attr('checked',true);
    }
})
///Change status on modal save
$(document).on('click','.save_status',function(){
    var radio_status        =   $('input[name="radio_status"]:checked').val();
    deleteRef               =   $(this);
    deleteRef.attr('disabled', 'disabled');
    deleteRef.text('Processing...');
    $('#SaveModalStatus').ajaxSubmit({
        type    :   "POST",
        url     :   "/admin/update-lead",
        cache   :   false,
        success :   function(response){
            deleteRef.attr('disabled', false);
            deleteRef.text('Save');
            if(response.msg == 'lead_update'){
                $('#SaveModalStatus')[0].reset();
                $('.close').click();
                all_leads_list();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Lead Update Successfully');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }else if(response.msg== 'already_exists'){
                $('.close').click();
                all_leads_list();
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text('Client Already Exits');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
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
                url: '/admin/delete-lead',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: id
                },
                success: function (response) {
                    if (response.status == 'success') {
                        all_leads_list();
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
all_leads_list();