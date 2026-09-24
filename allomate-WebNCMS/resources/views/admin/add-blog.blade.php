@extends('layouts.app')
@section('content')
    <style>
        .text-form-control {
            border: 1px solid #f6f6f6;
            background-color: #f6f6f6;
            box-shadow: none;
            border-radius: 0;
        }

        .text-form-control input:focus {
            background-color: #f6f6f6 !important;
        }
    </style>


    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Blog <span> Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Add </span></a></li>
                <li><span>Blog </span></li>
            </ol>
        </div>
    </div>
    <input type="hidden" id="b_type" value="{{ @$blog_details->blog_type }}">
    <input type="hidden" id="p_service" value="{{ @$blog_details->blog_category_id }}">
    <form id="SaveBlogForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="blog_id" name="blog_id" value="{{ @$blog_details->id }}">
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="header">
                        <h2>Add <span>Blog Card</span></h2>
                    </div>
                    <div class="body">
                        <div id="floating-label">
                            <div class="form-wrap p-0">
                                <div class="row">
                                    <div class="col-md-8 PB-10">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Blog Title *</label>
                                            <input type="text" name="title" id="title"
                                                value="{{ @$blog_details->title }}" class="form-control blog-required"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 PB-10" style="margin-top:8px;">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Date *</label>
                                            <input type="text" name="blog_date" value="{{ @$blog_details->blog_date }}"
                                                class="form-control datepicker blog-required" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 PB-10 services_row" id="services_row">
                                        <label class="font12 mb-5">Blog Category*</label>
                                        <div class="form-s2">
                                            <select class="form-control services-info formselect blog-required"
                                                name="blog_category_id" id="blog_category_id" style="width: 100%">
                                                <option value="0">Category</option>
                                                @foreach ($blog_categories as $blog_category)
                                                    <option value="{{ $blog_category->id }}"
                                                        {{ @$blog_details->blog_category_id == $blog_category->id ? 'selected' : '' }}>
                                                        {{ $blog_category->service_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-wrap p-0">
                                            <label class="font13 mb-5">Blog Thumbnail (430px X 445px) * </label>
                                            <div class="upload-pic"></div>
                                            <input type="hidden" value="{{ @$blog_details->after_header_image }}"
                                                name="hidden_after_header_image" id="hidden_after_header_image">
                                            <input type="file" id="input-file-now" name="after_header_image"
                                                data-old_input="hidden_after_header_image"
                                                data-default-file="{{ @$blog_details->after_header_image }}"
                                                class="dropify" accept="image/jpg, image/png, image/jpeg, image/JPEG"
                                                data-min-width="429" data-max-width="431" data-min-height="444"
                                                data-max-height="446" data-allowed-file-extensions="jpg png jpeg JPEG" />
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="header">
                        <h2>Add <span>Blog Details *</span></h2>
                    </div>
                    <div class="body">
                        <div class="col-md-12 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Short Description *</label>
                                <input type="text" name="short_description" id="short_description"
                                    value="{{ @$blog_details->short_description }}"
                                    class="form-control blog-required text-form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label mb-10">Long Description *</label>
                            <textarea id="ckeditor">{{ @$blog_details->blog_details }}</textarea>
                        </div>
                    </div>
                    @php
                        $metaTags = @$blog_details->page_meta_tags
                            ? json_decode($blog_details->page_meta_tags, true)
                            : [];
                    @endphp
                    @include('admin.seo-partial.seo', $metaTags)
                </div>
            </div>

            <div class="col-6">
                <div class="form-wrap p-0">
                    <label class="font13 mb-5">Slug *</label>
                    <input class="form-control blog-required" type="text" id="blog-slug" name="slug"
                        value="{{ @$blog_details->slug }}" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-wrap p-0">
                    <label class="font13 mb-5">Tags</label>
                    <input class="form-control" type="text" id="blog-tags" name="tags"
                        value="{{ @$blog_details->tags }}" />
                </div>
            </div>

            <div class="col-md-12 text-center PT-15">
                <button type="button" class="btn btn-primary mr-2 save-blog" id="save-blog">Save</button>
                <a href="/admin/blogs" type="button" class="btn btn-cancel cancel-blog" id="cancel-blog">Cancel</a>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('js/custom/blogs.js') }}"></script>
@endpush
