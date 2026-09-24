@extends('layouts.app')
@section('data-sidebar')
    <div id="product-cl-sec">
        <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text">Employee<span> Add</span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0 AccRights">
                        <div class="container">
                            <form style="width: 100%" id="saveEmployeeForm">
                                @csrf
                                <input type="hidden" id="employee_id" name="employee_id">
                                <input type="hidden" id="sidebar_type">
                                <input type="text" id="operation" hidden>
                                <div class="row" id="InvestorsRow">
                                    <div class="col-12">
                                        <div id="floating-label" class="card p-20 top_border mt-3 mb-3"
                                            style="width: 100%;">
                                            <h2 class="_head03">New<span> Employee Details</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Name *</label>
                                                            <input type="text" name="name" id="name" value=""
                                                                class="form-control employee-required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Phone Number </label>
                                                            <input type="text" name="phone_number" id="phone_number" value=""
                                                                class="form-control  " autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <div class="form-group">
                                                            <label class="control-label ">Email </label>
                                                            <input type="text" name="email" id="email" value=""
                                                                class="form-control " autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <div class="form-group">
                                                            <label class="control-label ">ID No </label>
                                                            <input type="text" name="id_no" id="id_no" value=""
                                                                class="form-control " autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">Country *</label>
                                                            <select
                                                                class="form-control countries employee-required formselect "style="width: 100%!important"
                                                                placeholder="" id="country" name="country_id">

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-10">
                                                        <div class="form-s2">
                                                            <label class="font12 mb-5">State/Province *</label>

                                                            <select class="form-control formselect states employee-required"style="width: 100%!important"
                                                                placeholder="Select Province/State" id="state"
                                                                name="state_id">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-10">
                                                        <label class="font12 mb-5">City *</label>
                                                        <div class="form-s2">
                                                            <select class="form-control formselect cities employee-required "style="width: 100%!important"
                                                                placeholder="" id="city" name="city_id">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Employee Address </label>
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
                                                            <label class="control-label mb-5">Username*</label>
                                                            <input type="text" name="username" id="username"
                                                                class="form-control employee-required" placeholder="" autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-5">Password*</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control" placeholder="" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                      <div class="col-md-6">
                                                        <div class="form-wrap pt-19 PB-10" id="dropifyImgDiv">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="_head03 PT-10">Additional <span> Details</span></h2>
                                            <div class="form-wrap p-0">
                                                <div class="row mt-10">
                                                    <div class="col-md-6 PB-10">
                                                        <label class="font12 mb-5">Designation*</label>
                                                        <div class="form-s2">
                                                            <select name="designation" id="designation" style="width: 100%!important" class="employee-required form-control formselect"
                                                                placeholder="select Designation">
                                                                <option value="0" selected>Select Designation*
                                                                </option>
                                                                @foreach ($designations as $des) 
                                                                        <option value="{{ $des->id }}">
                                                                            {{ $des->designation }}</option>
                                                                
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 PB-10">
                                                        <label class="font12 mb-5">Reporting To</label>
                                                        <div class="form-s2">
                                                            <select name="reporting" id="reporting" style="width: 100%!important" class=" form-control formselect"
                                                                placeholder="Reporting To">
                                                                <option value="0" selected>Reporting To</option>
                                                                @foreach ($users as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 PB-10">
                                                        <label class="font12 mb-5">Department*</label>
                                                        <div class="form-s2">
                                                            <select name="department" id="department" style="width: 100%!important" class="employee-required form-control formselect"
                                                                placeholder="Select Department">
                                                                <option value="0" selected>Select Department*</option>
                                                                @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}">
                                                                            {{ $department->department }}</option>
                                                                    
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 PB-10">
                                                        <label class="font12 mb-5">Joining Date</label>
                                                        <input type="text" name="hiring" id="hiring"
                                                            class="form-control datepicker" placeholder="">
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
            <button type="button" class="btn btn-primary mr-2" id="saveEmployee">Save</button>
            <button id="pl-close" type="button" class="btn btn-cancel mr-2" id="cancelEmployee">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Employee <span>Management</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Employee</span></a></li>
                <li><span>List</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a class="btn add_button openDataSidebarForAddingEmployees"><i class="fa fa-plus"></i> <span> New
                            Employee</span></a>
                    <h2>Employee <span> List</span></h2>
                </div>
                <div style="min-height: 400px" id="tblLoader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body bodyEmployee" style="display: none">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="/js/custom/employee.js"></script>
@endpush
