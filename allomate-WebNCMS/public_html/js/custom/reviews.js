let deleteRef = "";
let all_reviews_records = [];

function all_reviews_list() {
    $(".loader").show();
    $(".all_reviews").empty();
    $.ajax({
        type: "GET",
        url: "/admin/get-all-reviews-list",
        success: function (response) {
            $(".all_reviews").append(`
                <table class="table table-hover dt-responsive nowrap ReviewsListTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Author Name</th>
                            <th>Review Type</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            `);
            $(".ReviewsListTable tbody").empty();
            all_reviews_records = response.records;
            response.records.forEach((element, key) => {
                $(".ReviewsListTable tbody").append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element["author_name"]}</td>
                        <td>${
                            element["review_type"] == 1 ? "General" : "NA"
                        }</td>
                        <td>${element["rating"]}</td>
                        <td>${
                            element["status"] == 1 ? "Published" : "Pending"
                        }</td>
                        <td>
                            <button id="${
                                element["id"]
                            }" class="btn btn-default btn-line add-review" data-author-name="${
                    element.author_name
                }" data-review-content="${
                    element.review_content
                }" data-review-type="${element.review_type}" data-rating="${
                    element.rating
                }" data-author-description="${
                    element.author_description
                }">Edit</button>
                            <button id="${
                                element["id"]
                            }" class="btn btn-default status_change_review" data-value="${
                    element.status
                }">${element.status == 1 ? "UnPublish" : "Publish"}</button>
                        </td>
                    </tr>`);
            });
            $(".ReviewsListTable").fadeIn();
            $(".ReviewsListTable").DataTable();
            $(".loader").hide();
        },
    });
}
$(document).on("click", ".add-review", function () {
    $(".author_name").val("");
    $(".review_id").val("");
    $(".rating").val("");
    $(".author_description").val("");
    $(".review_content").val("");
    $(".review_type").val("").trigger("change");
    var review_id = $(this).attr("id");
    var review_type = $(this).attr("data-review-type");
    var review_content = $(this).attr("data-review-content");
    var author_name = $(this).attr("data-author-name");
    var author_description = $(this).attr("data-author-description");
    var rating = $(this).attr("data-rating");
    if (review_id != undefined && review_id) {
        $(".review_id").val(review_id);
        $(".review_type").val(review_type).trigger("change");
        $(".review_content").val(review_content);
        $(".author_name").val(author_name);
        $(".author_description").val(author_description);
        $(".rating").val(rating);
    }
    openSidebar();
});

$(document).on("click", ".saveAssignment", function () {
    let dirty = false;
    $(".required").each(function () {
        if (!$(this).val() || $(this).val() == 0) {
            dirty = true;
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
    CurrentRef.text("Saving...");
    $("#AssignmentForm").ajaxSubmit({
        type: "POST",
        url: "/admin/save-review-assignment",
        cache: false,
        success: function (response) {
            CurrentRef.attr("disabled", false);
            CurrentRef.text("Save");
            if (response.status == "success") {
                $("#AssignmentForm")[0].reset();
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "green");
                $("#notifDiv").text("Review Added successfully");
                all_reviews_list();
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
                closeSidebar();
            } else {
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "red");
                $("#notifDiv").text(response.msg);
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            }
        },
        error: function (e) {
            CurrentRef.attr("disabled", false);
            CurrentRef.text("Save");
            $("#notifDiv").fadeIn();
            $("#notifDiv").css("background", "red");
            $("#notifDiv").text("Not added at this moment");
            setTimeout(() => {
                $("#notifDiv").fadeOut();
            }, 3000);
        },
    });
});
$(document).on("click", ".status_change_review", function () {
    var review_status = "";
    var id = $(this).attr("id");
    var current_status = $(this).attr("data-value");
    if (current_status == 1) {
        review_status = 0;
    } else {
        review_status = 1;
    }
    var CurrentRef = $(this);
    CurrentRef.attr("disabled", "disabled");
    $.ajax({
        type: "POST",
        url: `/admin/review-status-change`,
        data: {
            _token: $('meta[name="csrf_token"]').attr("content"),
            id: id,
            review_status: review_status,
        },
        success: function (response) {
            CurrentRef.attr("disabled", false);
            if (response.status == "success") {
                $("#notifDiv").fadeIn();
                $("#notifDiv").css("background", "green");
                $("#notifDiv").text("Review Status Change");
                all_reviews_list();
                setTimeout(() => {
                    $("#notifDiv").fadeOut();
                }, 3000);
            }
        },
    });
});
$(document).on("input", ".restrict_number", function () {
    var rating = $(this).val();
    if (parseFloat(rating) > 5) {
        $(this).val(5);
    } else {
        $(this).val(rating);
    }
});
all_reviews_list();
