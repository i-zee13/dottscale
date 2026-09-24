@extends('layouts.app')
@section('data-sidebar')
@endsection

@section('content')

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Manage <span>Gateways</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="#"><span>Manage</span></a></li>
            <li><span>Gateways</span></li>
        </ol>
    </div>
</div>
<div style="min-height: 400px" id="tblLoader">
    <img src="/images/loader.gif" width="30px" height="auto"
        style="position: absolute; left: 50%; top: 45%;">
</div>
<div class="row" id="MainContent" style="display: none;">
    <div class="col-lg-6">
        <div class="card">
            <div class="header">
                <h2>Send In Blue <span> Credentials (Live)</span></h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Mailer</label>
                            <input type="text" name="mail_live_mailer" class="form-control shadow-none" id="mandril-mail-live-mailer">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Host</label>
                            <input type="hidden" name="section_type" class="form-control shadow-none" id="section_type" value="email">
                            <input type="text" name="mail_live_host" class="form-control shadow-none" id="mandril-mail-live-host">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Port</label>
                             <input type="text" name="mail_live_port" class="form-control shadow-none" id="mandril-mail-live-port">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Username</label>
                             <input type="text" name="mandril_mail_live_username" class="form-control shadow-none" id="mandril-mail-live-username">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Password</label>
                             <input type="text" name="mandril_mail_live_password" class="form-control shadow-none" id="mandril-mail-live-password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Encryption</label>
                             <input type="text" name="mandril_mail_live_encryption" class="form-control shadow-none" id="mandril-mail-live-encryption">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Sender (Name)</label>
                            <input type="text" name="mandril_live_sender_name" class="form-control shadow-none" id="mandril-live-sender-name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Sender (Email)</label>
                            <input type="text" name="mandril_live_sender_email" class="form-control shadow-none" id="mandril-live-sender-email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="header">
                <h2>Send In Blue <span> Credentials (Demo)</span></h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Mailer</label>
                            <input type="text" name="mail_demo_mailer" class="form-control shadow-none" id="mandril-mail-demo-mailer">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Host</label>
                            <input type="hidden" name="section_type" class="form-control shadow-none" id="section_type" value="email">
                            <input type="text" name="mandril_mail_demo_host" class="form-control shadow-none" id="mandril-mail-demo-host">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Port</label>
                             <input type="text" name="mandril_mail_demo_port" class="form-control shadow-none" id="mandril-mail-demo-port">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Username</label>
                             <input type="text" name="mandril_mail_demo_username" class="form-control shadow-none" id="mandril-mail-demo-username">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Password</label>
                             <input type="text" name="mandril_mail_demo_password" class="form-control shadow-none" id="mandril-mail-demo-password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Mail Encryption</label>
                             <input type="text" name="mandril_mail_demo_encryption" class="form-control shadow-none" id="mandril-mail-demo-encryption">
                        </div>
                    </div>
                  
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Sender (Name)</label>
                            <input type="text" name="mandril_demo_sender_name" class="form-control shadow-none" id="mandril-demo-sender-name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label mb-10">Sender (Email)</label>
                            <input type="text" name="mandril_demo_sender_email" class="form-control shadow-none" id="mandril-demo-sender-email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="form-s2 pt-19">
            <label class="control-label mb-10">Status*</label>
            <select name="mandril_status" class="form-control formselect" style="width: 100%!important" id="mandril-status">
                <option value="active">Active</option>
                <option value="inactive">In-active</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <br><br>
        <div class="row assCatalogue-radio PT-10 PB-10" id="filters-area">
            <div class="col-auto pr-400">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="mandril_mode" id="mandril-live-radio" value="live" checked>
                    <label class="custom-control-label font13 pt-1" for="mandril-live-radio">Live</label>
                </div>
            </div>
            <div class="col-auto pr-400">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="mandril_mode" id="mandril-demo-radio" value="demo">
                    <label class="custom-control-label font13 pt-1" for="mandril-demo-radio">Demo</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-20">
        <button type="button" class="btn btn-primary mr-2 save-btn" id="SaveMandrilBtn" onclick="SaveMandril()">Save</button>
    </div>
</div>
@endsection
@push('js')
    <script src="/js/custom/gateway.js"></script>
@endpush
