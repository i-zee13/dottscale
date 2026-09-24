@extends('layouts.app')
@section('data-sidebar')
    <style>
        .CB-view {
            font-size: 13px;
            letter-spacing: 1px
        }

        .CB-view thead th {
            background: linear-gradient(0deg, #f8f8f8 0%, #ffffff 100%);
            border-bottom: none;
            padding: 5px
        }

        .CB-view .table td,
        .table th,
        .CB-view .table td,
        .table th {
            font-size: 12px;
            padding: 5px
        }

        .CB-view ._boxgray {
            background-color: #f9f9f9;
            border: solid 1px #e7eaed;
            padding: 8px 12px;
            font-size: 13px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out
        }

        .CB-view ._boxgray span {
            display: block;
            font-size: 14px;
            font-weight: 600
        }

        .CB-view ._boxgray:HOVER {
            box-shadow: 0px 0px 8px 0 rgba(79, 79, 79, .2);
            border: solid 1px #ed6b4d;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out
        }

        .CB-view .Doclink {
            margin-top: 47px
        }

        .CB-view a,
        .CB-view a:HOVER {
            color: #ed6b4d
        }
    </style>
    <div id="product-cl-sec" class="faqs-sidebar" style="width: 740px">
        <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
        <div class="pro-header-text"><span> Form</span>  Details</div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist" id="PropertiesDetailForm" style="display: none">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0">
                        <form id="" >
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card CB-view p-20 top_border mb-30">
                                            <div class="row  ">
                                               
                                                <div class="col-6 pr-0">
                                                    <div class="_boxgray"><strong>First Name:</strong><br>
                                                        <div id="first_name"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  ">
                                                    <div class="_boxgray"><strong>Last Name:</strong><br>
                                                        <div id="last_name"> </div>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            <div class="row mt-20">
                                               
                                                <div class="col-6 pr-0">
                                                    <div class="_boxgray"><strong>Asking Price:</strong><br>
                                                        <div id="asking_price"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  ">
                                                    <div class="_boxgray"><strong>Page Reference:</strong><br>
                                                        <div id="page_reference"> </div>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                         
                                            <div class="row mt-20">
                                               
                                                <div class="col-6 pr-0">
                                                    <div class="_boxgray"><strong>Email:</strong><br>
                                                        <div id="email"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-6  ">
                                                    <div class="_boxgray"><strong>Phone:</strong><br><div id="phone">
                                                    </div></div>
                                                </div>
                                            </div>
                                            <div class="row mt-20"> 
                                                <div class="col-12  ">
                                                    <div class="_boxgray"><strong>Street Address:</strong><br><div
                                                            id="street_address"> </div></div>
                                                </div> 
                                            </div>
                                            <div class="row mt-20"> 
                                                <div class="col-4 pr-0">
                                                    <div class="_boxgray"><strong>City:</strong><br>
                                                        <div id="city"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 pr-0">
                                                    <div class="_boxgray"><strong>State:</strong><br>
                                                        <div id="state"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 ">
                                                    <div class="_boxgray"><strong>Zip Code:</strong><br>
                                                        <div id="zip_code"> </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                          
                                            <div class="row">
                                                <div class="col-md-12   PT-15">

                                                    <div class="_boxgray">
                                                        <strong>Notes: </strong><br>
                                                        <p class="mb-0" id="notes"></p>
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
        <div class="_cl-bottom">

            <button id="pl-close" type="button" class="btn btn-cancel mr-2 faq-cancel" id="faq-cancel">Close</button>
        </div>
    </div>
@endsection
@section('content')
    <style>
        .form-wrap textarea {
            border-radius: 6px !important;
        }

        .inquiries-records .badge {
            background-color: transparent;
            line-height: 0.6875rem;
            padding: 0.125rem;
            color: #282828;
        }

        .inquiries-records .badge {
            font-size: 12px;
            position: relative;
            right: auto !important;
            top: auto !important;
            width: 85px !important;
            text-align: left !important;
            height: auto;
            letter-spacing: 1px;
            font-weight: normal;
            border-radius: 0px !important;
        }

        .inquiries-records .badge .indicator {
            width: 8px;
            height: 8px;
        }

        .indicator {
            display: inline-block;
            margin-right: 0.2em;
            border-radius: 50%;
            background-color: currentColor;
        }

        .badge-soft-progress .indicator {
            color: #21497a !important;
        }

        .badge-soft-success .indicator {
            color: green !important;
        }

        .badge-soft-cancelled .indicator {
            color: #ff5e00 !important;
        }

        .badge-soft-deleted .indicator {
            color: red !important;
        }

        .badge-soft-part-success .indicator {
            color: #ffbf00 !important;
        }

        .StPending .custom-radio .custom-control-input:checked~.custom-control-label::before {
            background-color: #21497a !important;
        }

        .StContacted .custom-radio .custom-control-input:checked~.custom-control-label::before {
            background-color: green !important;
        }

        .StSpam .custom-radio .custom-control-input:checked~.custom-control-label::before {
            background-color: #ff5e00 !important;
        }

        .StDeleted .custom-radio .custom-control-input:checked~.custom-control-label::before {
            background-color: red !important;
        }
    </style>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Properties Form <span>List</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Properties Form List </span></a></li>
                <li><span>View</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    {{-- <button type="button" class="btn add_button openSidebarAddContact"><i class="fa fa-plus"></i> <span>Add Contact</span></button> --}}
                    <h2>Forms List</h2>
                </div>
                <div style="min-height: 400px" class="loader">
                    <img src="/images/loader.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;" />
                </div>
                <div class="body inquiries-records">
                    {{-- <table class="table table-hover dt-responsive nowrap" id="example" style="width:100%;">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Page Reference</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date('d-m-Y',strtotime($record->created_at))}}</td>
                                    <td>{{$record->first_name}}</td>
                                    <td>{{$record->last_name}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td style="text-transform: capitalize;">{{str_replace('-',' ',$record->page_reference)}}</td>
                                    <td>{{$record->message}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/custom/sfr-forms.js') }}"></script>
@endpush
