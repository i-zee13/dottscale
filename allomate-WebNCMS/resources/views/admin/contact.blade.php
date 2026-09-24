@extends('layouts.app')
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Contact <span>Us Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Add </span></a></li>
                <li><span>Content </span></li>
            </ol>
        </div>
    </div>
    <form id="SaveContactForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="contact_id" name="contact_id" value="{{@$all_records->id}}">
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="header">
                        <h2>Add <span>Header Content</span></h2>
                    </div>
                    <div class="body">
                        <div id="floating-label">
                            <div class="form-wrap p-0">
                                <div class="row">
                                    <div class="col-md-6 PB-10">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Heading 1</label>
                                            <input type="text" id="heading_one" name="heading_one" value="{{@$all_records->heading_one}}" class="form-control contact-required" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 PB-10">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Heading 2</label>
                                            <input type="text" id="heading_two" name="heading_two" value="{{@$all_records->heading_two}}" class="form-control contact-required" placeholder="">
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
                        <h2>Section <span>2</span></h2>
                    </div>
                    <div class="body">
                        <div id="floating-label">
                            <div class="form-wrap p-0">
                                <div class="row">
                                    <div class="col-md-6 PT-5">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Large Heading 1</label>
                                            <input type="text" id="large_heading_one" name="large_heading_one" value="{{@$all_records->large_heading_one}}" class="form-control contact-required" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="font12 mb-5">Paragraph</label>
                                        <textarea class="proTextarea contact-required" rows="6" name="large_paragraph_one" 
                                        id="large_paragraph_one">{{@$all_records->large_paragraph_one}}</textarea>
                                    </div>
                                    <div class="col-md-6 PT-5">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Large Heading 2</label>
                                            <input type="text" id="large_heading_two" name="large_heading_two" value="{{@$all_records->large_heading_two}}"
                                             class="form-control contact-required" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="font12 mb-5">Paragraph</label>
                                        <textarea class="proTextarea contact-required" rows="6" 
                                        id="large_paragraph_two" name="large_paragraph_two">{{@$all_records->large_paragraph_two}}</textarea>
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
                        <h2>Add <span>Meta Details</span></h2>
                    </div>
                    <div class="body">
                        <div id="floating-label">
                            <div class="form-wrap p-0">
                                <div class="row">
                                    <input type="hidden" id="meta_name_author"  value="author" class="form-control" placeholder="" name="meta_name_author">
                                    <input type="hidden" id="meta_name_keywords" value="keyword" class="form-control" placeholder="" name="meta_name_keywords">
                                    <input type="hidden" id="meta_name_description" value="description" class="form-control" placeholder="" name="meta_name_description">
                                    <div class="col-md-4 PB-10">
                                        <label class="font12">Meta Content (Author)</label>
                                        <textarea class="proTextarea" rows="2" id="meta_content_author" name="meta_content_author">{{@$meta_content_author}}</textarea>
                                        
                                    </div>
                                    <div class="col-md-4 PB-10">
                                        <label class="font12">Meta Content (Keywords)</label>
                                        <textarea class="proTextarea" rows="2" id="meta_content_keywords" name="meta_content_keywords">{{@$meta_content_keywords}}</textarea>
                                    </div>
                                    <div class="col-md-4 PB-10">
                                        <label class="font12">Meta Content (Description)</label>
                                        <textarea class="proTextarea" rows="2" id="meta_content_description" name="meta_content_description">{{@$meta_content_description}}</textarea>
                                    </div>
                                    <div class="col-md-4 PB-10">
                                            <label class="font12">OG Title</label>
                                            <textarea class="proTextarea" rows="2" id="meta_og_title" name="meta_og_title">{{@$meta_og_title}}</textarea>
                                    </div>
                                    <div class="col-md-8 PB-10">
                                        <label class="font12">OG Description</label>
                                        <textarea class="proTextarea" rows="2" id="meta_og_description" name="meta_og_description">{{@$meta_og_description}}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-wrap p-0">
                                            <label class="font13 mb-5">OG Image</label>
                                            <div class="upload-pic"></div>
                                            <input type="hidden" name="hidden_og_image" value="{{@$all_records->meta_og_image}}">
                                            <input type="file" id="meta_og_image" name="meta_og_image" data-default-file="/storage/{{$all_records->meta_og_image !='' ? $all_records->meta_og_image : ''}}" class="dropify " data-old_input="hidden_og_image" accept="image/*" />
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 PB-10">
                                            <label class="font12">OG Image</label>
                                            <textarea class="proTextarea" rows="2" id="meta_og_image" name="meta_og_image">{{@$meta_og_image}}</textarea>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center PT-15">
                <button type="button" class="btn btn-primary mr-2 save-contact" id="save-contact">Save</button>
                <button type="button" class="btn btn-cancel cancel-contact" id="cancel-contact">Cancel</button>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ mix('js/custom/get-in-touch.js') }}"></script>
@endpush
