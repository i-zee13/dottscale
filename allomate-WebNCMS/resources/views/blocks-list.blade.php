@extends('layouts.app')
@section('content')
<div id="product-cl-sec" class="">
    <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
    <div class="pro-header-text">PageBuilder <span>Block</span></div>
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter ">
                    <form id="SaveBlockForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="block_id" id="block_id">
                        <input type="hidden" name="block_slug" id="block_slug">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="floating-label" class="card p-20 top_border mb-3">
                                        <h2 class="_head03">Block <span>Details</span></h2>
                                        <div class="form-wrap p-0 PT-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="font12 mb-5">Title*</label>
                                                    <input type="text" name="block_title" class="form-control block_required block_title" style="text-transform:capitalize">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="font12 mb-5">Category*</label>
                                                    <div class="form-s2 ">
                                                        <select class="form-control formselect block_required block_category" name="block_category">
                                                            <option value="">Select Category</option>
                                                            <option value="Basic Elements">Basic Elements</option>
                                                            <option value="Body Layouts">Body Layouts</option>
                                                            <option value="Forms">Forms</option>
                                                            <option value="Page Headers">Page Headers</option>
                                                            <option value="FAQs">FAQs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 PT-5">
                                                    <label class="font12 mb-5">CSS</label>
                                                    <textarea class="proTextarea" rows="6" id="block_css" name="block_css"></textarea>
                                                </div>
                                                <div class="col-md-12 PT-5">
                                                    <label class="font12 mb-5">HTML*</label>
                                                    <textarea class="proTextarea block_required" rows="6" id="block_html" name="block_html"></textarea>
                                                </div>
                                                {{-- <div class="col-md-12 PT-5">
                                                    <label class="font12 mb-5">CSS*</label>
                                                    <textarea class="proTextarea block_required" rows="6" id="block_css" name="block_css"></textarea>
                                                </div> --}}
                                                <div class="col-12">
                                                    <div class="form-wrap p-0">
                                                        <label class="font12 mb-5">Thumbnail*</label>
                                                        <div class="upload-pic"></div>
                                                        <input type="hidden" id="hidden_block_thumbnail" name="hidden_block_thumbnail">
                                                        <input type="file" id="block_thumbnail" name="block_thumbnail" data-default-file="" class="dropify " accept="image/*"/>
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
        <button type="submit" class="btn btn-primary mr-2 saveBlock" id="saveBlock">Save</button>
        <button id="pl-close" type="button" class="btn btn-cancel mr-2 page-cancel" id="page-cancel">Cancel</button>
    </div>
</div>
<style>
    .form-s2 .select2-container--default .select2-selection--single .select2-selection__rendered{
        font-size:13px;
    }
</style>
<div class="row mt-2 mb-3">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <h2 class="_head01">Blocks <span> Management</span></h2>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <ol class="breadcrumb">
      <li><a href="javascript:void(0);"><span>Add </span></a></li>
      <li><span>Blocks </span></li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <button class="btn add_button add-block" type="button"><i class="fa fa-plus"></i>
            <span>Add New Block</span>
          </button>
          <h2>Blocks <span>List</span></h2>
      </div>
      <div style="min-height: 400px" class="loader">
        <img src="images/loading.gif" width="30px" height="auto"
            style="position: absolute; left: 50%; top: 45%;">
      </div>
      <div class="body all_blocks">
          
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="/js/custom/pagebuilder-blocks.js"></script>
@endpush
