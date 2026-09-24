@extends('layouts.app')
@section('data-sidebar')
    <div id="product-cl-sec" class="faqs-sidebar" style="width: 800px">
        <a href="#" id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text">Assign New <span>FAQ</span></div>
        <div class="pc-cartlist">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0">
                        <form id="SaveProductFaqsForm">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="" />
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mb-3">
                                            <h2 class="_head03">FAQ <span>Details</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="font12 mb-5">Question *</label>
                                                        <input type="text" id="faq_question" name="faq_question" class="form-control faq-required" placeholder="" />
                                                    </div>
                                                    <div class="col-12 pt-10">
                                                        <label class="font12 mb-5">Answer *</label>
                                                        <textarea name="faq_answer"></textarea>
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
            <button type="submit" class="btn btn-primary mr-2 save-faq" id="save-product-faq">Save</button>
            <button id="pl-close" type="submit" class="btn btn-cancel mr-2 faq-cancel" id="faq-cancel">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Product <span>FAQs</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Product FAQs </span></a></li>
                <li><span>Add</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="faq_product_id" id="faq_product_id" value="{{ $id }}" />
            <div class="card">
                <div class="header">
                    <button type="button" id="{{ $id }}" data-id="{{ $id }}" class="btn add_button add_product_faqs"><i class="fa fa-plus"></i> <span>Add FAQ</span></button>
                    <h2>Product <span>FAQs</span></h2>
                </div>
                <div style="min-height: 400px" class="loader">
                    <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;" />
                </div>
                <div class="body product_faqs_list">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteHomeSection" tabindex="-1" role="dialog" aria-labelledby="deleteHomeSectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content top-borderRed">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteHomeSectionLabel">Delete <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <input type="hidden" id="promotion-delete-id">
                            <p>Do you want to delete this faq?</p>
                        </div>
                    </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary confirm_delete">Yes</button>
                    <button type="button" class="btn btn-cancel cancel_delete_modal" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
        <button hidden data-toggle="modal" data-target="#deleteHomeSection" id="hidden_btn_to_open_section_modal"></button>
    </div>
@endsection
@push('js')
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('ckfinder/ckfinder.js') }}"></script>
<script src="{{asset('js/custom/faqs.js')}}"></script>
@endpush
