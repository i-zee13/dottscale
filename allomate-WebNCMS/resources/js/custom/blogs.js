let dateFormat = "yyyy-mm-dd";
let b_type = "";
let p_service = "";
let s_service = "";
let s_s_service = "";
let meta_array = [];
let all_blogs = [];

$(document).ready(function () {
    href = String(location.href).replace(/#/, "");
    var segments = href.split("/");
    action = segments[3];
    if (action == "blogs") {
        all_blogs = JSON.parse($("#all_blogs").val());
        dataList();
    } else if (action == "admin") {
        var editor = CKEDITOR.replace("ckeditor", {
            height: "500px",
            toolbar: "Classic",
            removePlugins: "blockquote,about",
            toolbarStartupExpanded: false,
            contentsCss: ["../css/menu.css?v=6.4"],
            format_tags: "p;h1;h2;h3;h4;h5;h6;pre;div",
        });
        CKFinder.setupCKEditor(editor);
        CKEDITOR.config.fontSize_defaultLabel = "12px";
        CKEDITOR.config.fontSize_defaultParagraph = "12px";
        CKEDITOR.config.fontSize =
            "12 Pixels/12px;Big/2.3em;30 Percent More/130%;Bigger/larger;Very Small/x-small";
    }
    if (segments[4] == "add-blog") {
        $(".dropify-clear").click();
    }
    b_type = $("#b_type").val();
    p_service = $("#p_service").val();
    $('select[name="blog_type"]').val(b_type).trigger("change");
    $('select[name="blog_category_id"]').val(p_service).trigger("change");
});

$(document).on("click", "#save-blog", function () {
    let dirty = false;
    let count = 1;
    var blog_details = CKEDITOR.instances["ckeditor"].getData();
    $(".blog-required").each(function () {
        if ((!$(this).val() && !$(this).val().trim()) || $(this).val() == 0) {
            dirty = true;
            if (count == 1) {
                $(this).focus();
            }
            count++;
            if ($(this).hasClass("formselect") || $(this).hasClass("sd-type")) {
                $(this)
                    .parent()
                    .find(".select2-container")
                    .css("border", "0px solid red");
            } else {
                $(this).css("border", "0px solid red");
            }
        }
    });
    if (
        !$(document)
            .find('input[name="after_header_image"]')
            .prop("files")[0] &&
        !$(document).find('input[name="hidden_after_header_image"]').val()
    ) {
        dirty = true;
    } else if (!blog_details) {
        dirty = true;
    }
    if (dirty) {
        $("#notifDiv").fadeIn();
        $("#notifDiv").css("background", "red");
        $("#notifDiv").text("Please provide all the required information (*)");
        setTimeout(() => {
            $("#notifDiv").fadeOut();
        }, 3000);
        return;
    }
    var CurrentRef = $(this);
    CurrentRef.attr("disabled", "disabled");
    CurrentRef.text("Processing...");

    $("#SaveBlogForm").ajaxSubmit({
        type: "POST",
        url: "/admin/save-blog",
        data: {
            blog_details: blog_details,
        },
        cache: false,
        success: function (response) {
            CurrentRef.attr("disabled", false);
            CurrentRef.text("Save");
            if (response.msg == "blog_added") {
                $("#SaveBlogForm")[0].reset();
                $(".cke_editable p").empty();
                $(".dropify-preview").css("display", "none");
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "green");
                $("#notifDiv").text("Blog Added");
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                    window.location = "/admin/blogs";
                }, 1000);
            } else if (response.msg == "blog_image_required") {
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "red");
                $("#notifDiv").text("Upload Blog Thumbnail Image");
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            } else if (response.msg == "cover_image_required") {
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "red");
                $("#notifDiv").text("Upload Blog Cover Image");
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            } else if (response.status == "duplicate") {
                $("#title").focus();
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "red");
                $("#notifDiv").text(response.msg);
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            } else {
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "red");
                $("#notifDiv").text("Not added at this moment");
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            }
        },
        error: function (e) {
            $("#notifDiv").fadeIn();
            $("#notifDiv").css("background", "red");
            $("#notifDiv").text("Not added at this moment");
            setTimeout(() => {
                $("#notifDiv").fadeOut();
            }, 3000);
            CurrentRef.attr("disabled", false);
            CurrentRef.text("Save");
        },
    });
});

$("#title").keyup(function () {
    var blog_title = $(this).val();
    $.ajax({
        url: `/admin/blog-slug/${blog_title}`,
        success: function (response) {
            $("#blog-slug").val(response.blog_slug);

        },
    });
});
// $('#secondary_services').change(function(){
//     $('#sub_secondary_services').empty();
//     var secondary_service_id = $(this).val();
//     $.ajax({
//         url     :   `/admin/get-sub-secondary-services-against-secondary/${secondary_service_id}`,
//         success :   function(response){
//             $("#sub_secondary_services").append(`<option value="0">Sub Secondary Services</option>`);
//             response.sub_sec_services.forEach(data => {
//                 $("#sub_secondary_services").append(`<option value="${data.id}" ${s_s_service == data.id ? 'selected' : ''}>${data.service_name}</option>`)
//             })

