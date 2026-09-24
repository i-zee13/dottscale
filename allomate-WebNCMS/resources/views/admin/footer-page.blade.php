@extends('layouts.app')
@section('content')
    <style>
        .custom-btn-style {
            background-color: #e20000;
            color: white;
            border-color: #e20000;
            margin-top: 20px;
            /* If you want to match the border color with the background color */
        }

        .form-wrap textarea {
            border-radius: 6px !important;
        }

        .select2-container--default .select2-results__option[role=group] {
            padding: 0;
            background: #f6f6f6;
            font-size: 12px !important;
        }
    </style>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Footer <span> Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Add </span></a></li>
                <li><span>Footer </span></li>
            </ol>
        </div>
    </div>
    <input type="hidden" value="{{ json_encode($pages) }}" id="pages_data">
    <input type="hidden" value="{{ json_encode($new_pages_cat) }}" id="pages_cat_data">
    <input type="hidden" value="{{ json_encode($record) }}" id="footer-records">
    <form id="SaveAboutUsForm" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card">
                    <div class="header">
                        <h2>Footer <span>Menus</span></h2>
{{--                        <button type="button" class="btn add_button new_block"><i class="fa fa-plus"></i>--}}
{{--                            <span> New Menu</span></button>--}}
                    </div>
                    <div class="body">
                        <div class="form-wrap p-0">
                            <div class="row pt-0">
                                <div class="col-md-12">
                                    <div style="min-height: 100px" id="tblLoader">
                                        <img src="/images/loader.gif" width="30px" height="auto"
                                            style="position: absolute; left: 50%; top: 45%;">
                                    </div>
                                    <div class="footer-box" style="display: none;">
                                        <div class="row div-remove">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Header Title *</label>
                                                    <input type="text" class="form-control required_field" placeholder=""
                                                        name="location_name">
                                                </div>
                                            </div>
                                            <div class="col-6 mt-5">
                                                <label class="font12 mb-5">Page Link *</label>
                                                <div class="form-s2 mb-5">
                                                    <select name="page_link" id="testing"
                                                        class="reports-select multi menu-required" multiple="multiple">
                                                        <option value="" selected> Select Page Link </option>
                                                        @if (collect($new_pages_cat)->count() > 0)
                                                            @foreach ($new_pages_cat as $pagec)
                                                                <option value="{{ $pagec->url }}">
                                                                    {{ $pagec->title }}</option>
                                                            @endforeach
                                                        @endif
                                                        @foreach ($pages as $page)
                                                            <option value="{{ $page->url }}">{{ $page->title }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Subscribe Section --}}

            {{-- Menu Section --}}

            <div class="col-md-12 text-center PT-15">
                <button type="button" class="btn btn-primary mr-2 save-static" id="save-static">Update</button>
            </div>
        </div>
    </form>


@endsection
@push('js')
    <script src="{{ asset('/admin/js/fSelect.js') }}"></script>
    <script src="{{ asset('/js/custom/footer-page.js') }}"></script>
    <script>
        $(function() {
            window.fs_test = $('.multi').fSelect();
        });
    </script>
@endpush
