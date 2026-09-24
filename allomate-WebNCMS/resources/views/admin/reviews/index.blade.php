@extends('layouts.app')
@section('content')
<div id="product-cl-sec">
    <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
    <div class="pro-header-text">Review <span>Assignment</span></div>
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div id="floating-label" class="card p-20 top_border mb-3" style="width: 100%">
                                    <h2 class="_head03">Review <span>Assignment</span></h2>
                                    <div class="form-wrap p-0">
                                        <form id="AssignmentForm" method="post">
                                            @csrf
                                            <input type="hidden" name="review_id" class="review_id">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-10">
                                                            <label class="font12 mb-5">Author Name*</label>
                                                            <input type="text" class="form-control required author_name"
                                                                name="author_name">
                                                        </div>
                                                        <div class="col-md-6 mb-10">
                                                            <label class="font12 mb-5">Author Description*</label>
                                                            <input type="text"
                                                                class="form-control required author_description"
                                                                name="author_description">
                                                        </div>
                                                        <div class="col-md-6 mb-10">
                                                            <label class="font12 mb-5">Review Type*</label>
                                                            <div class="form-s2">
                                                                <select
                                                                    class="form-control formselect required review_type"
                                                                    name="review_type" selected
                                                                    placeholder="Select Activity Type"
                                                                    style="width: 100%">
                                                                    {{-- <option value="">Select Review Type</option>
                                                                    --}}
                                                                    <option value="1">General</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-10">
                                                            <label class="font12 mb-5">Rating*</label>
                                                            <input type="text" class="form-control required rating only_decimal_numerics restrict_number"
                                                                name="rating">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="font12 mb-5">User Review*</label>
                                                            <textarea class="proTextarea review_content required"
                                                                rows="6" name="review_content"></textarea>
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
        </div>
    </div>
    <div class="_cl-bottom">
        <button type="submit" class="btn btn-primary saveAssignment mr-2" id="saveAssignment">Save</button>
        <button id="pl-close" type="submit" class="btn btn-cancel mr-2">Cancel</button>
    </div>
</div>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Reviews <span> Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="#"><span>List </span></a></li>
            <li><span>Reviews </span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                {{-- <button type="button" class="btn add_button"><i class="fa fa-plus"></i>
                    <span>Synced Google Reviews</span>
                </button> --}}
                <button type="button" class="btn add_button add-review"><i class="fa fa-plus"></i>
                    <span>Add Review</span>
                </button>
                <h2>Reviews <span>List</span></h2>
            </div>
            <div style="min-height: 400px" class="loader">
                <img src="images/loading.gif" width="30px" height="auto"
                    style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body all_reviews">

            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('js/custom/reviews.js') }}"></script>
@endpush