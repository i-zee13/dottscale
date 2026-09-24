var segments = location.href.split('/');
var faqs_array = [];
var all_records = [];
var all_db_faqs = [];
$(document).ready(function () {
    SubscribersListRecordGet();
});
function SubscribersListRecordGet() {
    $('.subscribers-records').empty();
    $('.loader').show();
    $.ajax({
        url: '/admin/subscriber-list-records',
        success: function (response) {
            all_records = response.records;
            $('.subscribers-records').append(`
                <table class="table table-hover dt-responsive nowrap SubscribeListTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Email</th>
                            <th>Subscribed At</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            `);
            $('.SubscribeListTable tbody').empty();
            all_records.forEach((element, key) => {
                $('.SubscribeListTable tbody').append(`
                    <tr>
                        <td>${key + 1}</td>
                        <td>${element['email']}</td>
                        <td>${element['subscribed_at']}</td>
                    </tr>`);
            });
            $('.SubscribeListTable').fadeIn();
            $('.SubscribeListTable').DataTable();
            $('.loader').hide();
        }
    });
}