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
        <div class="pro-header-text">Web Inquiry <span>Message</span></div>
        <div style="min-height: 400px" id="dataSidebarLoader" style="display: none">
            <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
        </div>
        <div class="pc-cartlist inquiriesForm" style="display: none">
            <div class="overflow-plist">
                <div class="plist-content">
                    <div class="_left-filter pt-0">
                        <form id="SaveConatctForm">
                            @csrf
                            <input type="hidden" name="contatc_us_id" id="contatc_us_id" value="" />
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card CB-view p-20 top_border mb-30">
                                           
                                          
                                            <div class="row">
                                                <div class="col-md-12 PT-15"> 
                                                    <div class="_boxgray">
                                                        <strong>Message: </strong><br>
                                                        <p class="mb-0" id="message"></p>
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
            <button id="pl-close" type="button" class="btn btn-cancel mr-2 faq-cancel" id="faq-cancel">Cancel</button>
        </div>
    </div>
@endsection
@section('content')
<style>
    .form-wrap textarea {
        border-radius: 6px!important;
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
        right: auto!important;
        top: auto!important;
        width: 85px!important;
        text-align: left!important;
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
        color:#ff5e00  !important;
    }
    .badge-soft-deleted .indicator {
        color: red !important;
    }
    .badge-soft-part-success .indicator {
        color: #ffbf00 !important;
    }
    .StPending .custom-radio .custom-control-input:checked~.custom-control-label::before{
        background-color : #21497a !important;
    }
    .StContacted .custom-radio .custom-control-input:checked~.custom-control-label::before{
        background-color : green !important;
    }
    .StSpam .custom-radio .custom-control-input:checked~.custom-control-label::before{
        background-color : #ff5e00 !important;
    }
    .StDeleted .custom-radio .custom-control-input:checked~.custom-control-label::before{
        background-color : red !important;
    }
</style>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Web Inquiries <span>List</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="#"><span>Web Inquiries List </span></a></li>
                <li><span>View</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    {{-- <button type="button" class="btn add_button openSidebarAddContact"><i class="fa fa-plus"></i> <span>Add Contact</span></button> --}}
                    <h2>Inquiries List</h2>
                </div>
                {{-- <div style="min-height: 400px" class="loader">
                    <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;" />
                </div> --}}
                <input type="hidden" name="all_records" id="all_records" value="{{@$records? json_encode($records):''}}">
                <div class="body inquiries-records">
                    <table class="table table-hover dt-responsive nowrap" id="example" style="width:100%;">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Date</th>
                                <th>Name</th>
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
                                    <td>{{$record->name}}</td> 
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td style="text-transform: capitalize;">{{str_replace('-',' ',$record->page_reference)}}</td>
                                    <td> <button id="{{$record->id}}" class="btn btn-default detailOpen">Message Detail</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteHomeSection" tabindex="-1" role="dialog" aria-labelledby="deleteHomeSectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content top-borderRed">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteHomeSectionLabel">Delete <span></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <input type="hidden" id="promotion-delete-id">
                            <p>Are you sure you want to delete this Inquiry?</p>
                        </div>
                    </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary confirm_delete">Yes</button>
                    <button type="button" class="btn btn-cancel cancel_delete_modal" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
        <button hidden data-toggle="modal" data-target="#deleteHomeSection" id="hidden_btn_to_open_section_modal"></button>
    </div>
    {{-- Update Status --}}
    <div class="modal fade" id="InquiryStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content top-border">
                <div class="modal-header statusMH">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</span>
                    </h5>
                    <button type="button" class="close close-status-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body PT-5 pb-0">
                    <div class="row">
                        <div class="col-3 status-sh StPending">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status co-status-radio" type="radio" id="pending_status" value="1"
                                    data-id="pending_status" name="radio_status" />
                                <label class="custom-control-label head-sta" for="pending_status"> Pending</label>
                            </div>
                        </div>

                        <div class="col-3 status-sh StContacted">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status co-status-radio" type="radio" id="contacted_status" value="2"
                                    data-id="contacted_status" name="radio_status">
                                <label class="custom-control-label head-sta" for="contacted_status"> Contacted</label>
                            </div>
                        </div>
                        <div class="col-3 status-sh StSpam">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status co-status-radio" type="radio" id="spam_status" value="3"
                                    data-id="spam_status" name="radio_status">
                                <label class="custom-control-label head-sta" for="spam_status"> Spam</label>
                            </div>
                        </div>
                        <div class="col-3 status-sh StDeleted">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input radio_status co-status-radio" type="radio" id="deleted_status" value="4"
                                    data-id="deleted_status" name="radio_status">
                                <label class="custom-control-label head-sta" for="deleted_status"> Deleted</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="font12 mb-5">Remarks *</label>
                            <textarea id="remarks" name="remarks" class="proTextarea" rows="3" style="box-shadow: none;border-radius: 6px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary update_conatct_status">Update Status</button>
                    <!--<button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>-->
                </div>
            </div>
        </div>
        <button hidden data-toggle="modal" data-target="#InquiryStatusModal" id="hidden_btn_to_open_status_modal"></button>
    </div>
@endsection
 
@push('js')
<script src="/js/custom/web-inquiries-list.js"></script>
 

@endpush
