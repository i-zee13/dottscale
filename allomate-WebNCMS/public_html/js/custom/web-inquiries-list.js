var all_records = []
$(document).ready(function () {
    var records = $('#all_records').val();
    if (records) {
        all_records = JSON.parse(records);
    }
});
$(document).on('click', '.detailOpen', function () {
    $('.inquiriesForm').hide();
    $('#dataSidebarLoader').show();
    openSidebar();
    var id = $(this).attr('id');
    if (id) {
        var record = all_records.find(x => x.id == id);
        if (record) {
            console.log(record)
            $('#message').text(record.message ?? 'NA');
        } else {
            showMessage('red', 'Message not found');
            closeSidebar();
        } 
    } else {
        showMessage('red', 'Message not found')
        closeSidebar();
    }
    $('#dataSidebarLoader').hide();
    $('.inquiriesForm').show();


});