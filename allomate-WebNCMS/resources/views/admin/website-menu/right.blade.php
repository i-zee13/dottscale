@extends('layouts.app')
@section('content')
<style>
    .select2-results__group{
        font-size: 13.5px !important;
    }
    .select2-results__option{
        font-size: 12.5px !important;
    }
    .custom-control-label::after {
        background-color: #012038 !important;
        box-shadow: 0 0 0 1px #002038 !important;
    }

    .sortable-moves {
        font-size: 13px !important;
        padding: 0px 15px 0px 0px !important;
        list-style-type: none !important;
        position: relative !important;
        cursor: move !important;
        margin: 15px 0 !important;
    }

    .sortable-moves:hover {
        background-image: url(images/sort-up-down.svg) !important;
        background-repeat: no-repeat !important;
        background-position: right 9px !important;
        background-size: 24px !important;
    }

    .editListPO,
    .editListPO:focus,
    .editListPO:HOVER {
        left: -38px !important;
    }

    .delListPO,
    .delListPO:focus,
    .delListPO:HOVER {
        left: -7px !important;
    }

    .PackagingOption {
        box-shadow: none !important;
        border: solid 1px #e8e8e8 !important;
    }

    .PackagingOption strong {
        padding-right: 20px !important;
    }

    .PageCheckbox>label {
        line-height: 25px !important;
    }

    .add-deal-sec {
        margin-top: 0px !important;
        padding: 5px 10px !important;
        letter-spacing: 1px !important;
        font-size: 13px !important;
    }

    .editListPO,
    .editListPO:focus,
    .editListPO:HOVER {
        width: 24px !important;
    }

    .submenutitle {
        padding-bottom: 5px !important;
        margin-bottom: 3px !important;
    }

    .addsub-menu-div {
        padding: 15px !important;
        margin-top: 0px !important;
        margin-bottom: 15px !important;
    }

    .w-color-sec {
        background-color: #fff
    }

    .w-color-sec #floating-label .form-control {
        background-color: #f6f6f6 !important;
        border: solid 1px #f6f6f6 !important;
    }

    .input-style {
        border: solid 1px #e4e4e4 !important;
        box-shadow: none !important;
        height: 32px !important;
        font-size: 14px !important;
    }

    .custom-select-sm {
        font-size: 14px !important;
        border-radius: 0 !important;
        border: solid 1px #e4e4e4 !important;
        box-shadow: none !important;
        height: 32px !important;
    }

    .editListPO,
    .editListPO:focus,
    .editListPO:HOVER,
    .delListPO,
    .editListPO,
    .delListPO:focus,
    .delListPO:HOVER {
        top: 3px !important;
    }

    .red-bg {
        border-color: #f12300 !important
    }

    .submenu-link {
        background-color: #eff2f3 !important;
        padding: 10px !important;
        margin-top: 10px !important;
    }

    .submenu-link:hover {
        background-color: #f7f7f7 !important;
        box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 20%) !important;
    }

    .addPackagingOption {
        background-color: #f6f6f6 !important;
        padding: 10px 0px 0px 10px !important;
        margin-top: 0 !important;
    }

    .add-sub-m {
        padding: 5px 5px 4px 5px !important;
        font-size: 14px !important;
        line-height: 1 !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e4e4e4;
        border-radius: 0px;
    }

    .select2-container .select2-selection--single {
        height: 32px;
    }

    .formSelect {
        width: 100% !important;
    }
