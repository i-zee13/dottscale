///runwatch
//  import swal from 'sweetalert';
let deleteRef = '';
let p_service = '';
let s_service = '';
let s_s_service = '';
let duplicate_error = '';
let meta_array = [];
var lastOp = "";
var action = '';
var is_portfolio = 0;
$(document).ready(function () {

  href = String(location.href).replace(/#/, "");
  var segments = href.split('/');
  action = segments[4]; 
  if(action == 'portfolios'){
    is_portfolio = 1;
    loadPrimaryServices();
  }else{
    all_pages_list(is_portfolio); 
  }
  $(document).on('click', '.builder-page-status', function () {
    $('#page_draft').removeAttr('checked');
    $('#page_publish').removeAttr('checked');
    $('#page-inactive').removeAttr('checked');
    $('#hidden_btn_to_open_modal').click();
    var status_id     = $(this).attr('data-status');
    builder_page_id   = $(this).attr('id');
    $('#page_id').val(builder_page_id);
    var page_draft    = $('#page_draft').val();
    var page_publish  = $('#page_publish').val();
    var page_inactive = $('#page-inactive').val();
    if (status_id == page_draft) {
      $('#page_draft').attr('checked', true);
    } else if (status_id == page_publish) {
      $('#page_publish').attr('checked', true);
    } else {
      $('#page-inactive').attr('checked', true);
    }
  })
  $(document).on('click', '.save-page-status', function () {
    var status = $('input[name="radio_status"]:checked').val();
    $.ajax({
      type: "post",
      url: '/admin/save-page-with-status/' + builder_page_id,
      data: {
        'status': status,
        '_token': $('meta[name="csrf_token"]').attr('content'),
      },
      success: function (response) {
        if (response.status == 'success') {
          $('#notifDiv').fadeIn();
          $('#notifDiv').css('background', 'green');
          $('#notifDiv').text('Page status updated successfully.');
          setTimeout(() => {
            $('#notifDiv').fadeOut();
          }, 3000);
          $('#SaveModalStatusPage')[0].reset();
          if(action == 'portfolios'){
            is_portfolio = 1;
            loadPrimaryServices();
          }else{
            all_pages_list(is_portfolio); 
          }
          String(document.location.href).replace("#/", "");
         
          $('.close').click();
        } else {
          $('#notifDiv').fadeIn();
          $('#notifDiv').css('background', 'red');
          $('#notifDiv').text('Not Updated at this moment.');
          setTimeout(() => {
            $('#notifDiv').fadeOut();
          }, 3000);
          $('.close').click();
        }

      }
    });

  })
  $(document).on('click', '.add_page', function () {
    $('#SavePageForm')[0].reset();
    $('#hidden_page_id').val('');
    $('#hidden_page_translation_id').val('');
    $('select[name="page_type"]').val(0).trigger('change');
    RemoveImage('thumbnail');
    RemoveImage('meta_og_image');
    openSidebar();
  })
  $(document).on('click', '#save-page', function () {
    let dirty = false;
    var count = 1;
    var lettersReg = /^[A-Za-z\-\_/]+$/;
    var route_input = $('#page_route').val();
    var categories = $('#categories').val();
    $('.faq-required').each(function () {
      if ((!$(this).val() && !$(this).val().trim()) || $(this).val() == 0) {
        dirty = true;
        if(count == 1){
          $(this).focus();
        }
        count++;
      }
    });

    if(segments[4] == 'portfolios'){
      if (!$("#thumbnail").prop("files")[0] && !$("#hidden_thumbnail").val()) { 
        dirty = true;
      }   
      if (!categories || categories.length <= 0) {
          dirty = true;
      } 
    }

    if (dirty) {
      $('#notifDiv').fadeIn();
      $('#notifDiv').css('background', 'red');
      $('#notifDiv').text('Please provide all the required information (*)');
      setTimeout(() => {
        $('#notifDiv').fadeOut();
      }, 3000);
      return;
    }
    if (lettersReg.test(route_input) == false && route_input != '') {
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
    meta_array = [];
    meta_array.push({
      'meta_content_author'     : $('#meta_content_author').val(),
      'meta_content_keywords'   : $('#meta_content_keywords').val(),
      'meta_content_description': $('#meta_content_description').val(),
      'meta_og_title'           : $('#meta_og_title').val(),
      'meta_og_description'     : $('#meta_og_description').val(),
      'meta_structure_tags'     : $('#meta_structure_tags').val(),
      'is_indexable'            : $('select[name="is_indexable"]').val(),   
      'is_followable'          : $('select[name="is_followable"]').val()  
    }) 
    $('#SavePageForm').ajaxSubmit({
      type: "POST",
      url: "/admin/save-page",
      data: {
        meta_array: meta_array,
        categories:categories
      },
      success: function (response) {
        CurrentRef.attr('disabled', false);
        CurrentRef.text('Save');
        if (response.msg == 'page_added') {

          if(segments[4] == 'portfolios'){
            loadPrimaryServices();
            msg   = 'Portfolio has been Added';
          }else{
              msg = 'Page has been Added';
              all_pages_list(is_portfolio);
          }  
          $('#notifDiv').fadeIn();
          $('#notifDiv').css('background', 'green');
          $('#notifDiv').text(msg);
          setTimeout(() => {
            $('#notifDiv').fadeOut();
          }, 3000);
          closeSidebar(); 
          $('#SavePageForm')[0].reset();
          $('select[name="page_type"]').val(0).trigger('change'); 

        } else if (response.status == 'duplicate') {
          if (response.msg == 'Page Route') {
            duplicate_error = "Route Already Exist"
          }
          if (response.msg == 'Page Title') {
            duplicate_error = "Page Title Already Exist"
          }
          if (response.msg == 'Portfolio Name') {
            duplicate_error = "Portfolio Name Already Exist"
          }
          if (response.msg == 'Already exist') {
            duplicate_error = "Already Exist."
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
      }, error: function (error) {
        CurrentRef.attr('disabled', false);
        CurrentRef.text('Save');
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Not added at this moment');
        setTimeout(() => {
          $('#notifDiv').fadeOut();
        }, 3000);
      }
    })
  })
  $(document).on('click', '.openDataSidebarForAddingMainCat', function () { 
    $('#SavePageForm')[0].reset();
    $('.display').css('display', 'block'); 
    $('input[name="portfolio_name"]').val("");
    $('#hidden_og_image').val('')
    $('input[name="page_title"]').val('');  
    $('input[name="hidden_page_translation_id"]').val('');
    $('input[name="hidden_page_id"]').val('');
    $('input[name="hidden_portfolio_id"]').val(''); 
    $('#dataSidebarLoader').hide();
    $('.dz-image-preview').remove();
    $('.dz-default').show();
    RemoveImage('thumbnail');
    RemoveImage('meta_og_image');
    if (lastOp == "update") {
      $('input[name="portfolio_name"]').val("");
      $('input[name="portfolio_name"]').blur(); 
    }
    lastOp = 'add'; 
    if ($('#saveMainCatForm input[name="_method"]').length) {
      $('#saveMainCatForm input[name="_method"]').remove();
    } 
    $('input[id="operation"]').val('add');
    $('#categories').val([]);
    window.fs_test = $('.multi').fSelect('reload');
    openSidebar();
  });
  
  $(document).on('click', '.edit_page', function () {
    openSidebar();
    $('#categories').val([]);
    $('#hidden_og_image').val('')
    var id              = $(this).attr('id');
    var CurrentRef      = $(this);
    var portfolio_name  = $(this).attr("data-service-name");
    var portfolio_id    = $(this).attr("data-service-id");
    var categories    = $(this).attr("data-category"); 

    CurrentRef.attr('disabled', 'disabled');
    CurrentRef.text('Processing...');
    $.ajax({
      type: 'GET',
      url: `/admin/edit-page/${id}`,
      success: function (response) { 
        CurrentRef.attr("disabled", false);
        CurrentRef.text("Page Properties"); 
        $('input[name="hidden_portfolio_id"]').val(portfolio_id);
        $('input[name="is_slider_show"]').prop('checked', response.getpage.is_slider_show);
        $('.portfolio_name').focus();
        $('.portfolio_name').val(portfolio_name);
        $('.portfolio_name').blur();
        $('#categories').focus();  
        console.log(typeof(categories))
        if(categories){ 
            var categoriesArray = categories.split(','); 
              console.log(categoriesArray)
              categoriesArray.forEach(function(category) {
                console.log(category)
                $('select[name="categories"] option[value="' + category.trim() + '"]').prop('selected', true);
            });  
          } 
      
        $('input[name="page_title"]').focus();
        $('input[name="page_title"]').val(response.getpage.name);
        $('input[name="page_title"]').blur();
        // window.fs_test = $('.multi').fSelect('reload');
        if (response.getpage && response.getpage.thumbnail) {
          $('input[name="thumbnail"]').attr("data-default-file","/storage/" + response.getpage.thumbnail);
          var dropifyPreviewWrapper =$("#thumbnail").closest(".dropify-wrapper"); 
          var dropifyPreview = dropifyPreviewWrapper.find(".dropify-preview"); 
          dropifyPreview.html(
              `<div class="dropify-render"><img src="/storage/${response.getpage.thumbnail}" alt="Front Image"></div>`
          );
          dropifyPreview.css("display", "block");
          $('input[name="hidden_thumbnail"]').val(`${response.getpage.thumbnail}`) 
        }else{
          RemoveImage('thumbnail')  
          $('input[name="hidden_thumbnail"]').val('') 
        }
        route = (response.getpage.route).replace('/', '');
        var readOnlyAttr = false;
        if(route == "home" || route == "about-us" || route == "blogs" || route == "contact-us" || route == "career"){
          readOnlyAttr = true;
        }
        $('input[name="page_route"]').focus();
        $('input[name="page_route"]').val(route).attr('readonly',readOnlyAttr);
        $('input[name="page_route"]').blur();

        $('#page_type').val(response.getpage.page_type).trigger('change');

        $('input[name="hidden_page_translation_id"]').val(response.getpage.page_translaition_id);
        $('input[name="hidden_page_id"]').val(response.getpage.id);

        $('#is_indexable').val(response.getpage.is_indexable).trigger('change');
        $('#is_followable').val(response.getpage.is_followable).trigger('change');
        
        //Meta Details
        if (response.page_meta != null) {
          $('input[name="meta_content_author"]').focus();
          $('input[name="meta_content_author"]').val(response.page_meta.meta_content_author);
          $('input[name="meta_content_author"]').blur();

          $('input[name="meta_content_keywords"]').focus();
          $('input[name="meta_content_keywords"]').val(response.page_meta.meta_content_keywords);
          $('input[name="meta_content_keywords"]').blur();

          $('textarea[name="meta_content_description"]').focus();
          $('textarea[name="meta_content_description"]').val(response.page_meta.meta_content_description);
          $('textarea[name="meta_content_description"]').blur();

          $('textarea[name="meta_og_title"]').focus();
          $('textarea[name="meta_og_title"]').val(response.page_meta.meta_og_title);
          $('textarea[name="meta_og_title"]').blur();

          $('textarea[name="meta_og_description"]').focus();
          $('textarea[name="meta_og_description"]').val(response.page_meta.meta_og_description);
          $('textarea[name="meta_og_description"]').blur();
          $('textarea[name="meta_structure_tags"]').focus();
          $('textarea[name="meta_structure_tags"]').val(response.page_meta.meta_structure_tags);
          $('textarea[name="meta_structure_tags"]').blur(); 
          console.table(response.getpage)
          if (response.getpage.meta_og_image) {
            $('#meta_og_image').attr('data-default-file', response.getpage.meta_og_image);
            $('#hidden_og_image').val(response.getpage.meta_og_image);
            var dropifyPreviewWrapper = $('#meta_og_image').closest('.dropify-wrapper');
            var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
            dropifyPreview.css('display', 'block');
            dropifyPreview.find('.dropify-render').html(`<img src="/storage/${response.getpage.meta_og_image}" alt="Front Image">`);
          } else {
            RemoveImage("meta_og_image");;
          }
        } else {
          $('input[name="meta_content_author"]').val('');
          $('input[name="meta_content_keywords"]').val('');
          $('textarea[name="meta_content_description"]').val('');
          $('textarea[name="meta_og_title"]').val('');
          $('textarea[name="meta_og_description"]').val('');
          $('input[name="meta_og_image"]').val('');
          RemoveImage("meta_og_image");;
        }
      }
    });
 
  })
  function RemoveImage(id) {
    $(`#${id}`).attr("data-default-file", "");
    $(`#${id}`).closest(".dropify-wrapper").find(".dropify-render").html("");
    $(`#${id}`).closest(".dropify-wrapper").find(".dropify-preview").removeAttr("style");
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

    if ($(this).attr('page-status') == 2) {
      $('.ChangePageStatus').attr('disabled', 'disabled');
      var thisrow = $(this);
      change_page_status = $(this).attr('id');
      $.ajax({
        type: 'POST',
        url: '/admin/land-page-status',
        data: {
          _token: $('meta[name="csrf_token"]').attr('content'),
          id: change_page_status
        },
        success: function (response) {
          $('.ChangePageStatus').removeAttr('disabled')
          $('.ChangePageStatus').text('In-Active')
          thisrow.attr('disabled', 'disabled');
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
  $('#page_title,.portfolio_name').keyup(function () {
    var route = $('input[name="page_route"]').val().trim();
    var routeChange = true;
    if(route){
      if(route == "home" || route == "about-us" || route == "insights" || route == "contact-us" || route == "career"){
        routeChange = false;
      }
    }
    $('#page_title').val($(this).val());
    var str = $('#page_title').val();
    str = str.replace(/\s+/g, '-').toLowerCase();
    if(routeChange){
      $('#page_route').val(str);
      $('#page_route').focus();
    }
    $('#page_title').focus();
    $('.portfolio_name').focus();


  })
  function all_pages_list(is_portfolio = null) {
    $('.loader').show();
    $('.pages_list').empty();
    $.ajax({
      type: 'GET',
      url: '/admin/all-list-pages',
      data:{
        is_portfolio:is_portfolio
      },
      success: function (response) {
        $('.pages_list').append(`
            <table class="table table-hover dt-responsive nowrap PagesListTable" style="width:100%;">
                <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>URL</th> 
                      <th>Type</th>
                      <th>Status</th>
                      <th style="width: 250px;">Action</th>
                   </tr>
                </thead>
              <tbody></tbody>
            </table>`);
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
                  <button type="button" id="${element['id']}" ${element['route'] == "/home" || element['route'] == "/about-us" || element['route'] == "/career" || element['route'] == "/insights" || element['route'] == "/contact-us" ? 'disabled' : ''} data-status="${element['page_status']}" class="btn builder-page-status _TOverdue ${element['page_status'] == 1 ? 'TS-InReview' : element['page_status'] == 2 ? 'TS-Completed' : 'TS-NotStarted'}">
                    ${element['page_status'] == 1 ? 'Draft' :
                    element['page_status'] == 2 ? 'Publish' :
                    element['page_status'] == 3 ? 'In-Active' : 'NA'}
                  </button>
                </td>
                <td style="width: 240px;"class="d-flex">
                  <a id="${element['id']}" class="btn btn-default btn-line edit_page" href="javascript:void(0);">Page Properties</a>
                  <a target="_blank" id="${element['id']}" class="btn btn-default btn-line" href="/admin/pages/${element['id']}">Build Page</a>
                </td>
            </tr>
          `);
        });
        $('.PagesListTable').fadeIn();
        $('.PagesListTable').DataTable();
        $('.loader').hide();
      }
    })
  }
  function loadPrimaryServices() {
    $(".loader").show();
    $(".tablebody").empty();
    $.ajax({
        type: "GET",
        url: "/admin/get-primary-services-load", // Replace with your actual API endpoint
        success: function (response) {
            console.log("Response received:", response); // Debugging step

            $(".tablebody").append(`
            <table class="table table-hover dt-responsive nowrap PrimaryServicesTable " style="width:100%; ">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Page Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        `);

            $(".PrimaryServicesTable tbody").empty();

            response.primary_services.forEach((data, key) => {
                console.log("Processing service:", data); // Debugging step 
                // Convert the page object to an array if it's not already an array
                const pages = Array.isArray(data.page)
                    ? data.page
                    : Object.values(data.page);

                if (pages.length > 0) {
                    pages.forEach((build) => {
                        console.log("Appending page:", build); // Debugging step

                        $(".PrimaryServicesTable tbody").append(`
                        <tr>
                            <td>${key + 1}</td>
                            <td>${data.portfolio_name}</td>
                            <td>
                                <button type="button" id="${
                                    build.id
                                }" data-status="${build.page_status}" 
                                    class="btn builder-page-status _TOverdue 
                                    ${
                                        build.page_status == 1
                                            ? "TS-InReview"
                                            : build.page_status == 2
                                            ? "TS-Completed"
                                            : "TS-NotStarted"
                                    }">
                                    ${
                                        build.page_status == 1
                                            ? "Draft"
                                            : build.page_status == 2
                                            ? "Publish"
                                            : build.page_status == 3
                                            ? "In-Active"
                                            : "NA"
                                    }
                                </button>
                            </td>
                            <td>
                                <a id="${
                                    build.id
                                }" class="btn btn-default btn-line edit_page" 
                                    data-service-name="${
                                        data.portfolio_name
                                    }" data-service-id="${data.id}" data-category="${
                                        data.portfolio_categories
                                    }">
                                    Page Properties
                                </a>
                                <a target="_blank" id="${build.id}" class="btn btn-default btn-line" href="/admin/pages/${build.id}">Build Page </a>
                               
                            </td>
                        </tr>
                    `);
                    });
                } else {
                    console.log(
                        "No pages found for service:",
                        data.portfolio_name
                    ); // Debugging step

                    $(".PrimaryServicesTable tbody").append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${data.portfolio_name}</td>
                        <td></td>
                        <td></td>
                    </tr>
                `);
                }
            });

            $(".PrimaryServicesTable").fadeIn();
            $(".PrimaryServicesTable").DataTable();
            $(".loader").hide();
        },
        error: function (error) {
            console.error("Error fetching data", error);
            $(".loader").hide();
        },
    });
}
});
