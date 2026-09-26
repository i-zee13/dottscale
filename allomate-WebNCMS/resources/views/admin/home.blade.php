@extends('layouts.app')
@section('content')

@php
    $hasData = !empty($data);
    $imgUrl = function ($path) {
        if (empty($path)) {
            return '';
        }
        if (str_starts_with($path, 'http') || str_starts_with($path, '/')) {
            return $path;
        }
        return '/storage/' . ltrim($path, '/');
    };
@endphp

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Home <span>Page Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Website Pages</span></a></li>
            <li><span>Home</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <form id="form" enctype="multipart/form-data" class="">
        @csrf
        <input type="hidden" value="{{ $hasData ? $data->id : '' }}" name="id">

        {{-- Hero Section --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header">
                    <h2>Hero <span>Section</span></h2>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <div class="col-md-12 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Hero Heading *</label>
                                        <input type="text" class="form-control req" name="heading_1"
                                            placeholder="We Build Digital Systems That Grow Businesses"
                                            value="{{ $hasData ? $data->heading_1 : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Hero Paragraph *</label>
                                        <textarea class="proTextarea req" rows="4" name="heading_2"
                                            placeholder="From FMCG to PropTech to eCommerce...">{{ $hasData ? $data->heading_2 : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Desktop Banner (1504 x 579) *</label>
                                        <input type="hidden" name="hidden_desktop_img"
                                            value="{{ $hasData ? $data->desktop_img : '' }}">
                                        <input type="file" name="desktop_img" class="dropify"
                                            data-old_input="hidden_desktop_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->desktop_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1503" data-max-width="1505"
                                            data-min-height="578" data-max-height="580" />
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Tablet Banner (1024 x 394) *</label>
                                        <input type="hidden" name="hidden_tab_img"
                                            value="{{ $hasData ? $data->tab_img : '' }}">
                                        <input type="file" name="tab_img" class="dropify"
                                            data-old_input="hidden_tab_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->tab_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1023" data-max-width="1025"
                                            data-min-height="393" data-max-height="395" />
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Mobile Banner (480 x 768) *</label>
                                        <input type="hidden" name="hidden_mobile_img"
                                            value="{{ $hasData ? $data->mobile_img : '' }}">
                                        <input type="file" name="mobile_img" class="dropify"
                                            data-old_input="hidden_mobile_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->mobile_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="479" data-max-width="481"
                                            data-min-height="767" data-max-height="769" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header">
                    <h2>About <span>Section</span></h2>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <div class="col-md-12 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">About Heading *</label>
                                        <input type="text" class="form-control req" name="large_heading"
                                            placeholder="Driven by Real Business Impact"
                                            value="{{ $hasData ? $data->large_heading : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <label class="font12">About Paragraph *</label>
                                    <textarea class="proTextarea req" rows="5" name="paragraph"
                                        placeholder="We are not here to sell code...">{{ $hasData ? $data->paragraph : '' }}</textarea>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">CTA Button Text *</label>
                                        <input type="text" class="form-control req" name="award_heading"
                                            placeholder="Learn More About Us"
                                            value="{{ $hasData ? $data->award_heading : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">About Image (1000 x 1000) *</label>
                                        <input type="hidden" name="hidden_award_img"
                                            value="{{ $hasData ? $data->award_img : '' }}">
                                        <input type="file" name="award_img" class="dropify"
                                            data-old_input="hidden_award_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->award_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="999" data-max-width="1001"
                                            data-min-height="999" data-max-height="1001" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Meta Content --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header">
                    <h2>SEO <span>Meta Details</span></h2>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <input type="hidden" id="meta_name_author" value="author" name="meta_name_author">
                                <input type="hidden" id="meta_name_keywords" value="keyword" name="meta_name_keywords">
                                <input type="hidden" id="meta_name_description" value="description" name="meta_name_description">
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Author)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_author" name="meta_content_author">{{ @$meta_content_author }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Keywords)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_keywords" name="meta_content_keywords">{{ @$meta_content_keywords }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Description)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_description" name="meta_content_description">{{ @$meta_content_description }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">OG Title</label>
                                    <textarea class="proTextarea" rows="2" id="meta_og_title" name="meta_og_title">{{ @$meta_og_title }}</textarea>
                                </div>
                                <div class="col-md-8 PB-10">
                                    <label class="font12">OG Description</label>
                                    <textarea class="proTextarea" rows="2" id="meta_og_description" name="meta_og_description">{{ @$meta_og_description }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">OG Image (1200 x 630)</label>
                                        <input type="hidden" name="hidden_og_image" value="{{ $hasData ? $data->meta_og_image : '' }}">
                                        <input type="file" id="meta_og_image" name="meta_og_image" class="dropify"
                                            data-old_input="hidden_og_image"
                                            data-default-file="{{ $imgUrl($hasData ? $data->meta_og_image : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1199" data-max-width="1201"
                                            data-min-height="629" data-max-height="631" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center PT-15">
            <button type="button" class="btn btn-primary mr-2 save_form">Save</button>
        </div>
    </form>
</div>

@endsection
@push('js')
<script src="{{ asset('js/custom/home.js') }}"></script>
@endpush
