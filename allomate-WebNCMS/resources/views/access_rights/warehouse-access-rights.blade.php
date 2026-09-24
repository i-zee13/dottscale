@extends('layouts.master')
@section('data-sidebar')
<style>
    .AccRights h3 {
        margin-bottom: 15px !important;
        margin-top: 30px !important;
        border-bottom: 1px #efefef solid !important;
        padding-bottom: 5px!important;
    }

    .AccRights h3 .custom-control-label {
        font-size: 16px !important;
    }
    .AccRights h3 {
        font-size: 16px!important;
        margin-bottom: 7px!important;
        margin-top: 15px!important;
        
    }

    .se_cus-type {
        background-color: #f6f6f6 !important;
        border: solid 1px #eaeaea !important;
        padding: 5px 15px 10px 15px;
    }

    .se_cus-type h3 {
        margin-top: 10px !important;
        margin-bottom: 0 !important;
        border: none
    }

    .selectall {
        position: absolute!important;
        right: 0!important;
        top: -8px!important;
        line-height: 1.7!important;
        z-index: 2!important
    }
</style>
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
                                <input type="text" id="operation" hidden>
                                <div class="row" id="employeesRow">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mb-3" style="width: 100%;">
                                            <h2 class="_head03">Warehouse <span>List</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="font12 mb-5">Choose Warehouse*</label>
                                                        <select name="warehouse_id" class="form-control">
                                                            <option value="">Select Warehouse</option>
                                                            @foreach ($warehouses as $ware)
                                                                @if ($ware->active == 1)
                                                                    <option value="{{ $ware->id }}">{{ $ware->username }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
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
                                            <div class="form-wrap p-0">
                                                <div class="row" style="margin-top: -9px!important;margin-bottom: -9px;">
                                                    <div class="col-md-6 mt-auto mb-auto">
                                                        <label class="font12">Choose Right (At least 1)*</label>
                                                    </div>
                                                    <div class="col-md-6 text-right" style="font-size: 9pt !important;">
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input type="checkbox" name="check_all" id="checkAll"
                                                                class="custom-control-input">
                                                            <label class="custom-control-label checkAll"
                                                                for="checkAll">Select All</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    @foreach ($controllers as $count => $heading)
                                                        <div class="col-12 {{ $count == 0 ? 'position-relative' : ''}}">
                                                            <h3 class="{{ $count == 0 ? 'mt-10' : ''}}">
                                                                <div>
                                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                                        <input type="checkbox" name="rights[]" heading="{{ $heading['heading'] }}"
                                                                        class="custom-control-input access_rights_headings" value="" id="select-all-{{$count}}">
                                                                        <label class="custom-control-label" for="select-all-{{$count}}">{{ $heading['heading'] }}</label>
                                                                    </div>
                                                                </div>
                                                            </h3>
                                                        </div>
                                                        @foreach ($heading["sub_mod"] as $key => $rights)
                                                            <div class="col-md-6" style="font-size: 9pt !important;">
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input type="checkbox" value="{{ $rights['controller'] }}" name="rights[]" heading="{{ $heading['heading'] }}" class="custom-control-input access_rights_emp"  value="register" id="{{$rights['made_up_name'].$key}}">
                                                                    <label class="custom-control-label" for="{{$rights['made_up_name'].$key}}">{{ $rights['made_up_name'] }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                    {{-- <?php //$counter = 0; ?>
                                                    @foreach ($controllers as $acc)
                                                        <div class="col-6" style="font-size: 9pt !important;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="rights[]"
                                                                    class="custom-control-input supplementary_services_client"
                                                                    value="{{ $acc->controller }}" id="{{ $acc->id }}">
                                                                <label class="custom-control-label"
                                                                    for="{{ $acc->id }}">{{ $acc->made_up_name }}</label>
                                                            </div>
                                                        </div>
                                                        <?php //$counter++; ?>
                                                    @endforeach --}}
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
    @include('includes.delete-modal')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Warehouse <span>Rights Management</span></h2>
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
                    <h2>Rights List</h2>
                </div>
                <div style="min-height: 400px" id="tblLoader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body body_accessrights" style="display: none">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="/js/custom/warehouse-access-rights.js"></script>
@endpush
