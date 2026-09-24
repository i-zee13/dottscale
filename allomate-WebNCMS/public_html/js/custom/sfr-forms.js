var segments = location.href.split('/');
var all_records = [];
$(document).ready(function () {
    PropertiesListRecordGet();
});
function PropertiesListRecordGet() {
    $('.inquiries-records').empty();
    $('.loader').show();
    $.ajax({
        url: '/admin/get-all-properties-forms-list',
        success: function (response) {
            all_records = response.records;
            $('.inquiries-records').append(`
                <table class="table table-hover dt-responsive nowrap SubscribeListTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th hidden>Street Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th hidden>Zip Code</th>
                            <th>Asking Price</th>
                            <th hidden>Note</th>
                            <th>Action</th>
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
                        <td>${element['created_date']}</td>
                        <td>${element['first_name']}</td>
                        <td>${element['last_name']}</td>
                        <td>${element['email']}</td>
                        <td>${element['phone_no']}</td>
                        <td hidden>${element['street_address']}</td>
                        <td>${element['city_name'] ? element['city_name'] : 'NA'}</td>
                        <td>${element['state_name'] ? element['state_name'] : 'NA'}</td>
                        <td hidden>${element['zip_code'] ? element['zip_code'] : 'NA'}</td>
                        <td>${element['asking_price'] ? element['asking_price'] : ''}</td>
                        <td hidden>${element['notes']}</td>
                        <td>
                            <button id="${element['id']}" class="btn btn-default detailOpen">Detail</button>
                        </td>
                    </tr>`);
            });
            $('.SubscribeListTable').fadeIn();
            var table       =   $('.SubscribeListTable').DataTable({
                dom         :   'Bfrtip',
                buttons     :   [
                    {
                        title: 'SFR Properties Request Report',
                        orientation: 'Portrait',
                        pageSize: 'A4',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,':visible:not(:last-child)'],
                            format: {
                                header: function ( data, columnIdx ) {
                                    return data;
                                }
                            }
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'SFR Properties Request Report',
                        orientation: 'Landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            // columns: [0,4]
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,':visible:not(:last-child)'],
                        },
                        customize: function (doc) {
                            doc.content.splice(0, 1, {
                                text: [{
                                    text: 'SFR Properties Request Report',
                                    bold: true,
                                    fontSize: 14,
                                    alignment: 'center',
                                },
                                ],
                                margin: [0, 0, 0, 12],
                            });
                            doc.pageMargins = [20, 12, 20, 12];
                            // doc.styles.tableBodyOdd.fillColor = "#FFA07A";
                            doc.styles.tableHeader.fillColor = "#E6E6E6";
                            doc.styles.tableFooter.fillColor = "#E6E6E6";
                            doc.styles.tableHeader.color = "black";
                            doc.styles.tableHeader.alignment = "left";
                            doc.styles.title.alignment = "left";
                            doc.content[1].table.widths = 'auto';
                            doc.content[1].margin = [ 20, 0, 20, 0 ]
                            //cell border
                            var objLayout = {};
                            objLayout['hLineWidth'] = function (i) { return 0.5; };
                            objLayout['vLineWidth'] = function (i) { return 0.5; };
                            objLayout['hLineColor'] = function (i) { return '#E6E6E6'; };
                            objLayout['vLineColor'] = function (i) { return '#E6E6E6'; };
                            objLayout['paddingLeft'] = function (i) { return 3; };
                            objLayout['paddingRight'] = function (i) { return 3; };
                            objLayout['paddingTop'] = function (i) { return 4; };
                            objLayout['paddingBottom'] = function (i) { return 4; };
                            doc.content[1].layout = objLayout;
                            age = table.column(4).data().toArray();
                            // testing for the background of the row
                            doc.content[1].table.body.forEach((element) => {
                                element.forEach((el) => {
                                    element.forEach((cell) => {
                                        cell.fillColor = 'white';
                                        cell.fontSize = '9';
                                    })
                                })
                            })
                            doc.content[1].table.body.forEach((element) => {
                                element.forEach((el) => {
                                    if (el.text == "Message") {
                                        element.forEach((cell) => {
                                            cell.fillColor = '#F2F2F2';
                                            cell.fontSize = '9';
                                            cell.bold = true;
                                        })
                                    }
                                })
                            })
                        }
                    }
                ]
            });
            $('.loader').hide();
        }
    });
    $(document).on('click', '.detailOpen', function () {
        
        $('#PropertiesDetailForm').hide(); 
        $('#dataSidebarLoader').show();
        openSidebar(); 
        var id = $(this).attr('id');
        if (id) {
            var record = all_records.find(x => x.id == id);
            if (record) { 
                $('#zip_code').text(record.zip_code ?? 'NA');
                $('#street_address').text(record.street_address??'NA');
                $('#notes').text(record.notes??'NA');
                $('#email').text(record.email??'NA');
                $('#phone').text(record.phone_no??'NA');
                $('#city').text(record.city_name??'NA');
                $('#state').text(record.state_name??'NA');
                $('#asking_price').text(record.asking_price??'NA');
                $('#first_name').text(record.first_name??'NA')
                $('#last_name').text(record.last_name??'NA')
                $('#created_at').text(record.created_date??'NA')
                let pageReference = record.page_reference ? record.page_reference.replace(/[\/-]/g, ' ') : 'NA';
                $('#page_reference').text(pageReference); 
            
            } else {
                showMessage('red', 'Record not found, Please Try again later');
                closeSidebar();
            }
            
        } else {
            showMessage('red', 'Record not found, Please Try again later')
            closeSidebar();
        }
        $('#dataSidebarLoader').hide();
        $('#PropertiesDetailForm').show(); 
        

    });
}