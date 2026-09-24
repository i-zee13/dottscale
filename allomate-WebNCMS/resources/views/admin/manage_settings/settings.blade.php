@extends('layouts.app')
@section('data-sidebar')
    <div id="product-cl-sec">
        <a id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text">New <span id="opp_name"></span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter p-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <form style="display: flex;" id="saveSettingsForm" autocomplete="off">
                                        @csrf
                                        <input type="text" id="operation" name="operation" hidden>
                                        <input type="text" id="opp_id" name="opp_id" hidden>
                                        <input type="text" id="opp_name_input" name="opp_name_input" hidden>

                                        <div id="floating-label" class="card p-20 top_border mb-3 designation_form_div"
                                            style="width: 100%; display:none">
                                            <h2 class="_head03">Designation <span>Details</span></h2>
                                            <div class="form-wrap p-0 font13">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Designation Name*</label>
                                                            <input type="text" name="designation_name"
                                                                class="form-control required_designation">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>

                                <div id="floating-label" class="card p-20 top_border mb-3 department_form_div"
                                    style="width: 100%; display:none">
                                    <h2 class="_head03">Department <span>Details</span></h2>
                                    <div class="form-wrap p-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Department Name*</label>
                                                    <input type="text" name="department_name"
                                                        class="form-control required_department">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    <div class="_cl-bottom">
        <button type="button" class="btn btn-primary mr-2" id="saveBtn">Save</button>
        <button id="pl-close" type="button" class="btn btn-cancel mr-2" id="cancelBtn">Cancel</button>
    </div> 
    </div>
@endsection
@section('page-style')
    <style>
        .brandLogo_img {
            width: 33px;
            height: 33px;
            margin-right: 8px;
            border: solid 1px #e0e0e0
        }

        .brand_description_label {
            font-size: 0.7rem;
        }

        .modal-backdrop {
            z-index: 998 !important;
        }

        .link-dialog>.modal-dialog {
            font-size: 13px !important;
        }
    </style>
@endsection



