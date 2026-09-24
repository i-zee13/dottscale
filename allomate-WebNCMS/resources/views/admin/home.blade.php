@extends('layouts.app')
@section('content')

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Home <span> Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Add </span></a></li>
            <li><span>Content </span></li>
        </ol>
    </div>
</div>

<div class="row">
    <form id="form" enctype="multipart/form-data" class="">
        @csrf
        <input type="hidden" value="{{$data !=null ? $data->id : ''}}" name="id">

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
                                        <label class="control-label mb-10">Heading 1 *</label>
                                        <input type="text" id="" class="form-control req" placeholder="" name="heading_1" value="{{$data!=null ?  $data->heading_1 : ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Heading 2 *</label>
                                        <input type="text" id="" class="form-control req" placeholder="" name="heading_2" value="{{$data!=null ? $data->heading_2 : ''}}">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Add Desktop Image (1920x1080) *</label>
                                        <div class="upload-pic"></div>
                                        <input type="hidden" name="hidden_desktop_img" value="{{$data !='' ? $data->desktop_img : ''}}">
                                        <input type="file" id="input-file-now" name="desktop_img" data-default-file="/storage/{{$data !='' ? $data->desktop_img : ''}}" class="dropify " data-old_input="hidden_desktop_img" accept="images/*" data-allowed-file-extensions="jpg png jpeg JPEG" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Add Tab Image (1024 x 1366) *</label>
                                        <div class="upload-pic"></div>
                                        <input type="hidden" name="hidden_tab_img" value="{{$data !='' ? $data->tab_img : ''}}">
                                        <input type="file" id="input-file-now" name="tab_img" data-default-file="/storage/{{$data !='' ? $data->tab_img : ''}}" class="dropify " data-old_input="hidden_tab_img" accept="images/*" data-allowed-file-extensions="jpg png jpeg JPEG" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Add Mobile Image (480x853) *</label>
                                        <div class="upload-pic"></div>
                                        <input type="hidden" name="hidden_mobile_img" value="{{$data !='' ? $data->mobile_img : ''}}">
                                        <input type="file" id="input-file-now" name="mobile_img" data-default-file="/storage/{{$data !='' ? $data->mobile_img : ''}}" class="dropify " data-old_input="hidden_mobile_img" accept="images/*" data-allowed-file-extensions="jpg png jpeg JPEG" />
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
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Large Heading *</label>
                                        <input type="text" id="" class="form-control req" placeholder="" name="large_heading" value="{{$data ? $data->large_heading : ''}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="font12">Paragraph *</label>
                                    <textarea class="proTextarea req" rows="6" name="paragraph">{{$data!=null ?  $data->paragraph : ''}}</textarea>
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
                    <h2>Section <span>3</span></h2>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Award Heading *</label>
                                        <input type="text" id="" class="form-control req" placeholder="" name="award_heading" value="{{$data ? $data->award_heading : ''}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Add Award Image (1920x1080) *</label>
                                        <div class="upload-pic"></div>
                                        <input type="hidden" name="hidden_award_img" value="{{$data !='' ? $data->award_img : ''}}">
                                        <input type="file" id="input-file-now" name="award_img" data-default-file="/storage/{{$data !='' ? $data->award_img : ''}}" class="dropify " data-old_input="hidden_award_img" accept="images/*" data-allowed-file-extensions="jpg png jpeg JPEG" />
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
                                        <input type="hidden" name="hidden_og_image" value="{{@$data->meta_og_image}}">
                                        <input type="file" id="meta_og_image" name="meta_og_image" data-default-file="/storage/{{@$data->meta_og_image !='' ? $data->meta_og_image : ''}}" class="dropify " data-old_input="hidden_og_image" accept="image/*" />
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
            <button type="button" class="btn btn-primary mr-2 save_form">Save</button>
        </div>
    </form>
</div>

@endsection
@push('js')
<script src="{{asset('js/custom/home.js')}}">
</script>

@endpush