</style>
<link rel="stylesheet" href="{{ asset('/css/fSelect.css') }}">
<link rel="stylesheet" href="{{ asset('/admin/css/product.css') }}">
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Menu<span> Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="#"><span>Menu</span></a></li>
            <li><span>Add </span></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-6">
                        <h2 class="_head03 font18 border-0 pb-0 new_block">Right <span>Menu</span></h2>
                    </div>
                    {{--- <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary add-deal-sec m-0 new_block"><i
                                    class="fa fa-plus"></i> Add
                                Menu</button>
                        </div> ---}}
                </div>
            </div>
            <div class="body">
                <input type="hidden" value="{{ json_encode($pages) }}" id="pages_data">
                <input type="hidden" value="{{ json_encode($new_pages_cat) }}" id="pages_cat_data">
                <input type="hidden" value="{{ json_encode($record) }}" id="menu-records">
                <div class="col-md-12 p-0 menu-row sortable" id="">
                    @if (@$record)
                    <div class="sortable-moves singleMenu delete_row_1" id="1">
                        <div class="col-12">
                            <div class="PackagingOption first_tier mb-0">
                                <div class="row"> 
                                    <div class="col pr-0">
                                        <input type="text" class="form-control input-style" placeholder="Add menu title" value="{{$record['main_titles'][0]}}" name="menu_title" id="tier_one_title_1">
                                    </div>

                                    <div class="col-auto position-relative">
                                        <button type="button" class="btn editListPO" data-toggle="collapse" data-target="#subMenu_Right_1" aria-expanded="false" aria-controls="subMenu_Right_1" title=""><i class="fa fa-angle-down"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="subMenu_Right_1">
                                <div class="addPackagingOption">
                                    <div class="row">
                                        <div class="col-12 position-relative PB-20 newSecondTierPlace sortable">
                                            <div class="row m-0">
                                                <div class="col mt-auto mb-auto pl-0">
                                                    <strong class="font16"> Right Menu 1</strong>
                                                </div>
                                                <div class="col-auto new_second_tier"><button type="submit" class="btn btn-primary add-sub-m"><i class="fa fa-plus"></i></button></div>
                                            </div>
                                            @if ($record['structuredData'])
                                                @foreach ($record['structuredData'] as $sub_menu) 
                                                    @if($sub_menu['type'] == 1)
                                                        @php
                                                        $length = rand(8, 10);
                                                        $uniqueKey = str_pad(
                                                        rand(0, (int) pow(10, $length) - 1),
                                                        $length,
                                                        '0',
                                                        STR_PAD_LEFT,
                                                        );
                                                        $length = rand(8, 9);
                                                        $collapse_id = str_pad(
                                                        rand(0, (int) pow(10, $length) - 1),
                                                        $length,
                                                        '0',
                                                        STR_PAD_LEFT,
                                                        );
                                                        @endphp
                                                        
                                                        <div class="sortable-moves   secondTierIterate delete_row_{{ $uniqueKey }}">
                                                            <div class="col-12 ">
                                                                <div class="PackagingOption second_tier mb-0 " style="background-color: #ebebeb;">
                                                                    <div class="row  ">
                                                                        <div class="col-4 pr-0 ">
                                                                        <select class="custom-select custom-select-sm menuSelect formselect" style="width: 100%!important;">
                                                                            <option value="">Select Menu</option>
                                                                            
                                                                            @foreach ($pages as $page) 
                                                                                <option value="{{ $page->url }}" {{ $page->url == $sub_menu['url'] ? 'selected' : '' }}>
                                                                                    {{ $page->title }}
                                                                                </option> 
                                                                            @endforeach

                                                                            @foreach ($new_pages_cat as $category => $new_pages)
                                                                                <optgroup label="{{ $category }}">
                                                                                    @foreach ($new_pages as $new_page)
                                                                                        <option value="{{ $new_page['url'] }}" {{ $new_page['url'] == $sub_menu['url'] ? 'selected' : '' }}>
                                                                                            {{ $new_page['title'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </optgroup>
                                                                            @endforeach
                                                                        </select>
                                                                        </div>
                                                                        <div class="col pr-0">
                                                                            <input type="text" class="form-control input-style " name="title" value="{{ $sub_menu['title'] }}" id="tier_two_title_{{ $uniqueKey }}" placeholder="title here">
                                                                        </div>
                                                                        <div class="col pr-0"><input type="text" class="form-control input-style" name="url" value="{{ $sub_menu['url'] }}" id="tier_two_url_{{ $uniqueKey }}" placeholder="url here.."></div>
                                                                        <div class="col-3" style="padding-top:5px">
                                                                            <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                                                                <input type="checkbox" name="new_window" class="custom-control-input" value="{{ $sub_menu['new_window'] }}" id="tier_two_new_window_{{ $uniqueKey }}" {{ $sub_menu['new_window'] ? 'checked' : '' }}>
                                                                                <label class="custom-control-label" for="tier_two_new_window_{{ $uniqueKey }}">New
                                                                                    Window ?</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-auto position-relative">
                                                                            <button type="button" id="{{ $uniqueKey }}" class="btn delListPO delete_row" title="Delete"><i class="fa fa-trash-alt"></i></button>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="sortable-moves singleMenu delete_row_2" id="2">
                        <div class="col-12">
                            <div class="PackagingOption first_tier mb-0">
                                <div class="row"> 
                                    <div class="col pr-0">
                                        <input type="text" class="form-control input-style" placeholder="Add menu title" value="{{$record['main_titles'][1]}}" name="menu_title" id="tier_one_title_2">
                                    </div>

                                    <div class="col-auto position-relative">
                                        <button type="button" class="btn editListPO" data-toggle="collapse" data-target="#subMenu_Right_2" aria-expanded="false" aria-controls="subMenu_Right_2" title=""><i class="fa fa-angle-down"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="subMenu_Right_2">
                                <div class="addPackagingOption">
                                    <div class="row">
                                        <div class="col-12 position-relative PB-20 newSecondTierPlace sortable">
                                            <div class="row m-0">
                                                <div class="col mt-auto mb-auto pl-0">
                                                    <strong class="font16"> Right Menu 2</strong>
                                                </div>
                                                <div class="col-auto new_second_tier"><button type="submit" class="btn btn-primary add-sub-m"><i class="fa fa-plus"></i></button></div>
                                            </div>
                                            @if ($record['structuredData'])
                                                @foreach ($record['structuredData'] as $sub_menu) 
                                                    @if($sub_menu['type'] == 2)
                                                        @php
                                                        $length = rand(8, 10);
                                                        $uniqueKey = str_pad(
                                                        rand(0, (int) pow(10, $length) - 1),
                                                        $length,
                                                        '0',
                                                        STR_PAD_LEFT,
                                                        );
                                                        $length = rand(8, 9);
                                                        $collapse_id = str_pad(
                                                        rand(0, (int) pow(10, $length) - 1),
                                                        $length,
                                                        '0',
                                                        STR_PAD_LEFT,
                                                        );
                                                        @endphp
                                                        <div class="sortable-moves   secondTierIterate delete_row_{{ $uniqueKey }}">
                                                            <div class="col-12 ">
                                                                <div class="PackagingOption second_tier mb-0 " style="background-color: #ebebeb;">
                                                                    <div class="row  ">
                                                                        <div class="col-4 pr-0 ">
                                                                            <select class="custom-select custom-select-sm menuSelect formselect" style="width: 100%!important;">
                                                                                <option value="">Select Menu
                                                                                </option>
                                                                                @foreach ($pages as $page) 
                                                                                <option value="{{ $page->url }}" {{ $page->url == $sub_menu['url'] ? 'selected' : '' }}>
                                                                                    {{ $page->title }}
                                                                                </option> 
                                                                                @endforeach
                                                                                @foreach ($new_pages_cat as $category => $new_pages)
                                                                                <optgroup label="{{ $category }}" > 
                                                                                    @foreach ($new_pages as $new_page)
                                                                                        <option value="{{ $new_page['url'] }}" {{ $new_page['url'] == $sub_menu['url'] ? 'selected' : '' }}>
                                                                                            {{ $new_page['title'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </optgroup>
                                                                            @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col pr-0">
                                                                            <input type="text" class="form-control input-style " name="title" value="{{ $sub_menu['title'] }}" id="tier_two_title_{{ $uniqueKey }}" placeholder="title here">
                                                                        </div>
                                                                        <div class="col pr-0"><input type="text" class="form-control input-style" name="url" value="{{ $sub_menu['url'] }}" id="tier_two_url_{{ $uniqueKey }}" placeholder="url here.."></div>
                                                                        <div class="col-3" style="padding-top:5px">
                                                                            <div class="custom-control custom-checkbox mr-sm-2 PageCheckbox font13">
                                                                                <input type="checkbox" name="new_window" class="custom-control-input" value="{{ $sub_menu['new_window'] }}" id="tier_two_new_window_{{ $uniqueKey }}" {{ $sub_menu['new_window'] ? 'checked' : '' }}>
                                                                                <label class="custom-control-label" for="tier_two_new_window_{{ $uniqueKey }}">New
                                                                                    Window ?</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-auto position-relative">
                                                                            <button type="button" id="{{ $uniqueKey }}" class="btn delListPO delete_row" title="Delete"><i class="fa fa-trash-alt"></i></button>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-12 PT-20 text-center">
                    <button type="button" class="btn btn-primary save_right_web_menu">Save</button>
                    <button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('/js/custom/site-menu.js') }}"></script>
<script src="{{ asset('/admin/js/fSelect.js') }}"></script>
@endpush