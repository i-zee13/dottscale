@extends('layouts.app')
@section('content')
<div class="modal fade" id="lead_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                                <input class="custom-control-input radio_status page_draft" type="radio" id="page_draft"
                                    value="1" data-id="page_draft" name="radio_status">
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
    <div class="pro-header-text">Portfolio <span>Page</span></div>
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter ">
                    <form id="SavePageForm">
                        @csrf
                        <input type="hidden" name="hidden_page_id">
                        <input type="hidden" name="hidden_page_translation_id">
                        <input type="hidden" name="hidden_portfolio_id">
                        <input type="hidden" name="locale" value="en">
                        <input type="hidden" name="layout" value="master">
                        <input type="hidden" name="page_type" id="page_type" value="2">
                        <input type="hidden" id="meta_name_author" value="author" class="form-control" placeholder=""
                            name="meta_name_author">
                        <input type="hidden" id="meta_name_keywords" value="keyword" class="form-control" placeholder=""
                            name="meta_name_keywords">
                        <input type="hidden" id="meta_name_description" value="description" class="form-control"
                            placeholder="" name="meta_name_description">

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="floating-label" class="card p-20 top_border mb-3">
                                        <h2 class="_head03">Page <span>Details</span></h2>
                                        <div class="form-wrap p-0 PT-10">
                                            <div class="row">
                                                <div class="col-6 display PT-10" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Name *</label>
                                                        <input type="text" id="page_title" name="portfolio_name"
                                                            class="form-control faq-required portfolio_name"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6 display  PT-10" style="display: none;">
                                                    <div class="form-group page_route">
                                                        <label class="control-label mb-10">Page Route *</label>
                                                        <input type="text" id="page_route" name="page_route"
                                                            class="form-control faq-required" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6 display PT-10" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Page Title *</label>
                                                        <input type="text" name="page_title"
                                                            class="form-control faq-required" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-6 display   cat-div" style="display: none;"> 
                                                    <div class="form-s2">
                                                    <label class="mb-10" style="font-size: 12px!important;">Categories *</label>
                                                        <select class="reports-select multi" name="categories" multiple="multiple" id="categories" placeholder="Select categories" style="width: 100%">
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->service_name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6 mt-15">
                                                    <div class="custom-control custom-checkbox mr-sm-2 font14 ">
                                                        <input type="checkbox" value="1" name="is_slider_show"
                                                            class="custom-control-input " id="showSlider">
                                                        <label class="custom-control-label" for="showSlider">Show in
                                                            Slider</label>
                                                    </div>
                                                </div>
                                                 
                                                <div class="col-12 display PT-10" style="display: none;">
                                                    <div class="form-wrap p-0">
                                                        <label class="font13 mb-5">Thumbnail (600px X 560px) *</label>
                                                        <div class="upload-pic"></div>
                                                        <div class="img">
                                                            <input type="hidden" name="hidden_thumbnail"
                                                                id="hidden_thumbnail" value="">
                                                            <input type="file" id="thumbnail" name="thumbnail"
                                                                data-default-file="" class="dropify "
                                                                data-old_input="hidden_thumbnail" accept="image/*"
                                                                data-min-width="599" data-max-width="601"
                                                                data-min-height="559" data-max-height="561" />
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                        <h2 class="_head03 PT-20">Meta <span>Details</span></h2>
                                        <div class="form-wrap p-0 PT-10">
                                            <div class="row">
                                                <div class="col-6 display " style="display: none;">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Meta Content (Author)</label>
                                                        <input type="text" id="meta_content_author" class="form-control"
                                                            placeholder="" name="meta_content_author">
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
                                                    <textarea class="proTextarea" rows="2" id="meta_content_description"
                                                        name="meta_content_description"></textarea>
                                                </div>
                                                <div class="col-6 display PT-10" style="display: none;">
                                                    <label class="font12">OG Title</label>
                                                    <textarea class="proTextarea" rows="2" id="meta_og_title"
                                                        name="meta_og_title"></textarea>
                                                </div>
                                                <div class="col-6 display PT-10" style="display: none;">
                                                    <label class="font12">OG Description</label>
                                                    <textarea class="proTextarea" rows="2" id="meta_og_description"
                                                        name="meta_og_description"></textarea>
                                                </div>
                                                <div class="col-12 display PT-10" style="display: none;">
                                                    <label class="font12">Rich Text Tags</label>
                                                    <textarea class="proTextarea" rows="2" id="meta_structure_tags"
                                                        name="meta_structure_tags"></textarea>
                                                </div>
                                                <div class="col-12 display PT-10" style="display: none;">
                                                    <div class="form-wrap p-0">
                                                        <label class="font13 mb-5">OG Image</label>
                                                        <div class="upload-pic"></div>
                                                        <div class="img">
                                                            <input type="hidden" id="hidden_og_image"
                                                                name="hidden_og_image"
                                                                value="{{@$all_records->meta_og_image}}">
                                                            <input type="file" id="meta_og_image" name="meta_og_image"
                                                                data-default-file="" class="dropify "
                                                                data-old_input="hidden_og_image" accept="image/*" />
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
        <button id="pl-close" type="submit" class="btn btn-cancel mr-2 page-cancel" id="page-cancel">Cancel</button>
    </div>
</div>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Portfolios <span>Management</span></h2>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Portfolios </span></a></li>
            <li><span>list</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">

                <h2> List</h2>
                <a class="btn add_button openDataSidebarForAddingMainCat"><i class="fa fa-plus"></i>Add New</a>

            </div>
            <div class="tablebody P-20 pages_list" style="padding: 20px">

            </div>




        </div>

    </div>


</div>
@endsection
@push('js')
<script src="/admin/js/fSelect.js"></script>

<script>
    $(document).ready(function () {
        $(function () {
            window.fs_test = $('.multi').fSelect();
        });
    })
</script>
<script src="{{asset('js/custom/page-added.js')}}"></script>
@endpush