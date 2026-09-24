<div class="modal fade" id="SearchDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row SearchTopHead">
                        <div class="col-6">
                            <h2 class="_head01 mb-0">Search</h2>
                        </div>
                        <div class="col-6">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                    <div class="row Search__Input">
                        <input type="search" class="form-control search_whole_site" placeholder="Type to search...">
                        <a href="javascript:void(0);"><img src="/images/search-icon.svg" alt="" /></a>
                    </div>
                </div>
                <div style="min-height: 400px" id="tblLoader_search" style="display:none">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="container-fluid SearchList">
                </div>
            </div>
        </div>
    </div>
</div>