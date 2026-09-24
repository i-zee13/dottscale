let url = '';
let meta_array = [];
let menuSectionArray = [];
var pages = [];
var pages_cat_data = [];
var footer_records = [];
$(document).ready(function () {

    pages = $('#pages_data').val();
    pages_cat_data = $('#pages_cat_data').val();
    footer_records = $('#footer-records').val();
    if (pages) {
        pages = JSON.parse(pages);
    } if (footer_records) {
        footer_records = JSON.parse(footer_records);
    }
    if (pages_cat_data) {
        pages_cat_data = JSON.parse(pages_cat_data);
    }
    var footerBox = $(".footer-box");
    if (footerBox.find(".div-remove").length >= 1) {
        footerBox.empty();
    }
    if (footerBox.find(".row").length <= 0 && footer_records.length > 0) {
        createBlock(false);
    } else {
        createBlock(true);
    }
});

$(document).on('click', '#save-static', function () {
    if ($(".footer-box").find(".row").length <= 0) {
        showMessage('red', 'Please Add Atleast One Footer Section')
        return;
    }
    var dirty = false;
    var dirty2 = false;
    var footer_links = [];
    var count = 1;
    var headerTitles = [];
    var headerTitleData = [];
    $('.footer-box .row').each(function () {
        var $row = $(this);
        var headerTitle = $row.find('input[name="header_title"]');
        var pageLinks = $row.find('select[name="page_link"]');

        if (headerTitle.val().trim() == '') {
            dirty = true;
            $row.find('input[name="header_title"]').focus();
            return false;
        }
        else if (!pageLinks.val() || pageLinks.val().length == 0 || pageLinks.val()[0] == '') {
            dirty = true;
            $row.find('select[name="page_link"]').focus();
            return false;
        }
        else {
            var id = headerTitle.attr('id').match(/\d+/);
            headerTitleData = headerTitle.val();
            var pageLinksData = [];
            pageLinks.find('option:selected').each(function () {
                pageLinksData.push({
                    'url': $(this).val(),
                    'title': $(this).text()
                });
            });

            if (headerTitles.includes(headerTitleData)) {
                dirty2 = true;
                return false;
            }
            headerTitles.push(headerTitleData);

            id = parseInt(id[0]);
            if (!id) {
                showMessage('red', `Invalid id of row ${count}`);
                dirty = true;
                return false;
            }

            footer_links.push({
                'id': id,
                'header_title': headerTitleData,
                'page_link': pageLinksData,
            });
        }
    });


    if (dirty) {
        showMessage('red', `Please provide all the required information (*)`);
        return;
    }
    if (dirty2) {
        showMessage('red', `Header title "${headerTitleData}" is not unique`);
        return;
    }
    if (footer_links.length == 0) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please add atleast one footer menu');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    else {
        var CurrentRef = $(this);
        CurrentRef.attr('disabled', 'disabled');
        CurrentRef.text('Processing...');
        url = "/admin/save-footer-page-content";
        $('#SaveAboutUsForm').ajaxSubmit({
            type: "POST",
            url: url,
            data: {
                footer_links: footer_links,
            },
            cache: false,
            success: function (response) {
                CurrentRef.attr('disabled', false);
                CurrentRef.text('Save');
                if (response.status == 'success') {
                    showMessage('green', 'Footer Menus Saved Successfully');
                    location.reload();
                }
                else if (response.status == 'duplicate') {
                    showMessage('red', response.msg);
                    return;
                }
                else {
                    showMessage('red', 'Not Added At this moment');

                }
            },
            error: function (err) {
                CurrentRef.attr('disabled', false);
                CurrentRef.text('Save');
                showMessage('red', 'Not Added At this moment');
            }
        });
    }
});
$(document).on('click', '.delete-sideBar-content', function () {
    var id = $(this).attr('id');
    menuSectionArray = menuSectionArray.filter(x => (x.unique != id));
    $(`.data-row-${id}`).remove();
});
$(document).on('click', '.new_block', function () {
    createBlock(true);
});
function createBlock(is_new) {

    if (footer_records.length > 0 && !is_new) {
        var id = null;
        var headerTitle = '';
        var footer_menu = '';
        footer_records.forEach(element => {
            id = element.id ?? '';
            headerTitle = element['header_title'] ?? '';
            footer_menu = element.footer_menu ?? '';
            footer_menu_array = JSON.parse(footer_menu);
            var unselectedOptions     = []
            var sortedSelectedOptions = [];
            footer_menu_array.forEach(page => {
                if (pages.some(item => item.url == page.url) || pages_cat_data.some(item => item.url == page.url)) {
                    sortedSelectedOptions.push(`<option value="${page.url}" selected>${page.title}</option>`);
                }
            });
            pages.forEach(page => {
                if (!(footer_menu_array.some(item => item.url === page.url))) {
                    unselectedOptions.push(`<option value="${page.url}">${page.title}</option>`);
                }
            });
            pages_cat_data.forEach(page => {
                if (!(footer_menu_array.some(item => item.url === page.url))) {
                    unselectedOptions.push(`<option value="${page.url}">${page.title}</option>`);
                }
            });

            $(".footer-box").append(`
                <div class="row delete_row_${id} ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Header Title *</label>
                            <input type="text" class="form-control required_field" placeholder=""
                                name="header_title" id="header_title_${id}" value="${headerTitle}">
                        </div>
                    </div>
                    <div class="col-5 mt-5">
                        <label class="font12 mb-5">Page Link *</label>
                        <div class="form-s2 mb-5  ">
                            <select name="page_link" id="page_links_${id}"
                                class="reports-select multi menu-required" multiple="multiple">
                                <option class="" value=""> Select Page Link </option>
                                ${sortedSelectedOptions.join('')}
                                ${unselectedOptions.join('')}
                            </select>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <button type="button" id="${id}" data-is-new="0" style="border-radius: unset !important;height: 28px; display: none" class="btn btn-default btn-sm custom-btn-style delete_row" title="Revoke">Delete</button>
                    </div>
                </div>`);
        });

    } else {
        var uniqueKey = generateUniqueIntegerKey(8);
        $(".footer-box").append(`
        <div class="row delete_row_${uniqueKey}">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label mb-10">Header Title *</label>
                <input type="text" class="form-control required_field" placeholder=""
                    name="header_title" id="header_title_${uniqueKey}">
            </div>
        </div>
        <div class="col-5 mt-5  ">
            <label class="font12 mb-5">Page Link *</label>
            <div class="form-s2 mb-5">
                <select name="page_link" id="page_links_${uniqueKey}"
                    class="reports-select multi menu-required" multiple="multiple">
                    <option  value="" selected> Select Page Link </option>
                    ${pages.map(page => `
                    <option value="${page.url}">${page.title}</option>
                `).join('')}
                 ${pages_cat_data.map(page => `
                    <option value="${page.url}">${page.title}</option>
                `).join('')}
                </select>
            </div>
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">
                    <button type="button" id="${uniqueKey}" data-is-new="1" style="border-radius: unset !important;height: 28px; display: none" class="btn btn-default btn-sm custom-btn-style delete_row" title="Revoke">Delete</button>
                </div>
    </div>`);
    }
    $('.multi').trigger('change');
    $('.multi').fSelect();
    $('#tblLoader').hide();
    $('.footer-box').show();
    window.fs_test = $('.multi').fSelect('reload');
    $('.fs-options').addClass('sortable');
    $(".sortable").sortable({
        update: function (event, ui) {

            var sortedValues = [];
            $(this).find('.ui-sortable-handle').each(function (index, element) {
                var value = $(element).attr('data-value');
                sortedValues.push(value);
            });
            var selectElementId = $(this).closest('.fs-wrap').find('select').attr('id');
            if (selectElementId) {
                var selectElement = $(`#${selectElementId}`);
                var options = selectElement.find('option').toArray();
                options.sort(function (a, b) {
                    var aValue = sortedValues.indexOf($(a).val());
                    var bValue = sortedValues.indexOf($(b).val());
                    return aValue - bValue;
                });
                selectElement.empty();
                $.each(options, function (index, option) {
                    selectElement.append(option);
                });
            }
        },
    }).disableSelection();



}
$(document).on('click', '.delete_row', function () {
    var isNewRecord = $(this).attr('data-is-new');
    var id = $(this).attr('id');
    var thisRef = $(this);
    if ($(".footer-box").find(".row").length <= 1) {
        showMessage('red', `You cannot delete the last menu.`);
        return;
    }
    if (isNewRecord == 1) {
        $(`.delete_row_${id}`).remove()
        showMessage('green', 'Footer Menu deleted successfully')
    } else {

        thisRef.attr('disabled', 'disabled');
        thisRef.text('Processing...');
        $.ajax({
            type: "POST",
            url: '/admin/delete-footer-row',
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                'id': id
            },
            cache: false,
            success: function (response) {
                thisRef.removeAttr('disabled');
                thisRef.text('Delete');
                if (response.status == "success") {
                    showMessage('green', 'Footer Menu deleted successfully')
                    $(`.delete_row_${id}`).remove()
                } else {
                    showMessage('red', 'Unable To delete at this moment')
                }
            },
            error: function (err) {
                showMessage('red', 'Unable To delete at this moment')
                thisRef.removeAttr('disabled');
                thisRef.text('Delete');
            }
        });

    }
});
function generateUniqueIntegerKey(length) {
    var keySet = new Set();
    while (true) {
        var randomKey = Math.floor(Math.random() * Math.pow(10, length));
        if (!keySet.has(randomKey)) {
            keySet.add(randomKey);
            return randomKey;
        }
    }
}
