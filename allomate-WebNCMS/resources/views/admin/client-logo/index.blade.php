@extends('layouts.app')
@section('content')
<div id="product-cl-sec">
    <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
    <div class="pro-header-text">New <span>Client</span></div>
    <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
        <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
    </div>
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form style="display: flex;" id="saveClientForm">
                                    @csrf
                                    <input type="text" id="operation" hidden>
                                    <input type="text" name="hidden_client_id" value="" hidden>
                                    <div id="floating-label" class="card p-20 top_border mb-3" style="width: 100%">
                                        <h2 class="_head03">Client <span>Details</span></h2>
                                        <div class="form-wrap p-0">
                                            <div class="row">
                                                <div class="col-md-12 PT-5">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Sequence *</label>
                                                        <input type="text" name="sequence" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 PT-5">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Name *</label>
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 PT-5">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Alt Text *</label>
                                                        <input type="text" name="alt_text" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 PT-5">
                                                    <div class="form-wrap p-0">
                                                        <label class="font12 mb-5">Logo (Max 25MB) </label>
                                                        <div class="upload-pic img">
                                                            <input type="hidden" name="logo_hidden" value="">
                                                            <input type="file" id="input-file-now" data-old_input="logo_hidden" class="dropify" name="logo" accept="image/jpg, image/png, , image/svg image/jpeg, image/JPEG , image/SVG" data-allowed-file-extensions="jpg png jpeg JPEG SVG svg" data-max-file-size="25M" />
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
        </div>
    </div>
    <div class="_cl-bottom">
        <button type="submit" class="btn btn-primary mr-2" id="saveClientBtn">Save</button>
        <button id="pl-close" type="submit" class="btn btn-cancel mr-2" id="cancelMainCat">Cancel</button>
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
                    <p>Do you want to delete the client?</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary del_type">Yes</button>
                <button type="button" class="btn btn-cancel cancel_delete_modal" data-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
    <button hidden data-toggle="modal" data-target="#deleteHomeSection" id="hidden_btn_to_open_modal_for_type"></button>
</div>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Our <span>Clients</span></h2>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Clients </span></a></li>
            <li><span>list</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">

                <h2>Client <span>List</span></h2>
                <a id="productlist01" class="btn add_button openDataSidebarForAddingClient"><i class="fa fa-plus"></i>
                    <span>Add New</span></a>
            </div>
            <div style="min-height: 400px" id="tblLoader">
                <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body" style="display: none">
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('/js/custom/client-logo.js')}}"></script>
@endpush