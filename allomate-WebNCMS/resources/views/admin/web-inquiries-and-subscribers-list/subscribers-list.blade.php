@extends('layouts.app')
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Subscribers <span>List</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Subscribers List </span></a></li>
                <li><span>View</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    {{-- <a href="/add-help-center-category" class="btn add_button add_product_faqs"><i class="fa fa-plus"></i> <span>Add New Category</span></a> --}}
                    <h2>List</h2>
                </div>
                <div style="min-height: 400px" class="loader">
                    <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;" />
                </div>
                <div class="body subscribers-records">

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
                            <p>Do you want to delete this Category?</p>
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
<script src="{{asset('js/custom/subscribers-list.js')}}"></script>
@endpush
