@extends('layouts.app')
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Demo <span>Requests</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Requests </span></a></li>
                <li><span>List</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    {{-- <button type="button" class="btn add_button add_faqs"><i class="fa fa-plus"></i> <span>Add
                            FAQ</span></button> --}}
                    <h2>Requests <span>List</span></h2>
                </div>
                <div style="min-height: 400px" class="loader">
                    <img src="images/loading.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body demo_requests_list">

                </div>
            </div>
        </div>
    </div>
    {{-- Select Type Modal --}}
    <div class="modal fade" id="lead_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content top-border">
                <form id="SaveModalStatus">
                    @csrf
                    <input type="hidden" name="lead_id" id="lead_id">
                    <input type="hidden" name="first_name" id="f_name">
                    <input type="hidden" name="last_name" id="l_name">
                    <input type="hidden" name="email" id="m_email">
                    <input type="hidden" name="phone_no" id="phone_no">
                    <div class="modal-header statusMH">
                        <h5 class="modal-title" id="exampleModalLabel">Status: <span class="modal_lead_name"> </span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-20">
                        <div class="row">
                            <div class="col-4">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input radio_status web_lead" type="radio" id="web_lead_status"
                                        value="1" data-id="web_lead_status" name="radio_status">
                                    <label class="custom-control-label head-sta" for="web_lead_status"> Web Lead</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input radio_status client" type="radio" id="client_status"
                                        value="2" data-id="client_status" name="radio_status">
                                    <label class="custom-control-label head-sta" for="client_status"> Client</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input radio_status spam" type="radio" id="spam"
                                        value="3" data-id="spam" name="radio_status">
                                    <label class="custom-control-label head-sta" for="spam"> Spam</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save_status" id="save_status">Save</button>
                        <!--<button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>-->
                    </div>
                </form>
            </div>
        </div>
        <button hidden data-toggle="modal" data-target="#lead_detail" id="hidden_btn_to_open_modal"></button>
    </div>
@endsection
@push('js')
    <script src="{{ mix('js/custom/demo-requests.js') }}"></script>
@endpush
