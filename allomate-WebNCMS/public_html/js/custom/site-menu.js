var segments = location.href.split('/');
var filtered_products = [];
var ProductsArray = [];
var brand_category_content = [];
var content_records = [];
let menu_items = [];
let item_arr = [];
let existing_items_array = '';
$(document).ready(function () {
    pages = $('#pages_data').val();
    pages_cat_data = $('#pages_cat_data').val();
    menu_records = $('#menu-records').val();
    if (pages) {
        pages = JSON.parse(pages);
    } if (menu_records) {
        menu_records = JSON.parse(menu_records);
    }

    if (pages_cat_data) {
        pages_cat_data = JSON.parse(pages_cat_data);
    }
    if (!menu_records || menu_records.length <= 0) {
        $('.menu-row').empty();
        createBlock();
    } else {

        $('.sortable').sortable();
    }
});
$(document).on('change', '.custom-control-input', function () {
    if ($(this).is(':checked')) {
        $(this).val(1);
    } else {
        $(this).val(0);
    }
});
$(document).on('click', '.save_web_menu', function () {

    if ($(".menu-row").find(".singleMenu").length <= 0) {
        showMessage('red', 'Please Add Atleast One Web Menu')
        return;
    }
    var menu_items = [];
    $('.menu-row .singleMenu').each(function () {
        var id = $(this).attr('id');
        var signleMenu = $(this);
        var title_tier_one = signleMenu.find(`#tier_one_title_${id}`);
        var url_tier_one = signleMenu.find(`#tier_one_url_${id}`);
        var new_window_tier_one = signleMenu.find(`#tier_one_new_window_${id}`);
        console.log(title_tier_one.val());
        console.log(url_tier_one.val());
        var second_tier = [];
        var third_tier = [];
        signleMenu.find('.newSecondTierPlace').find('.secondTierIterate').each(function () {
            console.log("run")
            third_tier = [];
            var title = $(this).find('input[name="title"]');
            var url = $(this).find('input[name="url"]');
            var new_window = $(this).find('input[name="new_window"]');
            if (title && url && title.val() && url.val()) {

                var $parentDiv = $(this).find('.thirdTierIterate');
                console.log($parentDiv);

                $parentDiv.each(function () {
                    var third_title = $(this).find('input[name="title"]');
                    var third_url = $(this).find('input[name="url"]');
                    var third_new_window = $(this).find('input[name="new_window"]');
                    console.log(third_title);
                    console.log(third_url);
                    console.log(third_new_window);

                    if (third_title.val().trim() && third_url.val().trim()) {
                        third_tier.push({
                            'url': third_url.val(),
                            'title': third_title.val(),
                            'new_window': third_new_window.val(),
                        });
                    }

                });
                second_tier.push({
                    'url': url.val(),
                    'title': title.val(),
                    'new_window': new_window.val(),
                    'sub_SubMenu': third_tier
                });

            }

        });

        if (title_tier_one && title_tier_one.val() && url_tier_one && url_tier_one.val()) {
            menu_items.push({
                'id': id,
                'tier_one_title': title_tier_one.val(),
                'new_window_tier_one': new_window_tier_one.val(),
                'tier_one_url': url_tier_one.val(),
                'sub_menu': second_tier,
            });
        }
    });
    console.log(menu_items);
    if (menu_items.length == 0) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please add atleast one Menu Item');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    else {
        var CurrentRef = $(this);
        CurrentRef.attr('disabled', 'disabled');
        CurrentRef.text('Processing...');
        url = "/admin/save-menu-list";
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: {
                menu_items: menu_items,
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            cache: false,
            success: function (response) {
                CurrentRef.prop('disabled', false).text('Save');
                if (response.status === 'success') {
                    showMessage('green', 'Menus Saved Successfully');
                    location.reload();
                } else if (response.status === 'duplicate') {
                    showMessage('red', response.msg);
                    return;
                } else {
                    showMessage('red', 'Not Added At this moment');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                showMessage('red', 'Unable to save try again later');
                CurrentRef.prop('disabled', false).text('Save');
            }
        });

    }
});

$(document).on('change', '.menuSelect', function () {
    var $parentRow = $(this).closest('.PackagingOption');
    var $titleInput = $parentRow.find('input[name="title"]');
    var $urlInput = $parentRow.find('input[name="url"]');
    if ($(this).val()) {
        $titleInput.val($(this).find('option:selected').text().trim());
        $urlInput.val($(this).val().trim());
    } else {
        $titleInput.val('');
        $urlInput.val('');

    }

});

$(document).on('click', '.new_block', function () {

    createBlock(true);
});

