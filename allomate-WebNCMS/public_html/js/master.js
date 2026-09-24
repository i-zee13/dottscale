
let subNavItems = [];
let parentModRef = null;
let editSubNavItem = null;
var allActivities = [];
var filtersArray = ["900", "901", "902", "903", "904", "905", "906", "907", "908", "909", "910"];
var selected_customer_id = 0;
var filterStartDate = '';
var filterEndDate = '';
var filterDate = 0;
var searchQuery = null;
let allTasksCreated = [];
let files_url = '';
let all_files = [];
var segments = location.href.split('/');

$(document).ready(function () {

    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        defaultViewDate: { year: new Date().getFullYear(), month: new Date().getMonth(), day: new Date().getDate() }
    }).on('changeDate', function (e) {
        console.log('Change');
        $(this).datepicker('hide');
        $(this).blur();
    });
    var currentDate = new Date();
    $(".datepicker").datepicker("setDate", currentDate);
    if (segments.length > 0) {
        var lastSegment = segments[segments.length - 1];
        segments[segments.length - 1] = lastSegment.replace('#', '');
    }
    console.log(segments);
    $(document).on('input', '.only_decimal_numerics', function () {
        this.value = this.value.replace(/[^0-9.:]|(\.[0-9]{3,})/g, '');
    })

    $('.dropify').dropify();



    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');


    var action = segments[4];

    $(document).on('click', '.dropify-clear', function () {
        var old_input_name = $(this).parent().children('input').attr('data-old_input');
        $('input[name="' + old_input_name + '"]').val('');
    });
    $(document).on('click', '.btn-view', function () {
        var current = $(this);
        var action = $(this).attr('data-action');
        current.text('Processing');
        current.attr('disabled', true);

        var id = $(this).attr('data-identity');
        $.ajax({
            url: '/notification-read-status/' + id,
            success: function (response) {
                if (response.status == "success") {
                    if (action == 'read') {
                        current.remove();
                        var notification_count = $('.new_notification').text();
                        notification_count = parseInt(notification_count);
                        if (notification_count > 0) {
                            notification_count = notification_count - 1;
                            $('.new_notification').text(notification_count);
                        }
                    } else {
                        var page_load = current.attr('href');
                        window.location = `${page_load}`;
                    }

                } else {
                    current.text('Mark as Read');
                    current.attr('disabled', false);
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Not marked read at this moment');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        });
    });



    // for text type inputs which are required to accept only numeric values
    $(document).on('keypress', '.only_numerics', function (e) {
        // this.value = this.value.replace(/[^0-9]/gi,'');
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    if ($(".phonecell")) {
        // $(".phonecell").inputmask("+1 (999) 999-9999");
    }
    $(document).on('keyup', '.postal_code_input', function (e) {
        var txtVal = $(this).val();
        txtVal = txtVal.replace(/ /g, '');
        $('.postal_code_input').val(txtVal);
        var txtVal = $(this).val();
        if (txtVal.length > 6) {
            $('.postal_code_input').val(txtVal.substring(0, 6))
        }
    });
    // for text type inputs which are required to accept only aplphabetic values
    $(document).on('input', '.only_alphabets', function () {
        this.value = this.value.replace(/[^a-z\s.]/gi, '');
    })

    $(document).on('click', '.modalShowTaskCentralized', function () {
        $('.customerSelectDD .select2').attr('style', 'width: 208px !important');
        $('.assignToDD .select2').css('width', '100%');
        $('#taskCentralizedModal').addClass('modalShow');
    });


    $(document).on('input', '.only_double', function () {
        this.value = this.value.replace(/[^0-9.:]|(\.[0-9]{15,})/g, '');

    })



    $(document).on('input', '.percentage_input', function () {
        this.value = this.value.replace(/[^0-9.:]|(\.[0-9]{15,})/g, '');
        if (this.value >= 100) {
            showMessage('red', `Can't be greater than 100%`);
            $(this).val('');
            return;
        }
    })
    $(document).on('input', '#commentOnTask', function () {
        ajaxer('/TypingStatusOnTask', 'POST', {
            _token: $('[name="csrf_token"]').attr('content'),
            'task_id': activeTaskForComments.id,
            'comment': $(this).val()
        })
    });


    navItemsScript();
    actionListeners();



    $('#productlist01').click(function () {
        if ($('#product-cl-sec').hasClass('active')) {
            closeSidebar()
        } else {
            openSidebar()
        }
    });

    $("#example").DataTable();

    $(".table-PL").dataTable({
        searching: false,
        paging: false,
        info: false
    });

    $("#pl-close, .close-sidebar, .overlay, .pl-close").on("click", function () {
        closeSidebar();
    });

    $(document).on("click", ".closeProductAddSidebar", function () {
        closeSidebar();
    });

    $(document).on("click", "#SN-close, .overlay-blure", function (e) {
        // allClasses = e.target.classList;
        // if(allClasses[2] && allClasses[2] == 'snCloseBtn'){

        // }
        // alert($(window).width());
        closeSubNav();
    });

    $(document).on("click", "#SN-close, .overlay-for-sidebar", function () {
        closeSidebar();
    });

    $(document).on("click", ".openSubMenu", function () {
        let name = $(this).attr("attr-name");
        let item = subNavItems.find(
            x => x.parent.toLowerCase() == name.toLowerCase()
        );
        $("#subNavItems").empty();
        $("#subNavHeader").html(item.parent);
        item.child.forEach(element => {
            $("#subNavItems").append(element);
        });
        closeSidebar();
        openSubNav();
    });

    $(document).on('click', '.open_search_modal', function () {
        $('.SearchList').empty();
        $('#tblLoader_search').hide();
        $('.search_whole_site').val('');
    });

    $(document).on('input', '.search_whole_site', function () {
        if ($(this).val().length > 2) {
            $('.SearchList').empty();
            $('#tblLoader_search').show();
            fetchSiteSearchReasult($(this).val());
        } else if ($(this).val() == '') {
            $('.SearchList').empty();
            $('#tblLoader_search').hide();
        }
    });

    $(document).on('click', '.filter_checkBox', function () {
        //900 = order
        //901 = product
        //902 = customer
        //903 = supplier
        //904 = shipper
        //905 = task
        if ($(this).prop('checked')) {
            filtersArray.push($(this).attr('id'));
        } else {
            if (filtersArray.indexOf($(this).attr('id')) > -1) {
                filtersArray.splice(filtersArray.indexOf($(this).attr('id')), 1);
            }
        }
        $('.filters_count').text(`(${filtersArray.length}/11)`)
        renderDataAfterFilters(selected_customer_id, filtersArray, searchQuery);

    });

    $(document).on('change', '#emp_for_activity', function () {
        selected_customer_id = $(this).val();
        $('.all_activities').empty();
        renderDataAfterFilters(selected_customer_id, filtersArray, searchQuery);
    });

    $(document).on('change', '.date_filter', function () {
        filterDate = $(this).val();
        if ($(this).val() == 5) {
            $('.custom_filter_div').show();
        } else {
            $('.custom_filter_div').hide();
            fetchActivities(filtersArray, filterDate, filterStartDate, filterEndDate, searchQuery);
        }
    });

    $(document).on('change', '.filterStartDate', function () {
        filterStartDate = $(this).val();
        if (filterEndDate) {
            fetchActivities(filtersArray, filterDate, filterStartDate, filterEndDate, searchQuery);
        }
    });

    $(document).on('change', '.filterEndDate', function () {
        filterEndDate = $(this).val()
        if (filterStartDate) {
            fetchActivities(filtersArray, filterDate, filterStartDate, filterEndDate, searchQuery);
        }
    });

    $(document).on('input', '.searchActivities', function () {
        if ($(this).val() == '') {
            searchQuery = null;
        } else {
            searchQuery = $(this).val();
        }
        renderDataAfterFilters(selected_customer_id, filtersArray, searchQuery);
    });

});
// $(window).on("load", function () {
//     $("._act-TL .body").mCustomScrollbar({
//         theme: "dark-2"
//     });
//     // $("._activitycards, .left_Info").mCustomScrollbar({
//     //     theme: "dark-2"
//     // });
//     $(".OrderDL .body").mCustomScrollbar({
//         theme: "dark-2"
//     });
//     // $(".TaskCommentSec").mCustomScrollbar({
//     //     theme: "dark-2"
//     // });
// });

$(".form-control").on("focus blur", function (e) {
    $(this)
        .parent()
        .toggleClass(
            "focused",
            e.type === "focus" || this.value.length > 0
        );
}).trigger("blur");
$(".formselect").select2();
$(".sd-type").select2({
    createTag: function (params) {
        var term = $.trim(params.term);
        if (term === "") {
            return null;
        }
        return {
            id: term,
            text: term,
            newTag: true // add additional parameters
        };
    }
});

// (function ($) {
//     $(window).on("load", function () {
//         $("._act-TL .body").mCustomScrollbar({
//             theme: "dark-2"
//         });
//         $("._activityEmp-timeline, .TaskAtachList, .TaskAddDoc").mCustomScrollbar({
//             theme: "dark-2"
//         });
//     });
// })(jQuery);


function deleteOnConfirmation(localRef, parentRef, url, module) {
    localRef.attr('disabled', true)
    localRef.text('Deleting')
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            _token: $('[name="csrf_token"]').attr('content'),
            id: parentRef.attr('c-id')
        },
        success: function (response) {
            $('.completionCheckMark').show();
            $('.actionBtnsDiv').hide();
            if (module == 'correspondence') {
                parentRef.parent().parent().parent().parent().parent().parent().parent().remove();
                $('#deleteCorrespondenceMsg').text('Correspondence has been deleted');
            }
            localRef.removeAttr('disabled')
            localRef.text('Yes')
            setTimeout(() => {
                $('.closeConfirmationModal').click();
            }, 1500);
        }.bind(parentRef)
    })
}

function renderPage() {

    $('#contentContainerDiv').removeClass('blur-div');
}

function actionListeners() {
    $(document).on("click", ".deleteSubNavItem", function () {
        if (!window.confirm("Are you sure you want to delete this item?")) return
        let itemId = $(this).attr('item-id')
        $(this).parent().remove();
        $.ajax({
            type: 'POST',
            url: '/admin/DeleteSubNavItem',
            data: {
                _token: $('input[name="_token"]').val(),
                id: itemId
            },
            success: function () {
                location.reload()
            }
        })
    });

    $(document).on("click", ".savePriorityList", function () {

        let priorityList = [];
        let priority = 1;
        $(this).text('Saving..')
        $(this).parent().parent().find('li').not('.addNewSubMob').each(function () {
            priorityList.push({
                id: $(this).attr('item-id'),
                priority: priority++
            });
        });
        $.ajax({
            type: 'POST',
            url: '/admin/UpdateSubModPriority',
            data: {
                _token: $('input[name="_token"]').val(),
                data: priorityList
            },
            success: function (response) {
                location.reload();
            }
        })
    });

    $(document).on("keydown", ".parentModEditor", function (e) {
        if (e.keyCode == 13) {
            $(this).attr('disabled', true);
            $.ajax({
                type: 'POST',
                url: '/admin/UpdateParentMod',
                data: {
                    _token: $('input[name="_token"]').val(),
                    old_parent_mod: $(this).attr('module-name'),
                    parentMod: $(this).val()
                },
                success: function (response) {
                    location.reload();
                }
            })
        }
    });

    $(document).on("click", ".deleteParentMod", function () {
        let itemFnd = allControllersData.find(x => x.parent_module == $(this).attr('parent-module')).parent_module
        if (!window.confirm('This action will delete this item permanently'))
            return;

        $(this).text('Deleting');
        $.ajax({
            type: 'POST',
            url: '/admin/DeleteParentMod',
            data: {
                _token: $('input[name="_token"]').val(),
                parent_module: itemFnd
            },
            success: function () {
                location.reload();
            }
        })
    });


    $(document).on("click", ".parentMod", function () {
        let itemFnd = allControllersData.find(x => x.parent_module == $(this).text())

        $(".openSubModModal").click();
        $('#exampleModalLabel').text('Parent Module Settings');
        $('#newSubModForm').hide();
        $('#newParentModForm').show();

        $('[name="parent_op"]').val('update');
        $('#newParentModForm').append(`<input name="parent_module_name_update" value="${itemFnd.parent_module}" hidden />`);
        $('[name="parent_module_name_update"]').val(itemFnd.parent_module);
        $('[name="parent_module_name"]').val(itemFnd.parent_module);
        $('[name="show_in_sidebar"]').val(itemFnd.show_in_sidebar);
        $('[name="parent_module_for"]').val(itemFnd.parent_module_for);
        setTimeout(() => {
            $('[name="parent_module_name"]').focus();
        }, 500);

        $('#saveParentMod').show();
        $('#saveNewSubMod').hide();
    });

    $(document).on("click", "#saveNewSubMod", function () {
        let updateItemId = parentModRef.attr('item-id');
        let parentMod = parentModRef
            .parent()
            .parent()
            .parent()
            .find("span")
            .text();

        let currentPriority = 1;

        let allItemsWithoutAddLi = parentModRef
            .parent()
            .find("li")
            .not(".addNewSubMob");

        allItemsWithoutAddLi.each(function () {
            if (updateItemId && parentModRef.text() == $(this).text()) {
                currentPriority = $(this).index() + 1;
            }
            if (!updateItemId)
                currentPriority++;
        });

        if (updateItemId)
            parentMod = parentModRef.attr('parent-module-name')

        $(this).text("Saving");
        $(this).attr("disabled", true);

        $("#newSubModForm").ajaxSubmit({
            type: "POST",
            url: "/admin/SaveSubMod",
            data: {
                priority: currentPriority,
                item_id: updateItemId,
                parent: parentMod
            },
            success: function (response) {
                if (response.code == 200) {
                    $(".close").click();
                }

                location.reload();

                $(this).text("Save");
                $(this).removeAttr("disabled");
            }.bind($(this))
        });
    });

    $(document).on("click", "#saveParentMod", function () {
        let updateItemId = null;
        let currentPriority = $('.parentMod').length + 1;

        $(this).text("Saving");
        $(this).attr("disabled", true);

        $("#newParentModForm").ajaxSubmit({
            type: "POST",
            url: "/admin/SaveParentMod",
            data: {
                priority: currentPriority
            },
            success: function (response) {
                if (response.code == 200) {
                    $(".close").click();
                }
                location.reload();


                $(this).text("Save");
                $(this).removeAttr("disabled");
            }.bind($(this))
        });
    });

    $(document).on("click", ".addNewSubMob", function (e) {
        if (e.target.classList.contains("savePriorityList") || e.target.classList.contains("deleteParentMod"))
            return;
        parentModRef = $(this);
        $('#saveParentMod').hide();
        $('#saveNewSubMod').show();
        $(".openSubModModal").click();
        $('#newSubModForm').show();
        $('#newParentModForm').hide();
        $(".newSubModForm input").val("");
    });

    $(document).on("click", ".editSubNavItem", function (e) {
        parentModRef = $(this);
        $('#saveParentMod').hide();
        $('#saveNewSubMod').show();
        editSubNavItem = allControllersData.find(x => x.id == $(this).attr('item-id'));
        $(".openSubModModal").click();
        $('#newSubModForm').show();
        $('#newParentModForm').hide();
        $("[name='module_name']").val(editSubNavItem.sub_module ? editSubNavItem.sub_module : editSubNavItem.made_up_name);
        $("[name='route']").val(editSubNavItem.controller);
        $("[name='made_up_name']").val(editSubNavItem.made_up_name);
        $("[name='show_in_sub_menu']").val(editSubNavItem.show_in_sub_menu);
        $("[name='sub_module_for']").val(editSubNavItem.sub_module_for);

        setTimeout(() => {
            $("[name='module_name']").focus();
            $("[name='route']").focus();
            $("[name='made_up_name']").focus();
        }, 500);
    });

    $(document).on("click", ".addNewParentMod", function (e) {
        $(".openSubModModal").click();
        $('#exampleModalLabel').text('Parent Module Settings');
        $('#newSubModForm').hide();
        $('#newParentModForm').show();

        $('[name="parent_op"]').val('add');

        $('[name="parent_module_name_update"]').remove();

        $(".newParentModForm input").val("");
        $('#saveParentMod').show();
        $('#saveNewSubMod').hide();
    });

    $(document).on("click", ".saveParentPriorityList", function (e) {
        let priorityList = [];
        let priority = 1;
        $('.parentMod').each(function () {
            priorityList.push({
                module: $(this).attr('value'),
                priority: priority++
            });
        });
        $(this).text('Saving..')
        $.ajax({
            type: 'POST',
            url: '/admin/UpdateParentModPriority',
            data: {
                _token: $('input[name="_token"]').val(),
                data: priorityList
            },
            success: function (response) {
                location.reload();
            }
        })
    });

    $('#menuClose, .overlay-blure').on('click', function () {
        $('#sidebarblue').removeClass('menuShow');
        $('#content-wrapper').removeClass('blur-div');
        $('body').removeClass('no-scroll')
    });

    $('#modalShow').on('click', function () {
        $('#sidebarblue').addClass('menuShow');
        $('#content-wrapper').addClass('blur-div');
        $('body').addClass('no-scroll')
    });
}

function navItemsScript() {
    const parentModules = [
        ...new Set(
            allControllersData
                .filter(x => x.show_in_sidebar == 1)
                .map(item => item.parent_module)
        )
    ];
    currentPageRight = false;
    let childModules = null;
    $("#parentModulesUl").empty();
    subNavItems.push({
        parent: "search",
        child: []
    });

    subNavItems.push({
        parent: "Create New",
        child: [
            '<li> <a href="/client-create"><img src="/images/customer-icon.svg" alt="" />Client</a> </li>'
        ]
    });

    // $("#parentModulesUl").append(
    //     `<li> <a href="/dashboard"><img src="/images/dashboard-icon.svg" alt="" /> Dashboard</a> </li><hr>`
    // );

    console.log(parentModules);
    parentModules.forEach((element, index) => {
        var access_found = true;
        let childMods = {
            parent: "",
            child: []
        };

        childModules = allControllersData.filter(
            x => x.parent_module == element
        );

        if (childModules.length)
            childModules.sort(
                (a, b) => a.sub_module_priority - b.sub_module_priority
            );

        let anyChildRight = false;
        childModules.forEach(child => {
            if (rightsGiven.includes('admin/' + child.controller) ) {
                anyChildRight = true;
                if(child.show_in_sub_menu){
                    childMods.child.push(
                        `<li> <a href="/admin/${child.controller
                        }">
                        <img src="/menuicon/${child.sub_menu_icon}" alt="" />
                        ${child.sub_module ? child.sub_module : child.made_up_name
                        }</a> </li>`
                    );
                }
            }
        });

        if (!anyChildRight) return;
        if (
            rightsGiven.includes('admin/' + segments[4]) ||
            segments[3] + '/' + currentSegment == "admin/index" ||
            currentSegment == "/"
        ) {
            currentPageRight = true;
        }

        childMods.parent = element;
        subNavItems.push(childMods);

        if (element !== "Dashboard")
            $("#parentModulesUl").append(
                `<li> <a attr-name="${element}" class="openSubMenu"><img src="/menuicon/${childModules[0].logo}" alt="" /> ${element}</a> </li>`
            );
    });

    if (currentPageRight) {
        renderPage();
    } else {
        $("#parentModulesUl").empty();
        $(".close").remove();
        $(".modal-title").text("403 Forbidden");
        $("#wrapper").addClass("blur-div");
        $(".modal").css("pointer-events", "none");
        $(".modal-header").css("justify-content", "center");
        $("#assignmendModalContent").html(
            `<div style="text-align: center">You are not authorized to view this page. Please click here to go to <a href="/home">home</a></div>`
        );
        $(".notAllowedError").click();
        return;
    }
}

function openSidebar(element = "#product-cl-sec") {
    $(element).addClass("active");
    $(".overlay").addClass("active");
    $(".collapse.in").toggleClass("in");
    $("a[aria-expanded=true]").attr("aria-expanded", "false");
    $("body").toggleClass("no-scroll");
    $("#contentContainerDiv").addClass("blur-div");
    $(".sticky-footer").addClass("blur-div");
    $(".overlay-for-sidebar").css("display", "block");
}

function closeSidebar() {
    $(".customer_form_div").removeClass("active");
    $(".poc_form_div").removeClass("active");
    $("#product-cl-sec").removeClass("active");
    $("#product-add").removeClass("active");
    $("#performaPreferences").removeClass("active");
    $(".overlay").removeClass("active");

    $("#contentContainerDiv").removeClass("blur-div");
    $(".sticky-footer").removeClass("blur-div");
    $(".overlay-for-sidebar").css("display", "none");
    $("body").removeClass("no-scroll");
}

function openSubNav() {
    $("#_subNav-id").addClass("active");
    $("#content-wrapper").addClass("blur-div");
    $("body").addClass("no-scroll");
}

function closeSubNav() {
    $("#_subNav-id").removeClass("active");
    $("#content-wrapper").removeClass("blur-div");
    $("body").removeClass("no-scroll");
}

function fetchSiteSearchReasult(str) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'GET',
            url: '/GetSiteSearchResult/' + str,
            success: function (response) {
                $('.SearchList').empty();
                $('#tblLoader_search').hide();
                var response = JSON.parse(response);
                var counter = 0;
                $.map(response.data, function (v, i) {
                    if (v.length > 0) {
                        $('.SearchList').append(`<ul id="${counter}"><h3>${i}</h3></ul>`);
                        v.map(function (x) {
                            $(`#${counter}`).append(`<li> <a href="/client-view/${x.id}"><img src="/images/access-right-icon.svg" alt="">  ${x.first_name ? x.first_name : ''} ${x.middle_name ? x.middle_name : ''} ${x.last_name ? x.last_name : ''} </a></li>`);
                        });
                    }
                    counter++;
                });
            }
        });
    })
}

