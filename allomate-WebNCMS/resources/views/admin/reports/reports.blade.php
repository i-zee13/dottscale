@extends('layouts.app')
<style>
    #product-cl-sec {
        width: 800px;
    }

    .AccRights h3 {
        margin-bottom: 15px;
        margin-top: 30px;
    }

    .AccRights h3 .custom-control-label {
        font-size: 16px;
    }

    .se_cus-type {
        background-color: #f6f6f6;
        border: solid 1px #eaeaea;
        padding: 5px 15px 10px 15px;
    }

    .se_cus-type h3 {
        margin-top: 10px;
        margin-bottom: 0;
        border: none
    }

    .selectall {
        position: absolute !important;
        right: 15px;
        top: 10px;
        line-height: 1.7;
        z-index: 2;
        font-size: 12px;
    }

    .custom-control-label {
        font-size: 12px;
    }

   
</style>
@section('data-sidebar')
    <div id="product-cl-sec" style="width: 750px!important">
        <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text">New<span> Report</span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0 AccRights">
                        <div class="container">
                            <form style="width: 100%" id="saveReports">
                                @csrf
                                <input type="hidden" id="report_id" name="report_id">
                                <input type="hidden" id="sidebar_type">
                                <input type="text" id="operation" hidden>
                                <div class="row" id="InvestorsRow">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mt-3 mb-3"
                                            style="width: 100%;">
                                            <h2 class="_head03">Report<span>  Details</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">Report Type *</label>
                                                            <select class="form-control  report-required formselect "
                                                                placeholder="" id="report_type_id" name="report_type_id">
                                                                <option value="" selected>Select Report Type</option>
                                                                @if (@$report_types)
                                                                    @foreach (@$report_types as $type)
                                                                        <option value="{{ $type->id }}">
                                                                            {{ $type->report_type }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <div class="form-group">
                                                            <label class="control-label">Publish Date*</label>
                                                            <input type="text" name="publish_date" id="publish_date"
                                                                class="form-control datepicker report-required" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Report Title *</label>
                                                            <input type="text" name="report_title" id="report_title"
                                                                value=""
                                                                class="form-control report-type report-required"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 p-0 mt-5">
                                                        <label for=""
                                                            class="col-sm-12 font12 col-form-label report_description">Report
                                                            Description*
                                                        </label>
                                                        <div class="col-sm-12">
                                                            <textarea class="proTextarea " name="report_description" id="report_description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pdfDiv mt-20">
                                                        <div class="form-wrap p-0" id="dropifyImgDiv">
                                                            <label class="font12 mb-5 report_file">Upload Report*</label>
                                                            <div class="form-wrap p-0">
                                                                <input type="file" name="report_file" id="report_file"
                                                                    class="dropify " accept=".pdf,.doc,.docx,.ppt,.pptx"
                                                                    data-allowed-file-extensions="pdf doc docx ppt pptx" />
                                                                <input type="hidden" value=""
                                                                    name="hidden_report_file" id="hidden_report_file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 view_doc_div">
                                                    </div>

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
        <div class="_cl-bottom">
            <button type="button" class="btn btn-primary mr-2" id="saveReport">Save</button>
            <button id="pl-close" type="button" class="btn btn-cancel mr-2" id="cancelReport">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Reports <span> Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Reports</span></a></li>
                <li><span>Active</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a class="btn add_button openDataSidebarForAddingReports"><i class="fa fa-plus"></i> New Report
                    </a>
                    <h2>Reports List</h2>
                </div>
                <div style="min-height: 400px" id="tblLoader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body body_reports" style="display: none">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="/js/custom/reports.js"></script>
@endpush