$(document).on('click', '.new_second_tier', function () {
    var $parentDiv = $(this).closest('.newSecondTierPlace');
    var uniqueKey = generateUniqueIntegerKey(8);
    var collapse_id = generateUniqueIntegerKey(10);
    $parentDiv.append(`
    <div class="sortable-moves   secondTierIterate delete_row_${uniqueKey}" >
    <div class="col-12">
    <div class="PackagingOption second_tier mb-0 " style="background-color: #ebebeb;">
    <div class="row">
        <div class="col-4 pr-0">
            <select class="custom-select custom-select-sm menuSelect formselect"style="width: 100%!important;">
                <option value="">Select Menu</option>
                ${pages.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
                ${pages_cat_data.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
            </select>

        </div>
        <div class="col pr-0">
            <input type="text" class="form-control input-style" name="title" id="tier_two_title_${uniqueKey}" placeholder="title here">
        </div>
        <div class="col pr-0">
            <input type="text" class="form-control input-style" name="url" id="tier_two_url_${uniqueKey}" placeholder="url here..">
        </div>
        <div class="col-3" style="padding-top:5px">
            <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                <input type="checkbox" name="new_window" class="custom-control-input" value="1" id="tier_two_new_window_${uniqueKey}" checked="">
                <label class="custom-control-label" for="tier_two_new_window_${uniqueKey}">New Window ?</label>
            </div>
        </div>
        <div class="col-auto position-relative">
            <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row" title="Delete"><i class="fa fa-trash-alt"></i></button>
            <!-- <button type="button" class="btn editListPO" data-toggle="collapse" data-target="#sub_subMenu${collapse_id}" aria-expanded="false" aria-controls="sub_subMenu${collapse_id}" title=""><i class="fa fa-angle-down"></i></button> -->
        </div>
    </div>
</div>
<div class="collapse" id="sub_subMenu${collapse_id}">
    <div class="addPackagingOption" style="border: solid 1px #e0e0e0;">
        <div class="row">
            <div class="col-12 position-relative thirdTierPlace  sortable" >
                <div class="row m-0">
                    <div class="col mt-auto mb-auto pl-0">
                        <strong class="font16"> Submenu 3</strong>
                    </div>
                    <div class="col-auto new_third_tier">
                        <button type="submit" class="btn btn-primary add-sub-m"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="sortable-moves   thirdTierIterate delete_row_${uniqueKey}">
                    <div class="col-12 ">
                        <div class="PackagingOption third_tier mb-0 " style="background-color: #ebebeb;">
                            <div class="row">
                                <div class="col-4 pr-0">
                                    <select class="custom-select custom-select-sm  formselect  menuSelect"style="width: 100%!important;" >
                                        <option value="">Select Menu</option>
                                        ${pages.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
                                        ${pages_cat_data.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
                                    </select>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control input-style" name="title" id="tier_three_title_${uniqueKey}" placeholder="title here">
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control input-style" name="url" id="tier_three_url_${uniqueKey}" placeholder="url here..">
                                </div>
                                <div class="col-3" style="padding-top:5px">
                                    <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                        <input type="checkbox" name="new_window" class="custom-control-input" value="1" id="tier_three_new_window_${uniqueKey}" checked="">
                                        <label class="custom-control-label" for="tier_three_new_window_${uniqueKey}">New Window ?</label>
                                    </div>
                                </div>
                                <div class="col-auto position-relative">
                                    <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    `)
    $(".sortable").sortable();
    $(".formselect").select2();

});
$(document).on('click', '.new_third_tier', function () {
    var $parentDiv = $(this).closest('.thirdTierPlace');
    var uniqueKey = generateUniqueIntegerKey(8);
    var collapse_id = generateUniqueIntegerKey(10);
    $parentDiv.append(`
    <div class="sortable-moves   thirdTierIterate delete_row_${uniqueKey}">
    <div class="col-12">
                        <div class="PackagingOption third_tier mb-0 " style="background-color: #ebebeb;">
                            <div class="row">
                                <div class="col-4 pr-0">
                                    <select class="custom-select custom-select-sm menuSelect formselect "style="width: 100%!important;" >
                                        <option value="">Select Menu</option>
                                        ${pages.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
                                        ${pages_cat_data.map(page => `<option value="${page.url}">${page.title}</option>`).join('')}
                                    </select>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control input-style" name="title" id="tier_three_title_${uniqueKey}" placeholder="title here">
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control input-style" name="url" id="tier_three_url_${uniqueKey}" placeholder="url here..">
                                </div>
                                <div class="col-3" style="padding-top:5px">
                                    <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                        <input type="checkbox" name="new_window" class="custom-control-input" value="1" id="tier_three_new_window_${uniqueKey}" checked="">
                                        <label class="custom-control-label" for="tier_three_new_window_${uniqueKey}">New Window?</label>
                                    </div>
                                </div>
                                <div class="col-auto position-relative">
                                    <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row" title="Delete"><i class="fa fa-trash-alt"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
    `)
    $(".sortable").sortable();
    $(".formselect").select2();

});