function ajaxer(url, type, payload) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: type,
            url: url,
            data: payload,
            success: function (response) {
                resolve(response);
            }
        });
    });
}

function formatUnicorn(str) {
    var str = str;
    if (arguments.length) {
        var t = typeof arguments[0];
        var key;
        var args = ("string" === t || "number" === t) ?
            Array.prototype.slice.call(arguments) :
            arguments[0];

        for (key in args) {
            str = str.replace(new RegExp("\\{" + key + "\\}", "gi"), args[key]);
        }
    }

    return str;
}

var messages = {
    "orders": {
        "created_by_heading": "<span class='blue-text'>Follow Up:</span> New Sales Order",
        "updated_by_heading": "<span class='blue-text'>Follow Up:</span> Sales Order Update",
        "completed_by_heading": "<span class='blue-text'>Follow Up:</span> Sales Order Complete",
        "processed_by_heading": "<span class='blue-text'>Follow Up:</span> Sales Order Dispatch",
        "created_by": "{created_by} has created a New Sales Order for {customer_name} Worth {currency} {total_amount} Order # <a href='/OrderManagement'>{id}</a>",
        "updated_by": "{updated_by} has updated Sales Order # <a href='/OrderManagement'>{id}</a> for {customer_name} worth {currency} {total_amount}",
        "completed_by": "{completed_by} has completed the Sales Order # <a href='/OrderManagement'>{id}</a> for {customer_name} worth {currency} {total_amount}",
        "processed_by": "{processed_by} has created a full dispatch for Sales Order # <a href='/OrderManagement'>{id}</a> for {customer_name} worth {currency} {total_amount}"
    },
    "items": {
        "created_by_heading": "<span class='blue-text'>Follow Up:</span> New Variant",
        "updated_by_heading": "<span class='blue-text'>Follow Up:</span> Update Variant",
        "created_by": "{created_by} has created a new Item <a href='/ProductItems/{product_sku}'>{name}</a> for {product_name}",
        "updated_by": "{updated_by} has updated Item <a href='/ProductItems/{product_sku}'>{name}</a> for {product_name}",
    },
    "products": {
        "created_by_heading": "<span class='blue-text'>Follow Up:</span> New Product",
        "updated_by_heading": "<span class='blue-text'>Follow Up:</span> Update Product",
        "created_by": "{created_at} has created a new Product<a href='/BrandProducts/{brand_id}'>{name}",
        "updated_by": "{updated_by} has Updated Product <a href='/BrandProducts/{brand_id}'>{name}",
    }
};

