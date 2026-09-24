@extends('layouts.app')

<style>
    .pt-7 {
        padding-top: 7px !important
    }

    .mb-4 {
        margin-bottom: 4px !important
    }

    .font11 {
        font-size: 11px !important
    }

    .headingDB {
        padding: 15px 20px !important;
        margin-left: -5px
    }

    .tablelist {
        font-size: 12px;
    }

    .tablelist th {
        background-color: #f6f6f6;
        font-size: 13px;
    }

    .tablelist th,
    .tablelist td {
        padding: 5px;
    }

    .tablelist td {
        border-bottom: solid 1px #f0f0f0
    }

    .addlocation {
        width: 100%;
        border-radius: 0;
        letter-spacing: 1px;
        line-height: 1;
    }

    .addlocation:hover,
    .addlocation:focus {
        background: linear-gradient(90deg, #2f4a70 0%, #2f4a70 100%);
        color: #fff
    }

    .subheading {
        font-size: 16px;
        padding-bottom: 5px;
        margin-bottom: 5px;
        margin-top: 15px;
        border-bottom: solid 1px #e7e7e7
    }

    .closebtn {
        padding: 10px;
        outline: none;
        font-size: 30px;
        float: right;
        margin-top: -5px;
    }

    .closebtn:focus {
        outline: none !important
    }
</style>

@section('content')
    <div id="blureEffct" class="container-fluid">
        <div class="overlay-blure"></div>
        <div class="container">
            <form id="form" enctype="multipart/form-data" class="">
                @csrf
                <input type="hidden" value="{{ @$career->id }}" name="hidden_id" class="career_id">

                <div class="row mt-2 mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h2 class="_head01">Job <span> Management</span></h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><span>Job</span></a></li>
                            <li><span>Add</span></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card mb-30">
                            <div class="header">
                                <h2>Job <span> Details</span></h2>
                            </div>
                            <div class="body PT-15">
                                <div id="floating-label">
                                    <div class="form-wrap p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Title *</label>
                                                    <input type="text" name="title" id="title"
                                                        class="form-control career-required" placeholder=""
                                                        value="{{ @$career->title }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Location *</label>
                                                    <input type="text" name="location" id="location"
                                                        class="form-control career-required" placeholder=""
                                                        value="{{ @$career->location }}" />
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 PT-10 PB-10">
                                                        <div class="form-wrap p-0">
                                                            <label class="font12 mb-5">Thumbnail (650 x 450) *</label>
                                                            <div class="upload-pic"></div>
                                                            <div class="img">
                                                                <input type="hidden" name="hidden_thumbnail" value="{{ @$career != '' ? @$career->thumbnail : '' }}">
                                                                <input type="file" id="input-file-now" data-default-file="/storage/{{ @$career != '' ? @$career->thumbnail : '' }}" class="dropify" name="thumbnail" data-old_input="hidden_thumbnail" accept="image/*" data-allowed-file-extensions="jpg png jpeg JPEG" data-min-width="649" data-max-width="651" data-min-height="449" data-max-height="451" />
                                                            </div>
                                                        </div>
                                                    </div> -->
                                            <div class="col-md-12 pt-7">
                                                <label class="font12 mb-10">Description *</label>
                                                <textarea id="ckeditor">{{ @$career->description }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @php
                                $metaTags = @$career->page_meta_tags ? json_decode($career->page_meta_tags, true) : [];
                            @endphp
                            @include('admin.seo-partial.seo', $metaTags)
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end pt-5">
                        <button type="button" class="btn btn-primary mr-2 save_form">Save</button>
                        <a href="/admin/jobs" class="btn btn-cancel save_form">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/custom/careers.js') }}"></script>
@endpush
