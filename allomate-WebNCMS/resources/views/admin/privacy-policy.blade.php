@extends('layouts.app')
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Privacy Policy <span> Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Add </span></a></li>
                <li><span>Privacy Policy </span></li>
            </ol>
        </div>
    </div>
    <form id="SavePrivacyForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="static_id" name="static_id" value="{{ @$privacy->id }}">
        <input type="hidden" id="page_id" value="1" name="page_id">
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="header">
                        <h2>Add <span>Details *</span></h2>
                    </div>
                    <div class="body">
                        {{-- <div
                            style="padding:50px; font-size: 25px; opacity: 0.5; background-color: rgb(233, 233, 233); text-align: center;
                    display: block; height:400px;">
                            Text Editor Here...</div> --}}
                        {{-- <textarea name="editor_value" id="editor_value_id"></textarea> --}}
                        <textarea id="ckeditor">{{ @$privacy->document }}</textarea>
                    </div>
                    @php
                        $metaTags = @$privacy->page_meta_tags ? json_decode($privacy->page_meta_tags, true) : [];
                    @endphp
                    @include('admin.seo-partial.seo', $metaTags)
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end pt-5">
                <button type="button" class="btn btn-primary mr-2 save-static" id="save-static">Save</button>
            </div>

        </div>
    </form>
@endsection
@push('js')
    <script src="{{ mix('js/custom/static-pages.js') }}"></script>
@endpush
