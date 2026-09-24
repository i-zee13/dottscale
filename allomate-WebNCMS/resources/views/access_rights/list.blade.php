
@extends('layouts.app')
<style>
    #product-cl-sec {
        width: 800px;
    }

    .AccRights h3 {
        margin-bottom: 15px;
        margin-top: 30px;
    }

    .AccRights h3 .custom-control-label {
        font-size: 16px;
    }

    .se_cus-type {
        background-color: #f6f6f6;
        border: solid 1px #eaeaea;
        padding: 5px 15px 10px 15px;
    }

    .se_cus-type h3 {
        margin-top: 10px;
        margin-bottom: 0;
        border: none
    }

    .selectall {
        position: absolute !important;
        right: 15px;
        top: 10px;
        line-height: 1.7;
        z-index: 2;
        font-size: 12px;
    }
    .custom-control-label{
        font-size: 12px;
    }
</style>
@section('data-sidebar')
<div id="product-cl-sec">
    <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
    <div class="pro-header-text">Rights<span></span></div>
    <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
        <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
    </div>   
    <div class="pc-cartlist">
        <div class="overflow-plist">
            <div class="plist-content">
                <div class="_left-filter pt-0 AccRights">
                    <div class="container">
                        <form style="width: 100%" id="saveRightsForm">
                            @csrf
                            <input type="hidden" id="investor_id_hidden" name="investor_id_hidden">
                            <input type="hidden" id="sidebar_type">
                            <input type="hidden" value="{{json_encode(@$investors)}}" class="investors_list" id="investors_list">
                            <input type="text" id="operation" hidden>
                            <div class="row" id="InvestorsRow">
                                <div class="col-12">
                                    <div id="floating-label" class="card p-20 top_border mt-3 mb-3" style="width: 100%;">
                                        <h2 class="_head03">Investors <span>List</span></h2>
                                        <div class="form-wrap p-0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select name="investor_id" class="form-control" class="investor_id">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="floating-label" class="card p-20 top_border mb-3" style="width: 100%;">
                                        <h2 class="_head03">Rights <span>List</span></h2>
                                        <div class="custom-control custom-checkbox mr-sm-2 selectall">
                                            <input type="checkbox" name="rights[]" class="custom-control-input all_rights" value="" id="br-001">
                                            <label class="custom-control-label" for="br-001">Select All</label>
                                        </div>
                                        <div class="form-wrap p-0">
                                            <div class="row">

                                                @foreach ($controllers as $count => $heading)
                                                <div class="col-12 {{ $count == 0 ? 'position-relative' : ''}}">
                                                    <h3 class="{{ $count == 0 ? 'mt-10' : ''}}">
                                                        <div>
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input type="checkbox" name="rights[]" heading="{{ $heading['heading'] }}" class="custom-control-input access_rights_headings" value="" id="select-all-{{$count}}">
                                                                <label class="custom-control-label" for="select-all-{{$count}}">{{ $heading['heading'] }}</label>
                                                            </div>
                                                        </div>
                                                    </h3>
                                                </div>
                                                @foreach ($heading["sub_mod"] as $key => $rights)
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" value="{{ $rights['controller'] }}" name="rights[]" heading="{{ $heading['heading'] }}" class="custom-control-input access_rights_investors" value="register" id="{{$rights['made_up_name'].$key}}">
                                                        <label class="custom-control-label" for="{{$rights['made_up_name'].$key}}">{{ $rights['made_up_name'] }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_cl-bottom">
        <button type="submit" class="btn btn-primary mr-2" id="saveRights">Save</button>
        <button id="pl-close" type="submit" class="btn btn-cancel mr-2" id="cancelRights">Cancel</button>
    </div>
</div>
@endsection
@section('content')

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Investors  <span> Rights Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Access Rights</span></a></li>
            <li><span>Active</span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <a class="btn add_button openDataSidebarForAddingAccessRights"><i class="fa fa-plus"></i> New Access
                    Rights</a>
                <h2>Investors Access Rights List</h2>
            </div>
            <div style="min-height: 400px" id="tblLoader">
                <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body" style="display: none">
            </div>
        </div>
    </div>
</div>
 
@endsection

@push('js')
<script src="/js/custom/access_rights.js"></script>
@endpush