@extends('layouts.app')
@section('content')
<style>
    .top-border {
        border-top: solid 2px #EBB30A;
        border-radius: 0;
    }

    .publish {
        background-color: #040725;
        font-size: 14px;
        letter-spacing: 1px;
        border-radius: 0;
        line-height: 1;
        padding: 8px 20px;
        border: solid 1px #040725;
        color: #fff !important;
    }

    .draft {
        background-color: #fff;
        font-size: 14px;
        letter-spacing: 1px;
        border-radius: 0;
        line-height: 1;
        padding: 8px 20px;
        border: solid 1px #040725;
        color: #040725 !important;
    }
</style>
{{-- Modal --}}
<div class="modal fade" id="lead_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content top-border">
            <form id="SaveModalStatusPage">
                @csrf
                <input type="hidden" name="page_id" id="page_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Page Status <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-20">
                    <div class="row">
                        <div class="col-4">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status page_draft" type="radio"
                                    id="page_draft" value="1" data-id="page_draft" name="radio_status">
                                <label class="custom-control-label head-sta" for="page_draft">Draft</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status page_publish" type="radio"
                                    id="page_publish" value="2" data-id="page_publish" name="radio_status">
                                <label class="custom-control-label head-sta" for="page_publish"> Publish</label>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status page-inactive" type="radio"
                                    id="page-inactive" value="3" data-id="page-inactive" name="radio_status">
                                <label class="custom-control-label head-sta" for="page-inactive"> In Active</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-page-status" id="save-page-status" data-value=""
                        data-id="">Save</button>
                    <!--<button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>-->
                </div>
            </form>

        </div>
    </div>
    <button hidden data-toggle="modal" data-target="#lead_detail" id="hidden_btn_to_open_modal"></button>

</div>
<div id="product-cl-sec" class="">
    <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>

    <div class="pro-header-text">New <span>Page</span></div>
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter ">
                    <form id="SavePageForm">
                        @csrf
                        <input type="hidden" name="hidden_page_id" id="hidden_page_id">
                        <input type="hidden" name="hidden_page_translation_id" id="hidden_page_translation_id">
                        <input type="hidden" name="locale" value="en">
                        <input type="hidden" name="layout" value="master">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="floating-label" class="card p-20 top_border mb-3">
                                        <h2 class="_head03">Page <span>Details</span></h2>
                                        <div class="form-wrap p-0 PT-10">
                                            <div class="row">
                                                <div class="col-12">
                                                    <lable class="font12  ">Select Page Type * </lable>
                                                    <div class="form-s2 mt-5">
                                                        <select class="form-control formselect faq-required"
                                                            name="page_type" id="page_type"
                                                            placeholder="select Type">
                                                            <option selected value="0">Select Type</option>
                                                            <option value="1">Landing Page</option>
                                                            <option value="3">General Page</option>
                                                            <option value="4">Offer Page</option>
                                                        </select>

                                                    </div>
                                                </div>



                                                <!-- <div class="col-6">
                                                                                <h2 class="_head04 border-0 mb-0">Select Page <span>Status *</span></h2>
                                                                                <div class="form-s2">
                                                                                    <select class="form-control formselect faq-required" name="page_status" id="faq_type" placeholder="select Grade">
                                                                                        <option selected value="0">Select Status</option>
                                                                                        <option value="1">Draft </option>
                                                                                        <option value="2">Published</option>
                                                                                        <option value="3">In Active </option>
                                                                                        <option value="4">Removed</option>
                                                                                    </select>
                                                                               
                                                                            </div>
                                                                        </div> -->
                                                <div class="col-6 display PT-20" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Page Title *</label>
                                                        <input type="text" id="page_title" name="page_title"
                                                            class="form-control faq-required" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6 display  PT-20" style="display: none;">
                                                    <div class="form-group page_route">
                                                        <label class="control-label mb-10">Page Route *</label>
                                                        <input type="text" id="page_route" name="page_route"
                                                            class="form-control faq-required" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 is_indexable PT-5">
                                                    <label class="font12">Is Indeaxable *</label>
                                                    <div class="form-s2 mt-0">
                                                        <select class="form-control formselect" name="is_indexable"
                                                            id="is_indexable" placeholder="select Type">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 is_followable PT-5">
                                                    <label class="font12">Is Followable *</label>
                                                    <div class="form-s2 mt-0">
                                                        <select class="form-control formselect" name="is_followable"
                                                            id="is_followable" placeholder="select Type">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="_head03 PT-20 display" style="display: none;">Meta <span>Details</span></h2>
                                            <div class="form-wrap p-0 PT-10">
                                                <div class="row">
                                                    <div class="col-6 display " style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Meta Content
                                                                (Author)</label>
                                                            <input type="text" id="meta_content_author"
                                                                class="form-control" placeholder=""
                                                                name="meta_content_author">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 display " style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Meta Content
                                                                (Keywords)</label>
                                                            <input type="text" id="meta_content_keywords"
                                                                class="form-control" placeholder=""
                                                                name="meta_content_keywords">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 display PT-10" style="display: none;">
                                                        <label class="font12">Meta Content (Description)</label>
                                                        <textarea class="proTextarea" rows="2" id="meta_content_description" name="meta_content_description"></textarea>
                                                    </div>
                                                    <div class="col-6 display PT-10" style="display: none;">
                                                        <label class="font12">OG Title</label>
                                                        <textarea class="proTextarea" rows="2" id="meta_og_title" name="meta_og_title"></textarea>
                                                    </div>
                                                    <div class="col-6 display PT-10" style="display: none;">
                                                        <label class="font12">OG Description</label>
                                                        <textarea class="proTextarea" rows="2" id="meta_og_description" name="meta_og_description"></textarea>
                                                    </div>
                                                    <div class="col-12 display PT-10" style="display: none;">
                                                        <label class="font12">Rich Text Tags</label>
                                                        <textarea class="proTextarea" rows="2" id="meta_structure_tags" name="meta_structure_tags"></textarea>
                                                    </div>   
                                                    <div class="col-12 display PT-10" style="display: none;">
                                                        <div class="form-wrap p-0">
                                                            <label class="font13 mb-5">OG Image</label>
                                                            <div class="upload-pic"></div>
                                                            <input type="hidden" name="hidden_og_image" id="hidden_og_image" value="{{ @$all_records->meta_og_image }}">
                                                            <input type="file" id="meta_og_image" name="meta_og_image" data-default-file="" class="dropify " data-old_input="hidden_og_image"
                                                                accept="image/*" />
                                                        </div>
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
    <div class="_cl-bottom">
        <button type="submit" class="btn btn-primary mr-2 save-page" id="save-page">Save</button>
        <button id="pl-close" type="submit" class="btn btn-cancel mr-2 page-cancel"
            id="page-cancel">Cancel</button>
    </div>
</div>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Pages <span>List</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Pages</span></a></li>
            <li><span>List</span></li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <button type="button" class="btn add_button add_page"><i class="fa fa-plus"></i> <span>Add
                        Page</span></button>
                <h2>Pages <span>List</span></h2>
            </div>
            <div style="min-height: 400px" class="loader">
                <img src="images/loading.gif" width="30px" height="auto"
                    style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body pages_list">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="/js/custom/page-added.js"></script>
@endpush