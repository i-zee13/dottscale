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
        <div class="pro-header-text">New<span> Media</span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist showForm">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0 AccRights">
                        <div class="container">
                            <form style="width: 100%" id="saveBlocksMedia">
                                @csrf
                                <input type="hidden" id="media_id" name="media_id">
                                <input type="hidden" id="sidebar_type">
                                <input type="text" id="operation" hidden>
                                <div class="row" id="InvestorsRow">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mt-3 mb-3"
                                            style="width: 100%;">
                                            <h2 class="_head03">Block<span> Media Details</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">Page Builder Blocks *</label>
                                                            <select class="form-control blocksSelect formselect "
                                                                placeholder="" id="block_id" name="block_id">
                                                                
                                                                 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 dt dt-1">
                                                        <div class="form-wrap pt-19 PB-10" id="dropifyImgDiv">
                                                            <label class="font12 mb-5">Dekstop Image*</label>
                                                            <div class="form-wrap p-0">
                                                                <input type="file" name="media_dekstop_image"
                                                                    id="media_dekstop_image" class="dropify" required
                                                                    data-allowed-file-extensions="jpg png jpeg tif tiff svg pjp webp xbm jxl jfif bmp avif ico gif">
                                                            </div>
                                                            <input type="hidden" id="hidden_dekstop_image" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 dt dt-1">
                                                        <div class="form-wrap pt-19 PB-10" id="dropifyImgDiv">
                                                            <label class="font12 mb-5">Mobile Image</label>
                                                            <div class="form-wrap p-0">
                                                                <input type="file" name="media_mobile_image"
                                                                    id="media_mobile_image" class="dropify" required
                                                                    data-allowed-file-extensions="jpg png jpeg tif tiff svg pjp webp xbm jxl jfif bmp avif ico gif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 dt dt-1">
                                                        <div class="form-wrap pt-19 PB-10" id="dropifyImgDiv">
                                                            <label class="font12 mb-5">Tablet Image</label>
                                                            <div class="form-wrap p-0">
                                                                <input type="file" name="media_tablet_image"
                                                                    id="media_tablet_image" class=" dropify" required
                                                                    data-allowed-file-extensions="jpg png jpeg tif tiff svg pjp webp xbm jxl jfif bmp avif ico gif">
                                                            </div>
                                                        </div>
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
            <button type="button" class="btn btn-primary mr-2" id="saveMedia">Save</button>
            <button id="pl-close" type="button" class="btn btn-cancel mr-2" id="cancelMedia">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Blocks <span> Media Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Media</span></a></li>
                <li><span>Active</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a class="btn add_button openDataSidebarForAddingMedia"><i class="fa fa-plus"></i> New Media
                    </a>
                    <h2>Blocks Media List</h2>
                </div>
                <div style="min-height: 400px" id="tblLoader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body body_media" style="display: none">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="/js/custom/blocksMedia.js"></script>
@endpush
