var allRecords  =   [];
$(document).ready(function(){
    $(".dp").datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        endDate: new Date()
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
        $(this).blur();
    });
    dataFetch();
});
$(document).on('click','.search-report',function(){
    var startDate           =   $('.start-date').val().trim();
    var endDate             =   $('.end-date').val().trim();
    if(!startDate || !endDate){
        showMessage('red',"Please select Start/End/ first");
        return;
    }
    if(endDate && startDate){
        if(endDate < startDate){
            showMessage('red',` End date can't be Less than Start date`);
            $('.end-date').val("");
            $('.end-date').focus();
            return;
        }
    }
    dataFetch();
});
function dataFetch(){
    $('.loader').show();
    $('#reports-list').empty();
    $('.ProductPageNav').hide();
    var searchValue         =   $('#search-report').val().toLowerCase().trim();
    var startDate           =   $('.start-date').val().trim();
    var endDate             =   $('.end-date').val().trim();
    var categoryId          =   $('.report-category-id').val().trim();
    $.ajax({
        url                 :   '/investor/get-all-reports-for-investor',
        data                :   {
            searchValue     :   searchValue ? searchValue : '', 
            startDate       :   startDate, 
            endDate         :   endDate, 
            categoryId      :   categoryId ? categoryId : '', 
        },
        success             :   function(success){
            allRecords      =   success.records;
            dataList();
            $('.loader').hide();
        }
    });
}
function dataList() {
    $('#reports-list').empty();
    var valuesLists         =   allRecords;
    if(valuesLists.length > 0){
        $('.notFoundMainDiv').hide();
        $('.ProductPageNav').show();
        var page_limit_list = 12;
        var optionsLists = {
            page: page_limit_list,
            pagination: true,
            valueNames: ['id','category_name','publish_date','slug','report_title'],
            item: function (valueNames) {
                return `
                <div class="col-lg-3 col-md-4">
                    <div class="_product-card">
                        <h2>${valueNames.report_title}</h2>
                        <div class="con_info pt-0 ">
                            <p><strong>Report Category:</strong><br>${valueNames.category_name}</p>
                            <p class="mt-10"><strong>Published Date:</strong> ${valueNames.publish_date}</p>
                            <div class="PT-20">
                                <a href="/investor/reports/${valueNames.slug ? valueNames.slug : '#'}" class="btn cusDetail m-0">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>`;
            }
        };
        var listTable = new List('ReportsList', optionsLists, valuesLists);
        $('.pagination').find('li').addClass('page-item');
        $('.pagination').find('a').addClass('page-link');
    }else{
        $('.ProductPageNav').hide();
        $('.notFoundMainDiv').show();
    }
}
$(document).on('click','.page',function(){
    $('.pagination').find('li').addClass('page-item');
    $('.pagination').find('a').addClass('page-link');
});