@section('content')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content top-borderRed">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <strong>Are you sure you want to delete?</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-btn confirm_delete">Yes</button>
                    <button type="submit" class="btn w-btn btn-cancel cancel_delete_modal" data-dismiss="modal"
                        aria-label="Close">No</button>
                </div>
            </div>
        </div>
        <button hidden data-toggle="modal" data-target="#deleteModal" id="hidden_btn_to_open_modal"> </button>
    </div>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Settings <span></span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Settings</span></a></li>
                <li><span>Setting Details</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card _Dispatch">
                <div class="header">
                    <h2>Setting <span>Details</span></h2>
                </div>
                <div class="row m-0">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="nav flex-column nav-pills CB-account-tab" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            @if(GetActiveGuardDetail()->super == 1)
                            <a class="nav-link active" id="v-pills-01-tab" data-toggle="pill" href="#v-pills-01"
                                role="tab" aria-controls="v-pills-01" aria-selected="true">Theme Config CSS</a>
                            <a class="nav-link" id="v-pills-02-tab" data-toggle="pill" href="#v-pills-02" role="tab"
                                aria-controls="v-pills-02" aria-selected="false">Menu CSS </a>
                            <a class="nav-link" id="v-pills-03-tab" data-toggle="pill" href="#v-pills-03" role="tab"
                                aria-controls="v-pills-03" aria-selected="false">Footer CSS </a>
                            @endif
                            <a class="nav-link {{GetActiveGuardDetail()->super == 0 ? 'active' : ''}}" id="v-pills-04-tab" data-toggle="pill" href="#v-pills-04"
                                role="tab" aria-controls="v-pills-04" aria-selected="true">Designations</a>

                            <a class="nav-link" id="v-pills-05-tab" data-toggle="pill" href="#v-pills-05" role="tab"
                                aria-controls="v-pills-05" aria-selected="false">Departments </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 ml-800">
                        <div class="tab-content" id="v-pills-tabContent">
                            @if(GetActiveGuardDetail()->super == 1)
                            <div class="tab-pane fade show active" id="v-pills-01" role="tabpanel"
                                aria-labelledby="v-pills-01-tab">

                                <div style="min-height: 400px" class="loader">
                                    <img src="/images/loader.gif" width="30px" height="auto"
                                        style="position: absolute; left: 40%; top: 45%;">
                                </div>
                                <div class="col-12 first-pill" style="display:none">
                                    <form style="display: flex;" id="themeConfigForm" autocomplete="off">
                                        @csrf
                                        <input type="hidden" value="{{ @$themeData[1][0]->id }}" id="content-id-1"
                                            name="content_id">
                                        <input type="hidden" value="1" name="content_type">

                                        <div id="floating-label" class="p-20 mb-3 theme_config_css" style="width: 100%;">
                                            <h2 class="_head03">Theme Config <span>CSS</span></h2>
                                            <div class="form-wrap p-0 font13">
                                                <div class="row">
                                                    <div class="col-md-12 PB-10">
                                                        <label class="font12">Content *</label>
                                                        <textarea class="proTextarea required" id="content-1" rows="12" name="content">{{ @$themeData[1][0]->content }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 text-center PT-5">
                                    <button type="button" class="btn btn-primary mr-2 mb-20 save_form">Save</button>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="v-pills-02" role="tabpanel"
                                aria-labelledby="v-pills-02-tab">

                                <div style="min-height: 400px" class="loader">
                                    <img src="/images/loader.gif" width="30px" height="auto"
                                        style="position: absolute; left: 40%; top: 45%;">
                                </div>
                                <div class="col-12">
                                    <form style="display: flex;" id="menuConfigForm" autocomplete="off">
                                        @csrf
                                        <input type="hidden" value="{{ @$themeData[2][0]->id }}" id="content-id-2"
                                            name="content_id">
                                        <input type="hidden" value="2" name="content_type">

                                        <div id="floating-label" class="p-20 mb-3 theme_config_css" style="width: 100%;">
                                            <h2 class="_head03">Menu Config <span>CSS</span></h2>
                                            <div class="form-wrap p-0 font13">
                                                <div class="row">
                                                    <div class="col-md-12 PB-10">
                                                        <label class="font12">Content *</label>
                                                        <textarea class="proTextarea required" rows="12" id="content-2" name="content">{{ @$themeData[2][0]->content }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 text-center PT-5">
                                    <button type="button" class="btn btn-primary mr-2 mb-20 save_form">Save</button>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="v-pills-03" role="tabpanel"
                                aria-labelledby="v-pills-03-tab">

                                <div style="min-height: 400px" class="loader">
                                    <img src="/images/loader.gif" width="30px" height="auto"
                                        style="position: absolute; left: 40%; top: 45%;">
                                </div>
                                <div class="col-12">
                                    <form style="display: flex;" id="footerConfigForm" autocomplete="off">
                                        @csrf
                                        <input type="hidden" value="{{ @$themeData[3][0]->id }}" id="content-id-3"
                                            name="content_id">
                                        <input type="hidden" value="3" name="content_type">

                                        <div id="floating-label" class="p-20 mb-3 theme_config_css" style="width: 100%;">
                                            <h2 class="_head03">Footer Config <span>CSS</span></h2>
                                            <div class="form-wrap p-0 font13">
                                                <div class="row">
                                                    <div class="col-md-12 PB-10">
                                                        <label class="font12">Content *</label>
                                                        <textarea class="proTextarea required" rows="12" id="content-3" name="content">{{ @$themeData[3][0]->content }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12 text-center PT-5">
                                    <button type="button" class="btn btn-primary mr-2 mb-20 save_form">Save</button>
                                </div>
                            </div>
                            @endif
                            <div class="tab-pane fade {{GetActiveGuardDetail()->super == 0 ? 'show active' : ''}}" id="v-pills-04" role="tabpanel"
                            aria-labelledby="v-pills-04-tab">
                            <div class="col-md-12 PT-20 mb-0">
                                <h2 class="_head04">Designations
                                    <a class="btn add_button openDataSidebarForAddingDesignation"
                                        style="right:0px; top:-7px;"><i class="fa fa-plus"></i> New Designation</a>
                                </h2>
                            </div>
                            <div style="min-height: 400px" class="loader">
                                <img src="/images/loader.gif" width="30px" height="auto"
                                    style="position: absolute; left: 40%; top: 45%;">
                            </div>
                            <div class="col-md-12 productRate-table m-0 body_designations mt-20 mb-30">

                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-05" role="tabpanel" aria-labelledby="v-pills-05-tab">
                            <div class="col-md-12 mb-0" style="padding-top:20px !important">
                                <h2 class="_head04">Departments
                                    <a class="btn add_button openDataSidebarForAddingDepartment"
                                        style="right:0px; top:-7px;"><i class="fa fa-plus"></i> New Department</a>
                                </h2>
                            </div>
                            <div style="min-height: 400px" class="loader">
                                <img src="/images/loader.gif" width="30px" height="auto"
                                    style="position: absolute; left: 40%; top: 45%;">
                            </div>
                            <div class="col-md-12 productRate-table m-0 body_departments mt-20 mb-30">

                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/custom/settings.js?v=2.1') }}"></script>
@endpush
