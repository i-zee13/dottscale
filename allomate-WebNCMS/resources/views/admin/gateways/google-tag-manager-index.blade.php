@extends('layouts.app')
@section('data-sidebar')
@endsection

@section('content')

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Manage <span>Gateways</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="#"><span>Manage</span></a></li>
            <li><span>Gateways</span></li>
        </ol>
    </div>
</div>
<div style="min-height: 400px" id="tblLoader">
    <img src="/images/loader.gif" width="30px" height="auto"
        style="position: absolute; left: 50%; top: 45%;">
</div>
<div class="row" id="MainContent" style="display: none;">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Google Tag <span> Manager</span></h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" name="section_type" class="form-control shadow-none" id="section_type" value="tag_manager">
                        <div class="form-group">
                            <label class="control-label mb-10">Tag Header*</label>
                            <textarea type="text" rows="5" name="google_tag_header" class="form-control" id="google-tag-header" style="box-shadow:none"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label mb-10">Tag Body*</label>
                            <textarea type="text" rows="5" name="google_tag_body" class="form-control" id="google-tag-body" style="box-shadow:none"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-s2 pt-19">
            <label class="control-label mb-10">Status*</label>
            <select name="google_tag_status" class="form-control formselect" style="width: 100%!important" id="google-tag-status">
                <option value="active">Active</option>
                <option value="inactive">In-active</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 mt-20">
        <button type="button" class="btn btn-primary mr-2 save-btn" id="SaveGoogleTagBtn" onclick="SaveGoogleTag()">Save</button>
    </div>
</div>
@endsection
@push('js')
    <script src="/js/custom/gateway.js"></script>
@endpush
