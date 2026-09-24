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

    .custom-control-label {
        font-size: 12px;
    }
</style>
@section('data-sidebar')
    <div id="product-cl-sec">
        <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text">Investors<span></span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0 AccRights">
                        <div class="container">
                            <form style="width: 100%" id="saveInvestorsForm">
                                @csrf
                                <input type="hidden" id="investor_id" name="investor_id">
                                <input type="hidden" id="sidebar_type">
                                <input type="text" id="operation" hidden>
                                <div class="row" id="InvestorsRow">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mt-3 mb-3"
                                            style="width: 100%;">
                                            <h2 class="_head03">New<span> Investor</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">First Name *</label>
                                                            <input type="text" name="first_name" id="first_name" value=""
                                                                class="form-control investor-required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Last Name *</label>
                                                            <input type="text" name="last_name" id="last_name" value=""
                                                                class="form-control investor-required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <div class="form-group">
                                                            <label class="control-label ">Phone Number *</label>
                                                            <input type="text" name="phone_number" id="phone_number" value=""
                                                                class="form-control investor-required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">Country *</label>
                                                            <select
                                                                class="form-control countries investor-required formselect "
                                                                placeholder="" id="country" name="country_id">

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">State/Province *</label>

                                                            <select class="form-control formselect states investor-required"
                                                                placeholder="Select Province/State" id="state"
                                                                name="state_id">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-10">
                                                        <label class="font12 mb-5">City *</label>
                                                        <div class="form-s2">
                                                            <select class="form-control formselect cities investor-required "
                                                                placeholder="" id="city" name="city_id">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Investor Address </label>
                                                            <input type="text" name="address" value="" id="address"
                                                                class="form-control " autocomplete="off">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <h2 class="_head03 PT-10">Create <span> User</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-5">Email*</label>
                                                            <input type="text" name="email" id="email"
                                                                class="form-control investor-required" placeholder="" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-5">Password*</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control" placeholder="" autocomplete="off">
                                                        </div>
                                                    </div>

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
            <button type="submit" class="btn btn-primary mr-2" id="saveInvestors">Save</button>
            <button id="pl-close" type="submit" class="btn btn-cancel mr-2" id="cancelInvestors">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Investors <span> Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Investors</span></a></li>
                <li><span>Active</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a class="btn add_button openDataSidebarForAddingInvestors"><i class="fa fa-plus"></i> New Investor
                    </a>
                    <h2>Investors List</h2>
                </div>
                <div style="min-height: 400px" id="tblLoader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body body_investors" style="display: none">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="/js/custom/investors.js"></script>
@endpush
