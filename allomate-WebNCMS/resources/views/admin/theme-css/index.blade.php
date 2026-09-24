@extends('layouts.app')
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">{{$header}} <span> CSS Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Add </span></a></li>
                <li><span>{{$header}} </span></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <form id="ThemeCssForm" enctype="multipart/form-data" class="" style="width:100%">
            @csrf
            <input type="hidden" value="{{ @$data->id }}" name="content_id">
            <input type="hidden" value="{{$type}}" name="content_type">
            <div class="col-12 mb-30">
                <div class="card pt-5">
                    <div class="header">
                        <h2>Add <span>CSS</span></h2>
                    </div>
                    <div class="body">

                        <div id="floating-label">
                            <div class="form-wrap p-0">

                                <div class="row">
                                    <div class="col-md-12 PB-10">
                                        <label class="font12">Content *</label>
                                        <textarea class="proTextarea required" rows="12" name="content">{{ @$data->content }}</textarea>
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
    <script src="{{ asset('js/custom/theme-css.js') }}"></script>
@endpush