function fetchActivities(filteredArray, date, startDate, EndDate, searchQuery = null) {
    $('.all_activities').empty();
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'GET',
            url: '/GetActivities',
            data: {
                'date': date,
                'start_date': startDate,
                'end_date': EndDate
            },
            success: function (response) {
                $('.SearchList').empty();
                $('#tblLoader').hide();
                var response = JSON.parse(response);
                allActivities = response;

                if (selected_customer_id != 0) {
                    renderDataAfterFilters(selected_customer_id, filteredArray)
                } else {
                    if (filteredArray.includes("900")) {
                        $.map(response.orders, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Sales Order</h5>
                                        <p class="_description">${v.created_by} has created a New Sales Order for ${v.customer_name} Worth ${v.currency}  ${v.total_amount} Order # <a style="color:#040725;" href="/OrderManagement">${v.id}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Sales Order Update</h5>
                                        <p class="_description">${v.updated_by} has updated Sales Order # <a style="color:#040725;" href="/OrderManagement">${v.id}</a> for ${v.customer_name} worth ${v.currency} ${v.total_amount}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.completed_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.completed_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="processed-emp-name">${v.completed_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Sales Order Complete</h5>
                                        <p class="_description">${v.completed_by} has completed the Sales Order # <a style="color:#040725;" href="/OrderManagement">${v.id}</a> for ${v.customer_name} worth ${v.currency} ${v.total_amount}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.processed_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.processed_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="completed-emp-name">${v.processed_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Sales Order Dispatch</h5>
                                        <p class="_description">${v.processed_by} has created a full dispatch for Sales Order # <a style="color:#040725;" href="/OrderManagement">${v.id}</a> for ${v.customer_name} worth ${v.currency} ${v.total_amount}</p>
                                    </div>
                                </div>
                                </li>`);
                            }

                        });
                    }

                    if (filteredArray.includes("906")) {
                        $.map(response.items, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Variant</h5>
                                        <p class="_description">${v.created_by} has created a new Item <a style="color:#040725;" href="/ProductItems/${v.product_sku}">${v.name}</a> for ${v.product_name}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Variant</h5>
                                        <p class="_description">${v.updated_by} has updated Item <a style="color:#040725;" href="/ProductItems/${v.product_sku}">${v.name}</a> for ${v.product_name}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("901")) {
                        $.map(response.products, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Product</h5>
                                        <p class="_description">${v.created_at} has created a new Product <a style="color:#040725;" href="/BrandProducts/${v.brand_id}">${v.name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Product Update</h5>
                                        <p class="_description">${v.updated_by} has Updated Product <a style="color:#040725;" href="/BrandProducts/${v.brand_id}">${v.name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("902")) {
                        $.map(response.customers, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Customer</h5>
                                        <p class="_description">${v.created_by} has created a new customer <a style="color:#040725;" href="/Correspondence/create/${v.id}">${v.company_name}</a> from ${v.country}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Customer</h5>
                                        <p class="_description">${v.updated_by} has updated customer details <a style="color:#040725;" href="/Correspondence/create/${v.id}">${v.company_name}</a> from ${v.country}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("907")) {
                        $.map(response.pocs, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New POC</h5>
                                        <p class="_description">${v.created_by} has added a new POC ${v.first_name} for <a style="color:#040725;" href="/Correspondence/create/${v.customer_id}">${v.customer_name}</a> from ${v.cust_country}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update POC</h5>
                                        <p class="_description">${v.updated_by} has updated POC details of ${v.first_name} for <a style="color:#040725;" href="/Correspondence/create/${v.customer_id}">${v.customer_name}</a> from ${v.cust_country}</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("903")) {
                        $.map(response.suppliers, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Supplier</h5>
                                        <p class="_description">${v.created_by} has created a new supplier <a style="color:#040725;" href="/Suppliers">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Supplier</h5>
                                        <p class="_description">${v.updated_by} has updated supplier details <a style="color:#040725;" href="/Suppliers">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("908")) {
                        $.map(response.forwarders, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Forwarder</h5>
                                        <p class="_description">${v.created_by} has created a new Forwarding Company <a style="color:#040725;" href="/forwarder">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Forwarder</h5>
                                        <p class="_description">${v.updated_by} has updated Forwarding <a style="color:#040725;" href="/forwarder">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("904")) {
                        $.map(response.shippers, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Shipping Company</h5>
                                        <p class="_description">${v.created_by} has created a new Shipping Company <a style="color:#040725;" href="/Shipping">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Shipping Company</h5>
                                        <p class="_description">${v.updated_by} has updated Shipping Company <a style="color:#040725;" href="/Shipping">${v.company_name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("905")) {
                        $.map(response.tasks, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Task</h5>
                                        <p class="_description">${v.created_by} has created a new Task</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Task</h5>
                                        <p class="_description">${v.updated_by} has updated Task</p>
                                    </div>
                                </div>
                                </li>`);
                            }

                            if (v.completed_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.completed_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.completed_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Task Completed</h5>
                                        <p class="_description">${v.completed_by} has Completed a Task</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("909")) {
                        $.map(response.investors, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> New Employee</h5>
                                        <p class="_description">${v.created_by} has added a new Employee <a style="color:#040725;" href="/register">${v.name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Update Employee</h5>
                                        <p class="_description">${v.updated_by} has updated employee <a style="color:#040725;" href="/register">${v.name}</a></p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }

                    if (filteredArray.includes("910")) {
                        $.map(response.payments, function (v) {
                            if (v.created_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.created_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="emp-name">${v.created_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Payment Created</h5>
                                        <p class="_description">New Payment Created</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                            if (v.updated_by) {
                                $('.all_activities').append(`<li>
                                <div class="dateFollowUP">${v.updated_at}</div>
                                <div class="timeline-icon"><img src="/images/avatar.svg" alt=""></div>
                                <div class="timeline-info">
                                    <h4 class="update-emp-name">${v.updated_by}</h4>
                                    <div class="historyDiv">
                                        <h5><span class="blue-text">Follow Up:</span> Payment Updated</h5>
                                        <p class="_description"> Payment Updated</p>
                                    </div>
                                </div>
                                </li>`);
                            }
                        });
                    }
                }
                if (searchQuery) {
                    $('.dateFollowUP').mark(searchQuery);
                    $('.emp-name').mark(searchQuery);
                    $('.update-emp-name').mark(searchQuery);
                    $('._description').mark(searchQuery);
                    $('.processed-emp-name').mark(searchQuery);
                    $('.completed-emp-name').mark(searchQuery);
                }
            }
        });
    })
}



function titleCase(str) {
    var splitStr = str.toLowerCase().split(' ');
    for (var i = 0; i < splitStr.length; i++) {
        // You do not need to check if i is larger than splitStr length, as your for does that for you
        // Assign it back to the array
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }
    // Directly return the joined string
    return splitStr.join(' ');
}
function notification(type, message) {
    var bgColor = (type == 'error') ? 'red' : 'green';
    var el = $('#notifDiv');
    el.fadeIn();
    el.css('background', bgColor);
    el.text(message);
    setTimeout(() => {
        el.fadeOut();
    }, 3000);
}
function emailValidate(email) {
    var filter = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if (filter.test(email)) {
        return true;
    }
    else {
        return false;
    }
}
function showMessage(color, message) {
    $('#notifDiv').fadeIn();
    $('#notifDiv').css('background', color);
    $('#notifDiv').text(message);
    setTimeout(() => {
        $('#notifDiv').fadeOut();
    }, 3000);

}