function createBlock() {
    var uniqueKey = generateUniqueIntegerKey(8);
    var collapse_id = generateUniqueIntegerKey(10);
    $(".menu-row").append(`
        <div class="sortable-moves    singleMenu delete_row_${uniqueKey}" id="${uniqueKey}">
        <div class="col-12">
            <div class="PackagingOption first_tier mb-0">
                <div class="row">
                    <div class="col-4 pr-0">
                        <select class="custom-select custom-select-sm menuSelect formselect "style="width: 100%!important;" >
                            <option value="">Select Menu</option>
                            ${pages.map(page => `
                            <option value="${page.url}"  >${page.title}</option>
                        `).join('')}
                        ${pages_cat_data.map(page => `
                        <option value="${page.url}"  >${page.title}</option>
                    `).join('')}
                        </select>

                    </div>
                    <div class="col pr-0">
                        <input type="text" class="form-control input-style " name="title" id="tier_one_title_${uniqueKey}"
                            placeholder="title here">
                    </div>
                    <div class="col pr-0">
                        <input type="text" class="form-control input-style" placeholder="url here" name="url"  id="tier_one_url_${uniqueKey}">
                    </div>
                    <div class="col-2" style="padding-top:5px">
                        <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                            <input type="checkbox" name="new_window" class="custom-control-input"
                                value="1" id="tier_one_new_window_${uniqueKey}" checked="">
                            <label class="custom-control-label" for="tier_one_new_window_${uniqueKey}">New Window?</label>
                        </div>
                    </div>
                    <div class="col-auto position-relative">
                        <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row" title="Delete"><i
                                class="fa fa-trash-alt"></i></button>
                        <button type="button" class="btn editListPO" data-toggle="collapse"
                            data-target="#subMenu${collapse_id}" aria-expanded="false"
                            aria-controls="subMenu${collapse_id}" title=""><i
                                class="fa fa-angle-down"></i></button>
                    </div>
                </div>
            </div>
            <div class="collapse " id="subMenu${collapse_id}">
            <div class="addPackagingOption  ">
                <div class="row ">
                    <div class="col-12 position-relative PB-20 newSecondTierPlace  sortable ">
                <div class="row m-0">
                    <div class="col mt-auto mb-auto pl-0">
                        <strong class="font16"> Submenu</strong>
                    </div>
                    <div class="col-auto new_second_tier"><button type="submit"
                            class="btn btn-primary add-sub-m"><i
                                class="fa fa-plus"></i></button></div>
                </div>
                <div class="sortable-moves  secondTierIterate delete_row_${uniqueKey}">
                    <div class="col-12  ">
                        <div class="PackagingOption    second_tier mb-0 "
                            style="background-color: #ebebeb;">
                            <div class="row  ">
                                <div class="col-4 pr-0 ">
                                    <select class="custom-select custom-select-sm menuSelect formselect " style="width: 100%!important;" >
                                        <option value="">Select Menu</option>
                                        ${pages.map(page => `
                                        <option value="${page.url}"  >${page.title}</option>
                                    `).join('')}
                                    ${pages_cat_data.map(page => `
                                    <option value="${page.url}"  >${page.title}</option>
                                `).join('')}
                                    </select>

                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control input-style " name="title" id="tier_two_title_${uniqueKey}"
                                        placeholder="title here">
                                </div>
                                <div class="col pr-0"><input type="text"
                                        class="form-control input-style" name="url" id="tier_two_url_${uniqueKey}"
                                        placeholder="url here.."></div>
                                <div class="col-3" style="padding-top:5px">
                                    <div
                                        class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                        <input type="checkbox" name="new_window"
                                            class="custom-control-input" value="1"
                                            id="tier_two_new_window_${uniqueKey}" checked="">
                                        <label class="custom-control-label"
                                            for="tier_two_new_window_${uniqueKey}">New Window ?</label>
                                    </div>
                                </div>

                                <div class="col-auto position-relative">
                                    <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row"
                                        title="Delete"><i
                                            class="fa fa-trash-alt"></i></button>
                                    <!-- <button type="button" class="btn editListPO"
                                        data-toggle="collapse"
                                        data-target="#sub_subMenu${collapse_id}"
                                        aria-expanded="false"
                                        aria-controls="sub_subMenu${collapse_id}"
                                        title=""><i
                                            class="fa fa-angle-down"></i></button> -->
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="sub_subMenu${collapse_id}">
                            <div class="addPackagingOption"
                                style="border: solid 1px #e0e0e0;">
                                <div class="row">
                                    <div class="col-12 position-relative thirdTierPlace sortable">

                                        <div class="row m-0">
                                            <div class="col mt-auto mb-auto pl-0">
                                                <strong class="font16"> Sub-Submenu</strong>
                                            </div>
                                            <div class="col-auto new_third_tier"  ><button type="submit"
                                                    class="btn btn-primary add-sub-m"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="sortable-moves   thirdTierIterate delete_row_${uniqueKey}">
                                            <div class="col-12  ">
                                            <div class="PackagingOption third_tier mb-0 "
                                            style="background-color: #ebebeb;">
                                            <div class="row">
                                                <div class="col-4 pr-0">
                                                    <select class="custom-select custom-select-sm menuSelect formselect " style="width: 100%!important;"  >
                                                        <option value="">Select Menu</option>
                                                        ${pages.map(page => `
                                                        <option value="${page.url}"  >${page.title}</option>
                                                    `).join('')}
                                                    ${pages_cat_data.map(page => `
                                                    <option value="${page.url}"  >${page.title}</option>
                                                `).join('')}
                                                    </select>

                                                </div>
                                                <div class="col pr-0">
                                                    <input type="text" class="form-control input-style " name="title" id="tier_three_title_${uniqueKey}"
                                                        placeholder="title here">
                                                </div>
                                                <div class="col pr-0"><input type="text"
                                                        class="form-control input-style" name="url" id="tier_three_url_${uniqueKey}"
                                                        placeholder="url here.."></div>
                                                <div class="col-3" style="padding-top:5px">
                                                    <div
                                                        class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                                        <input type="checkbox" name="new_window"
                                                            class="custom-control-input" value="1"
                                                            id="tier_three_new_window_${uniqueKey}" checked="">
                                                        <label class="custom-control-label"
                                                            for="tier_three_new_window_${uniqueKey}">New Window ?</label>
                                                    </div>
                                                </div>

                                                <div class="col-auto position-relative">
                                                    <button type="button" id="${uniqueKey}"   class="btn delListPO delete_row"
                                                        title="Delete"><i
                                                            class="fa fa-trash-alt"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        `);

    $('#tblLoader').hide();
    $('.menu-row').show();
    $(".sortable").sortable();
    $(".formselect").select2();
}
$(document).on('click', '.delete_row', function () {
    var id = $(this).attr('id');
    var thisRef = $(this);
    thisRef.closest(`.delete_row_${id}`).remove();

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
$(document).on('click', '.save_right_web_menu', function () {

    if ($(".menu-row").find(".singleMenu").length <= 0) {
        showMessage('red', 'Please Add Atleast One Web Menu')
        return;
    }
    var menu_items = [];
    $('.menu-row .singleMenu').each(function () {
        var id                  = $(this).attr('id');
        var signleMenu          = $(this);
        var title_tier_one      = signleMenu.find(`#tier_one_title_${id}`);
        var second_tier         = [];
        signleMenu.find('.newSecondTierPlace').find('.secondTierIterate').each(function () {
            console.log("run")
            third_tier      = [];
            var title       = $(this).find('input[name="title"]');
            var url         = $(this).find('input[name="url"]');
            var new_window  = $(this).find('input[name="new_window"]');
            if (title && url && title.val() && url.val()) {
                second_tier.push({
                    'url': url.val(),
                    'title': title.val(),
                    'new_window': new_window.val(),
                    'sub_SubMenu': third_tier
                });
            }
        });

        if (title_tier_one && title_tier_one.val()) {
            menu_items.push({
                'id': id,
                'title': title_tier_one.val(),
                'sub_menu': second_tier,
            });
        }
    });
    if (menu_items.length == 0) {
        $('#notifDiv').fadeIn();
        $('#notifDiv').css('background', 'red');
        $('#notifDiv').text('Please add atleast one Menu Item');
        setTimeout(() => {
            $('#notifDiv').fadeOut();
        }, 3000);
        return;
    }
    else {
        var CurrentRef = $(this);
        CurrentRef.attr('disabled', 'disabled');
        CurrentRef.text('Processing...');
        url = "/admin/save-right-menu-list";
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: url,
            data: {
                menu_items: menu_items,
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            cache: false,
            success: function (response) {
                CurrentRef.prop('disabled', false).text('Save');
                if (response.status === 'success') {
                    showMessage('green', 'Menus Saved Successfully');
                    location.reload();
                } else if (response.status === 'duplicate') {
                    showMessage('red', response.msg);
                    return;
                } else {
                    showMessage('red', 'Not Added At this moment');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                showMessage('red', 'Unable to save try again later');
                CurrentRef.prop('disabled', false).text('Save');
            }
        });

    }
});