//         }
//     })
// })
function dataList(selected_service) {
    var key = 0;
    $("#productItem-list").empty();
    var page_limit_list = 2;
    // Sales Agents
    if (location.pathname == "/blogs") {
        var filtered_agent = all_blogs; // JSON.parse($('#all_blogs').val());
        var dynamic_search_val = $("#dynamic_search").val().toLowerCase();
        var dynamic_filter_val = selected_service;
        if (dynamic_filter_val) {
            filtered_agent = filtered_agent.filter(
                (x) => x.blog_category_id == dynamic_filter_val
            );
        }
        if (dynamic_search_val != "") {
            var filtered_agent = filtered_agent.filter(function (x) {
                return (
                    (x.primary_service
                        ? x.primary_service
                              .toLowerCase()
                              .includes(dynamic_search_val)
                        : "") ||
                    (x.title
                        ? x.title.toLowerCase().includes(dynamic_search_val)
                        : "") ||
                    (x.last_name
                        ? x.last_name.toLowerCase().includes(dynamic_search_val)
                        : "") ||
                    (x.email
                        ? x.email.toLowerCase().includes(dynamic_search_val)
                        : "")
                );
            });
            $(".count_customers").text(filtered_agent.length);
        }
        valuesListAgents = filtered_agent;
        var optionsListAgents = {
            page: page_limit_list,
            pagination: true,
            valueNames: [
                "image",
                "title",
                "blog_details",
                "slug",
                "id",
                "short_description",
                "date",
            ],
            item: function (valueNames) {
                if (key++ % 2 == 0) {
                    return `

                    <div class="row blog-card-list">
                        <div class="col-lg-6 col-md-12 mt-auto mb-auto">
                            <div class="blog-card">
                                <div class="blog-card-div">
                                    <span class="date-d">${
                                        valueNames.date
                                    }</span>
                                    <h1>${valueNames.title}</h1>
                                    <span class="cataegory-n"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="2" viewBox="0 0 16 1">
                                            <g id="Rectangle_1158" data-name="Rectangle 1158" fill="#0038ba" stroke="#0038ba" stroke-width="1">
                                                <rect width="22" height="2" stroke="none" />
                                                <rect x="0.5" y="0.5" width="15" fill="none" />
                                            </g>
                                        </svg>
                                        ${
                                            valueNames.primary_service
                                                ? valueNames.primary_service
                                                : "General"
                                        }
                                        </span>
                                    <p>${
                                        valueNames.short_description
                                            ? valueNames.short_description
                                            : "NA"
                                    }</p>
                                        <a href="/blogs/blog-details/${
                                            valueNames.slug
                                        }" class="btn-readmore">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 blog-th-img">
                            <img src="/storage/${valueNames.image}" alt="${
                        valueNames.slug
                    }">
                        </div>
                    </div> `;
                } else {
                    return `
                    <div class="row blog-card-list left-img-blog">
                    <div class="col-lg-6 col-md-12 blog-th-img">
                    <img src="/storage/${valueNames.image}" alt="${
                        valueNames.slug
                    }">
                </div>
                        <div class="col-lg-6 col-md-12 mt-auto mb-auto">
                            <div class="blog-card">
                                <div class="blog-card-div">
                                    <span class="date-d">${
                                        valueNames.date
                                    }</span>
                                    <h1>${valueNames.title}</h1>
                                    <span class="cataegory-n"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="2" viewBox="0 0 16 1">
                                            <g id="Rectangle_1158" data-name="Rectangle 1158" fill="#0038ba" stroke="#0038ba" stroke-width="1">
                                                <rect width="22" height="2" stroke="none" />
                                                <rect x="0.5" y="0.5" width="15" fill="none" />
                                            </g>
                                        </svg>
                                        ${
                                            valueNames.primary_service
                                                ? valueNames.primary_service
                                                : "General"
                                        }
                                        </span>
                                    <p>${
                                        valueNames.short_description
                                            ? valueNames.short_description
                                            : "NA"
                                    }</p>
                                        <a href="/blogs/blog-details/${
                                            valueNames.slug
                                        }" class="btn-readmore">Continue Reading</a>
                                </div>
                            </div>
                        </div>

                    </div> `;
                }
            },
        };
        var listTable = new List(
            "productList2",
            optionsListAgents,
            valuesListAgents
        );
    }
}
$(document).on("input", "#dynamic_search", function () {
    dataList();
});
$(document).on("click", ".service", function () {
    var selected_service = $(this).attr("data-value");
    $(".service").removeClass("active");
    $(this).addClass("active");
    dataList(selected_service);
});
