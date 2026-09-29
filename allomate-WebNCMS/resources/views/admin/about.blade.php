@extends('layouts.app')
@section('content')
@php $hasData = !empty($data); @endphp
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">About <span>Us Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Website Pages</span></a></li>
            <li><span>About Us</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <form id="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $hasData ? $data->id : '' }}">
        <input type="hidden" id="meta_name_author" name="meta_name_author" value="author">
        <input type="hidden" id="meta_name_keywords" name="meta_name_keywords" value="keyword">
        <input type="hidden" id="meta_name_description" name="meta_name_description" value="description">

        <div class="col-12 mb-30">
            <div class="card">
                <div class="header"><h2>Hero <span>Section</span></h2></div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading *</label>
                                <input type="text" class="form-control required" name="heading_1" value="{{ $hasData ? $data->heading_1 : '' }}">
                            </div>
                        </div>
                        <div class="col-md-12 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Paragraph *</label>
                                <textarea class="proTextarea required" rows="3" name="heading_2">{{ $hasData ? $data->heading_2 : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">CTA Text</label>
                                <input type="text" class="form-control" name="cta_text" value="{{ $hasData ? $data->cta_text : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-30">
            <div class="card">
                <div class="header"><h2>Our <span>Story</span></h2></div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Eyebrow</label><input type="text" class="form-control" name="story_eyebrow" value="{{ $hasData ? $data->story_eyebrow : '' }}"></div></div>
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Heading</label><input type="text" class="form-control" name="story_heading" value="{{ $hasData ? $data->story_heading : '' }}"></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Paragraph 1</label><textarea class="proTextarea" rows="3" name="story_p1">{{ $hasData ? $data->story_p1 : '' }}</textarea></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Paragraph 2</label><textarea class="proTextarea" rows="3" name="story_p2">{{ $hasData ? $data->story_p2 : '' }}</textarea></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Belief Title</label><input type="text" class="form-control" name="belief_title" value="{{ $hasData ? $data->belief_title : '' }}"></div></div>
                        <div class="col-md-8 PB-10"><div class="form-group"><label class="control-label mb-10">Belief Text</label><input type="text" class="form-control" name="belief_text" value="{{ $hasData ? $data->belief_text : '' }}"></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Direction Title</label><input type="text" class="form-control" name="direction_title" value="{{ $hasData ? $data->direction_title : '' }}"></div></div>
                        <div class="col-md-8 PB-10"><div class="form-group"><label class="control-label mb-10">Direction Text</label><input type="text" class="form-control" name="direction_text" value="{{ $hasData ? $data->direction_text : '' }}"></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Promise Title</label><input type="text" class="form-control" name="promise_title" value="{{ $hasData ? $data->promise_title : '' }}"></div></div>
                        <div class="col-md-8 PB-10"><div class="form-group"><label class="control-label mb-10">Promise Text</label><input type="text" class="form-control" name="promise_text" value="{{ $hasData ? $data->promise_text : '' }}"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-30">
            <div class="card">
                <div class="header"><h2>Core <span>Values / Process / Why</span></h2></div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Values Heading</label><input type="text" class="form-control" name="values_heading" value="{{ $hasData ? $data->values_heading : '' }}"></div></div>
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Values Intro</label><input type="text" class="form-control" name="values_intro" value="{{ $hasData ? $data->values_intro : '' }}"></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Values JSON</label><textarea class="form-control" rows="4" name="values_json">{{ $hasData ? $data->values_json : '' }}</textarea></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Process Eyebrow</label><input type="text" class="form-control" name="process_eyebrow" value="{{ $hasData ? $data->process_eyebrow : '' }}"></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Process Heading</label><input type="text" class="form-control" name="process_heading" value="{{ $hasData ? $data->process_heading : '' }}"></div></div>
                        <div class="col-md-4 PB-10"><div class="form-group"><label class="control-label mb-10">Process CTA</label><input type="text" class="form-control" name="process_cta" value="{{ $hasData ? $data->process_cta : '' }}"></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Process Intro</label><textarea class="proTextarea" rows="2" name="process_intro">{{ $hasData ? $data->process_intro : '' }}</textarea></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Process JSON</label><textarea class="form-control" rows="4" name="process_json">{{ $hasData ? $data->process_json : '' }}</textarea></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Why Heading</label><input type="text" class="form-control" name="why_heading" value="{{ $hasData ? $data->why_heading : '' }}"></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Why JSON</label><textarea class="form-control" rows="4" name="why_json">{{ $hasData ? $data->why_json : '' }}</textarea></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-30">
            <div class="card">
                <div class="header"><h2>SEO <span>Meta</span></h2></div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Meta Author</label><input type="text" class="form-control" id="meta_content_author" value="{{ $meta_content_author ?? '' }}"></div></div>
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">Meta Keywords</label><input type="text" class="form-control" id="meta_content_keywords" value="{{ $meta_content_keywords ?? '' }}"></div></div>
                        <div class="col-md-12 PB-10"><div class="form-group"><label class="control-label mb-10">Meta Description</label><textarea class="form-control" rows="2" id="meta_content_description">{{ $meta_content_description ?? '' }}</textarea></div></div>
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">OG Title</label><input type="text" class="form-control" id="meta_og_title" value="{{ $meta_og_title ?? '' }}"></div></div>
                        <div class="col-md-6 PB-10"><div class="form-group"><label class="control-label mb-10">OG Description</label><input type="text" class="form-control" id="meta_og_description" value="{{ $meta_og_description ?? '' }}"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-30">
            <button type="button" class="btn btn-primary save_form">Save About Us</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/custom/aboutus.js') }}"></script>
@endsection
