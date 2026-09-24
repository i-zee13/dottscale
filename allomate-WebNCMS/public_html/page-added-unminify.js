///runwatch
//  import swal from 'sweetalert';
let deleteRef = '';
let p_service = '';
let s_service = '';
let s_s_service = '';
let duplicate_error = '';
$(document).ready(function(){
$(document).on('click', '.add_page', function () {
    $('#SavePageForm')[0].reset();
    $('select[name="page_type"]').val(0).trigger('change');
    openSidebar();
})
$(document).on('click', '#save-page', function () {
    let dirty           = false;
    var lettersReg      = /^[A-Za-z\-\_]+$/;
    var route_input     =   $('#page_route').val();
    $('.faq-required').each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
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
    if (lettersReg.test(route_input)==false && route_input != '') {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Only Alphabate with (-) are allowed in Page Route ');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $('#SavePageForm').ajaxSubmit({
        type: "POST",
        url : "/admin/save-page",
        success: function (response) {
            CurrentRef.attr('disabled', false);
            CurrentRef.text('Save');
            if (response.msg == 'page_added') {
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text('Page Added');
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
                $('#SavePageForm')[0].reset();
                $('select[name="page_type"]').val(0).trigger('change');
                closeSidebar();
                all_pages_list();

            }else if(response.status == 'duplicate') {
              if(response.msg == 'Page Route')
              { 
                duplicate_error =   "Route Already Exist"
              }
              if(response.msg == 'Page name')
              {
                duplicate_error = "Page Title Already Exist"
              }
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(duplicate_error);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            } else {
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
$(document).on('click', '.edit_page', function () {
    openSidebar();
    var id = $(this).attr('id');
    var CurrentRef = $(this);
    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $.ajax({
        type: 'GET',
        url: `/admin/edit-page/${id}`,
        success: function (response) {

            CurrentRef.attr('disabled', false);
            CurrentRef.text('Edit');
            $('input[name="page_title"]').focus();
            $('input[name="page_title"]').val(response.getpage.name);
            $('input[name="page_title"]').blur();

            route = (response.getpage.route).replace('/', '')
            $('input[name="page_route"]').focus();
            $('input[name="page_route"]').val(route);
            $('input[name="page_route"]').blur();

            $('#page_type').val(response.getpage.page_type).trigger('change');

            $('input[name="hidden_page_translation_id"]').val(response.getpage.page_translaition_id);
            $('input[name="hidden_page_id"]').val(response.getpage.id);

        }
    });
})
function all_pages_list() {
    $('.pages_list').empty();
    $.ajax({
        type: 'GET',
        url: '/all-list-pages',
        success: function (response) {
            $('.pages_list').append('<table class="table table-hover dt-responsive nowrap PagesListTable" style="width:100%;"><thead><tr><th>S.No</th><th>Name</th><th>URL</th> <th>Type</th><th>Status</th><th>Action</th></tr></thead><tbody></tbody></table>');
            $('.PagesListTable tbody').empty();

            response.all_pages.forEach((element, key) => {
                $('.PagesListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['name']}</td>
                        <td>${element['route']}</td>
                        <td>
                            ${element['page_type'] == 1 ? 'Landing' :
                            element['page_type'] == 2 ? 'Service' :
                              element['page_type'] == 3 ? 'General' : 'Offer'}

                        </td>
                        <td>
                            ${element['page_status'] == 1 ? 'Draft' :
                              element['page_status'] == 2 ? 'Publish' :
                              element['page_status'] == 3 ? 'In-Active' : 'NA'}
                        </td>
                        <td>
                            <a  id="${element['id']}" class="btn btn-default btn-line edit_page" href="javascript:void(0);">
                            Page Properties
                            </a>
                            ${ element['page_status'] == 2 ?
                           ` <a target="_blank" id="${element['id']}" class="btn btn-default btn-line" href="${element['route']}">
                            View
                            </a>`: ''}
                            <a target="_blank" id="${element['id']}" class="btn btn-default btn-line" href="/admin/pages/${element['id']}">
                            Build Page
                            </a>
                            <button id="${element['id']}"  page-status="${element['page_status']}"  class="btn btn-default  ChangePageStatus"
                            ${element['page_type'] == 1 && element['page_status'] == 2 ? 'style="display:block"' : 'style="display:none"'}
                            page-status-default="${element['landing_page_status']}"
                            ${( (element['landing_page_status'] == "1") ? "disabled" : '')}>   ${(element['landing_page_status'] == "0" ? "In-Active" : 'Activated')}</button>

                        </td>
                    </tr>`);
            });
            $('.PagesListTable').fadeIn();
            $('.PagesListTable').DataTable();
            $('.loader').hide();
        }
    })
}

$(document).on('change', '#page_type', function () {
    if ($(this).val() != 0) {
        if ($(this).val() == 2) {
            $('.display').css('display', 'block');
        } else {
            $('.display').css('display', 'block');
        }
    } else {
        $('.display').css('display', 'none');
        $('#page_title').val('');
        $('#page_route').val('');
    }
})
let change_page_status
 ///Land Page Status Change
 $(document).on('click', '.ChangePageStatus', function () {
    
    if($(this).attr('page-status') == 2)
    {
        $('.ChangePageStatus').attr('disabled','disabled');
    var thisrow =   $(this);
     change_page_status = $(this).attr('id');
    $.ajax({
        type    :   'POST',
        url     :   '/admin/land-page-status',
        data: {
            _token  : $('meta[name="csrf_token"]').attr('content'),
            id      :   change_page_status
        },
        success: function (response) {
            $('.ChangePageStatus').removeAttr('disabled')
            $('.ChangePageStatus').text('In-Active')
            thisrow.attr('disabled','disabled');
            thisrow.text('Activated');
            change_page_status = '';
            $('#notifDiv').fadeIn();
            $('#notifDiv').css('background', 'green');
            $('#notifDiv').text('Default Page updated successfully.');
            setTimeout(() => {
                $('#notifDiv').fadeOut();
            }, 3000);
        }

    })
    }
   
})
$('#page_title').keyup(function(){
    var str  =   $('#page_title').val();
    str = str.replace(/\s+/g, '-').toLowerCase();
    $('#page_route').val(str);
   $('.page_route').addClass('focused');
})


    all_pages_list();

})
