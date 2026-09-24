@extends('layouts.master')
@section('page-style')
    <style>
        .UserProfile .u-info {
            border-top: solid 1px #e1e1eb;
            border-radius: 0;
            line-height: 1;
            font-size: 14px;
            letter-spacing: 1px;
            padding: 15px 0;
            margin: 0;
            display: block;
        }

        .UserProfile .control-label {
            opacity: 0.75;
            font-size: 13px;
        }

        ._head01 {
            font-size: 20px;
            margin: auto;
            line-height: 1;
        }

        .UserImage {
            border: solid 1px #00843d;
            width: 52px;
            height: 52px;
            background-color: #FFF;
            padding: 1px;
            border-radius: 50%;
            float: left;
        }

        .top-performer {
            background-color: #fff;
            border-radius: 12px;
            font-size: 14px;
            padding: 0;
            box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.25);
        }

        .top-performer .nav-tabs {
            background: linear-gradient(0deg, #f8f8f8 0%, #ffffff 50%);
            border: none;
            border-radius: 10px;
            padding: 10px;
        }

        .top-performer .nav-tabs .nav-link {
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            color: #979797;
            height: auto;
            line-height: 1;
            letter-spacing: 1px;
            font-size: 14px;
            margin-right: 10px;
        }

        .top-performer .nav-tabs .nav-link svg {
            width: 16px;
            height: 16px;
            margin-right: 5px;
            margin-top: -3px;
            fill: #244d80;
        }

        .top-performer .nav-tabs .nav-item.show,
        .top-performer .nav-tabs .nav-link:HOVER,
        .top-performer .nav-tabs .nav-link.active {
            border: none;
            color: #fff;
            background-color: #244d80;
        }

        .top-performer .nav-tabs .nav-link.active svg,
        .top-performer .nav-tabs .nav-link:HOVER svg {
            fill: #fff !important;
            opacity: 1;
        }

        .top-performer .tab-pane {
            padding: 25px
        }

        .mobNo-lab {
            font-size: 16px;
            letter-spacing: 2px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .mobNo-lab svg {
            width: 18px;
            height: 18px;
            margin-top: -3px;
        }

        .top-performer #floating-label .form-group .form-control {
            border-radius: 6px;
        }

        .top-performer .dropify-wrapper {
            height: 130px;
            width: 130px;
            border-radius: 8px;
        }

        .top-performer .label-update {
            background: #244d80;
            color: #fff;
            text-align: center;
            font-size: 11px;
            line-height: 1;
            padding: 3px;
            margin-top: -24px;
            margin-left: 7px;
            z-index: 5;
            position: relative;
            width: 50px
        }

        .top-performer .dropify-message p {
            letter-spacing: 0;
        }

        .top-performer ._cut-img {
            padding-bottom: 20px;
        }

        .AssNotification {
            padding: 0;
            margin-top: 0;
        }

        .AssNotification thead th {
            background: transparent !important;
            font-size: 14px;
        }

        .AssNotification .switch {
            width: 38px;
            height: 20px;
        }

        .AssNotification .switch .slider:before {
            height: 12px;
            width: 12px;
        }

        .top-performer .btn {
            border-radius: 6px !important;
            box-shadow: none !important;
        }
        .switch {
	position: relative!important;
	display: inline-block!important;
	width: 30px!important;
	height: 17px!important;
	margin-bottom: 0!important;
	margin-right: 5px!important
}
.switch input {
	opacity: 0!important;
	width: 0!important;
	height: 0!important
}
.switch .slider {
	position: absolute!important;
	cursor: pointer!important;
	top: 0!important;
	left: 0!important;
	right: 0!important;
	bottom: 0!important;
	background-color: #ccc!important;
	-webkit-transition: .4s!important;
	transition: .4s!important
}
.switch .slider:before {
	position: absolute;
	content: ""!important;
	height: 11px!important;
	width: 11px!important;
	left: 3px!important;
	bottom: 3px!important;
	background-color: #fff!important;
	-webkit-transition: .4s!important;
	transition: .4s!important
}
.switch input:checked + .slider {
	background-color: #00843d!important
}
input:focus + .slider {
	box-shadow: 0 0 1px #00843d!important
}
.switch input:checked + .slider:before {
	-webkit-transform: translateX(14px)!important;
	-ms-transform: translateX(14px)!important;
	transform: translateX(14px)!important
}
.switch .slider.round {
	border-radius: 26px!important
}
.switch .slider.round:before {
	border-radius: 50%!important
}
    </style>
@endsection
@section('content')
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">User <span>Profile</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>User </span></a></li>
                <li><span>Profile</span></li>
            </ol>
        </div>
    </div>

    <div class="row pb-15">
        <div class="col-auto pr-0">
            @if(GetActiveGuardDetail()->is_web == 1)
            <img class="UserImage" src="{{ GetActiveGuardDetail()->picture ? GetActiveGuardDetail()->picture : '/images/avatar.svg' }}"
                alt="">
            @else
            <img class="UserImage" src="/images/warehouse.png"
                alt="">
            @endif
        </div>
        <div class="col mt-auto mb-auto">
            <h2 class="_head01">{{ GetActiveGuardDetail()->name != null ? GetActiveGuardDetail()->name : 'NA' }}</h2>
            <span class="font14">{{ GetActiveGuardDetail()->is_web == 1 ? $designation_name : 'Warehouse' }}</span>
        </div>
        <div class="col-auto mobNo-lab">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" viewBox="0 0 50 60.7" style="enable-background:new 0 0 50 60.7;" xml:space="preserve">
                <path class="st0" d="M37.3,0.6H12.3c-2.7,0-4.9,2.2-4.9,4.9V55c0,2.7,2.2,5,4.9,5c0,0,0,0,0,0h25.1c2.7,0,4.9-2.2,4.9-4.9V5.5
                                    C42.3,2.8,40.1,0.6,37.3,0.6C37.4,0.6,37.4,0.6,37.3,0.6z M9.9,10.9h29.7v37.5H9.9L9.9,10.9z M12.3,3.2h25.1c1.3,0,2.3,1,2.3,2.3v0
                                    v2.8H9.9V5.5C9.9,4.3,10.9,3.2,12.3,3.2C12.2,3.2,12.2,3.2,12.3,3.2z M37.3,57.3H12.3c-1.3,0-2.3-1-2.3-2.3l0,0v-4h29.7v4
                                    C39.7,56.3,38.6,57.3,37.3,57.3C37.4,57.3,37.4,57.3,37.3,57.3z M28.2,54.2c0,0.7-0.6,1.3-1.3,1.3h-4.2c-0.7,0-1.3-0.6-1.3-1.3
                                    s0.6-1.3,1.3-1.3h4.3C27.6,52.9,28.2,53.5,28.2,54.2L28.2,54.2z" />
            </svg>
            <strong>{{ GetActiveGuardDetail()->phone != null ? GetActiveGuardDetail()->phone : 'NA' }}</strong>
        </div>
    </div>


    <div class="top-performer">

        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-Employee-tab" data-toggle="tab" href="#nav-Employee" role="tab"
                aria-controls="nav-Employee" aria-selected="true">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                    style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <g>
                                    <path class="st0" d="M28.6,36C28,36,27.5,35.9,27,35.6c-0.3-0.4-0.5-0.8-0.5-1.3c0-0.4,0.1-0.8,0.1-1.2c0.1-0.5,0.2-0.9,0.3-1.4
         l1.4-5c0.1-0.5,0.2-1,0.3-1.5c0-0.5,0.1-0.9,0.1-1.1c0-1-0.4-1.9-1.1-2.6c-0.9-0.7-2.1-1.1-3.2-1c-0.8,0-1.7,0.1-2.4,0.4
         c-0.9,0.3-1.8,0.6-2.7,1l-0.4,1.6c0.3-0.1,0.6-0.2,1-0.3c0.4-0.1,0.8-0.2,1.1-0.2c0.5-0.1,1.1,0.1,1.6,0.4
         c0.3,0.4,0.5,0.9,0.4,1.3c0,0.4,0,0.8-0.1,1.2c-0.1,0.4-0.2,0.9-0.3,1.4l-1.5,5c-0.1,0.5-0.2,0.9-0.3,1.4
         c-0.1,0.4-0.1,0.8-0.1,1.2c0,1,0.4,1.9,1.2,2.5c0.9,0.7,2.1,1.1,3.3,1c0.8,0,1.7-0.1,2.4-0.4c0.7-0.2,1.6-0.6,2.8-1l0.4-1.5
         c-0.3,0.1-0.6,0.2-1,0.3C29.4,35.9,29,36,28.6,36z" />
                                    <path class="st0" d="M30.1,12.5c-0.7-0.6-1.5-0.9-2.4-0.9c-0.9,0-1.8,0.3-2.4,0.9c-1.2,1.1-1.4,2.9-0.3,4.1
         c0.1,0.1,0.2,0.2,0.3,0.3c1.4,1.2,3.5,1.2,4.9,0c1.2-1.1,1.3-2.9,0.3-4.1C30.3,12.7,30.2,12.6,30.1,12.5z" />
                                </g>
                                <path class="st0" d="M25,0.5C11.5,0.5,0.5,11.5,0.5,25s11,24.5,24.5,24.5s24.5-11,24.5-24.5S38.5,0.5,25,0.5z M25,45.4
        C13.7,45.4,4.6,36.3,4.6,25S13.7,4.6,25,4.6S45.4,13.7,45.4,25S36.3,45.4,25,45.4z" />
                            </g>
                        </g>
                    </g>
                </svg>
                Info</a>
            <a class="nav-item nav-link" id="nav-Products-tab" data-toggle="tab" href="#nav-Products" role="tab"
                aria-controls="nav-Products" aria-selected="false">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                    style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <g id="Layer_11">
                        <path class="st0" d="M37.9,17.8h-0.9v-5c0-6.7-5.4-12.1-12.1-12.1S12.9,6.2,12.9,12.8v5h-0.9c-3.6,0-6.5,2.9-6.5,6.5v18.5
      c0,3.6,2.9,6.5,6.5,6.5h25.8c3.6,0,6.5-2.9,6.5-6.5V24.3C44.4,20.7,41.5,17.8,37.9,17.8z M16.2,12.8C16.2,8,20.1,4,25,4
      c4.9,0,8.8,4,8.8,8.8c0,0,0,0,0,0v5H16.2V12.8z M41.1,42.8c0,1.8-1.4,3.2-3.2,3.2H12.1c-1.8,0-3.2-1.4-3.2-3.2V24.3
      c0-1.8,1.4-3.2,3.2-3.2h25.8c1.8,0,3.2,1.4,3.2,3.2V42.8z" />
                        <path class="st0" d="M25,28.1c-1.7,0-3.1,1.4-3.1,3.1c0,0.9,0.3,1.7,1,2.3v3.8c0,0.9,0.7,1.6,1.6,1.6h1.1c0.9,0,1.6-0.7,1.6-1.6
      v-3.8c1.2-1.2,1.3-3.2,0.1-4.4C26.7,28.5,25.9,28.1,25,28.1z" />
                    </g>
                </svg>
                Password</a>
                @if(GetActiveGuardDetail()->is_web == 1)
            <a class="nav-item nav-link" id="nav-picture-tab" data-toggle="tab" href="#nav-picture" role="tab"
                aria-controls="nav-picture" aria-selected="false">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                    style="enable-background:new 0 0 50 50;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M24.7,24.1c3.2,0,6-1.2,8.3-3.4c2.3-2.3,3.4-5.1,3.4-8.3c0-3.2-1.2-6-3.4-8.3c-2.3-2.3-5.1-3.4-8.3-3.4
      c-3.2,0-6,1.2-8.3,3.4s-3.4,5.1-3.4,8.3c0,3.2,1.2,6,3.4,8.3C18.7,22.9,21.5,24.1,24.7,24.1z M18.4,6.1c1.8-1.8,3.8-2.6,6.3-2.6
      c2.5,0,4.5,0.9,6.3,2.6c1.8,1.8,2.6,3.8,2.6,6.3c0,2.5-0.9,4.5-2.6,6.3c-1.8,1.8-3.8,2.6-6.3,2.6c-2.5,0-4.5-0.9-6.3-2.6
      c-1.8-1.8-2.6-3.8-2.6-6.3C15.8,9.9,16.7,7.8,18.4,6.1z" />
                        <path class="st0" d="M45.3,38.1c-0.1-1-0.2-2-0.4-3.1c-0.2-1.1-0.5-2.1-0.8-3.1c-0.3-1-0.7-2-1.3-2.9c-0.5-1-1.2-1.8-1.9-2.5
      c-0.8-0.7-1.7-1.3-2.8-1.7c-1.1-0.4-2.3-0.6-3.5-0.6c-0.5,0-1,0.2-1.9,0.8c-0.6,0.4-1.2,0.8-2,1.3c-0.6,0.4-1.5,0.8-2.6,1.1
      c-1,0.3-2.1,0.5-3.1,0.5c-1,0-2.1-0.2-3.1-0.5c-1.1-0.3-1.9-0.7-2.6-1.1c-0.7-0.5-1.4-0.9-2-1.3c-0.9-0.6-1.4-0.8-1.9-0.8
      c-1.3,0-2.5,0.2-3.5,0.6c-1.1,0.4-2,1-2.8,1.7c-0.7,0.7-1.4,1.5-1.9,2.5c-0.5,0.9-1,1.9-1.3,2.9c-0.3,1-0.6,2-0.8,3.1
      c-0.2,1.1-0.3,2.1-0.4,3.1C4.7,39.1,4.6,40,4.6,41c0,2.5,0.8,4.6,2.4,6.1c1.6,1.5,3.7,2.3,6.2,2.3h23.5c2.5,0,4.6-0.8,6.2-2.3
      c1.6-1.5,2.4-3.6,2.4-6.1C45.4,40,45.3,39.1,45.3,38.1z M41,45.1c-1,1-2.4,1.5-4.2,1.5H13.3c-1.8,0-3.2-0.5-4.2-1.5
      c-1-1-1.5-2.3-1.5-4.1c0-0.9,0-1.8,0.1-2.7c0.1-0.9,0.2-1.8,0.4-2.8c0.2-1,0.4-1.9,0.7-2.7c0.3-0.8,0.6-1.6,1-2.4
      c0.4-0.7,0.9-1.3,1.4-1.9c0.5-0.5,1.1-0.9,1.8-1.1c0.7-0.3,1.4-0.4,2.3-0.4c0.1,0.1,0.3,0.2,0.6,0.3c0.6,0.4,1.3,0.8,2,1.3
      c0.8,0.5,1.9,1,3.2,1.4c1.3,0.4,2.7,0.6,4,0.6c1.3,0,2.7-0.2,4-0.6c1.3-0.4,2.4-0.9,3.2-1.4c0.8-0.5,1.4-0.9,2-1.3
      c0.3-0.2,0.5-0.3,0.6-0.3c0.8,0,1.6,0.2,2.3,0.4c0.7,0.3,1.3,0.7,1.8,1.1c0.5,0.5,1,1.1,1.4,1.9c0.4,0.8,0.8,1.6,1,2.3
      c0.3,0.8,0.5,1.8,0.7,2.7c0.2,1,0.3,1.9,0.4,2.8v0c0.1,0.9,0.1,1.8,0.1,2.7C42.5,42.8,42,44.1,41,45.1z" />
                    </g>
                </svg>
                Profile Picture</a>
                @endif
            <a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab"
                aria-controls="nav-notification" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                  </svg>
                Notifications</a>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-Employee" role="tabpanel" aria-labelledby="nav-Employee-tab">


                <div class="form-wrap p-0 UserProfile">
                    <div class="row">
                        <div class="col-md-6 p-col-L">
                            <div class="form-group">
                                <b class="control-label mb-5">Full Name</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->name != null ? GetActiveGuardDetail()->name : 'NA' }}</b>
                            </div>
                        </div>
                        <div class="col-md-6 p-col-R">
                            <div class="form-group">
                                <b class="control-label mb-5">Phone No</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->phone != null ? GetActiveGuardDetail()->phone : 'NA' }}</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-col-L">
                            <div class="form-group">
                                <b class="control-label mb-5">Email ID</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->email != null ? GetActiveGuardDetail()->email : 'NA' }}</b>
                            </div>
                        </div>
                        @if(GetActiveGuardDetail()->is_web == 1)
                        <div class="col-md-6 p-col-R">
                            <div class="form-group">
                                <b class="control-label mb-5">ID No</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->cnic ? GetActiveGuardDetail()->cnic : 'NA' }}</b>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6 p-col-R">
                            <div class="form-group">
                                <b class="control-label mb-5">Postal Code</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->postal_code ? GetActiveGuardDetail()->postal_code : 'NA' }}</b>
                            </div>
                        </div>
                        
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-col-L">
                            <div class="form-group">
                                <b class="control-label mb-5">City</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->city ? GetActiveGuardDetail()->city : 'NA' }}</b>
                            </div>
                        </div>
                        <div class="col-md-6 p-col-R">
                            <div class="form-group">
                                <b class="control-label mb-5">Address</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->address ? GetActiveGuardDetail()->address : 'NA' }} </b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(GetActiveGuardDetail()->is_web == 1)
                        <div class="col-md-6 p-col-L">
                            <div class="form-group">
                                <b class="control-label mb-5">Designation</b>
                                <b class="u-info">{{ $designation_name }} </b>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6 p-col-L">
                            <div class="form-group">
                                <b class="control-label mb-5">POC Name</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->poc_name ? GetActiveGuardDetail()->poc_name : 'NA' }} </b>
                            </div>
                        </div>
                        <div class="col-md-6 p-col-R">
                            <div class="form-group">
                                <b class="control-label mb-5">POC Phone</b>
                                <b class="u-info">{{ GetActiveGuardDetail()->poc_phone_number ? GetActiveGuardDetail()->poc_phone_number : 'NA' }} </b>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-Products" role="tabpanel" aria-labelledby="nav-Products-tab">

                <div id="floating-label" class="card" style="box-shadow: none;background-color: transparent;">
                    <h2 class="_head03 mb-15">Change <span>Password</span></h2>
                    <form style="display: flex; width:100%" id="changePasswordForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"> <label class="control-label mb-10">Current Password*</label>
                                    <input style="font-size: 13px" type="password" name="current_password"
                                        id="current_password" class="form-control" placeholder="" value=""> </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label class="control-label mb-10">New Password*</label> <input
                                        style="font-size: 13px" type="password" class="form-control" id="new_password"
                                        placeholder="" value=""> </div>
                            </div>
                            <div class="col-md-6 _ch-pass-p"> Minimum 6 Characters </div>
                            <div class="col-md-6">
                                <div class="form-group"> <label class="control-label mb-10">Confirm Password*</label>
                                    <input style="font-size: 13px" type="password" class="form-control"
                                        name="confirm_password" id="confirm_password" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-md-12 PT-10"> <button type="button" class="btn btn-primary mr-2 mb-10"
                                    id="update_userpassword">Save Changes</button> <button
                                    class="btn btn-cancel mr-2 mb-10" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="true"
                                    aria-controls="collapseExample">Cancel</button> </div>
                        </div>
                    </form>

                </div>

            </div>
            @if(GetActiveGuardDetail()->is_web == 1)
            <div class="tab-pane fade" id="nav-picture" role="tabpanel" aria-labelledby="nav-picture-tab">

                <div class="row">
                    <div class="col-12">
                        <form style="display: flex; width:100%" id="saveEditProfilePictureForm">
                            {!! Form::hidden('tokenForAjaxReq', csrf_token()) !!}
                            @csrf
                            <input type="text" hidden name="user_id" value="{{ GetActiveGuardDetail()->id }}" />
                            <div>
                                <div class="col-md-6">
                                    <div class="form-wrap up_h" style="width:100px;">
                                        <div class="upload-pic"></div>
                                        <input type="file" id="input-file-now" class="dropify" name="employeePicture"
                                            data-default-file="{{ Auth::user()->picture ? URL::to(Auth::user()->picture) : '' }}"
                                            accept="image/*"data-allowed-file-extensions="jpg png jpeg tif tiff pjp webp xbm jxl jfif bmp avif ico gif" />
                                    </div>
                                    <button type="button" class="btn btn-primary"
                                        id="save_pic_user_profile">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">

                <div class="form-wrap p-0">
                    <div class="row m-0" style="margin-top:-15px!important">
                        @csrf
                        <table class="table table-bordered dt-responsive AssNotification" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Notification</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="table_notif">

                                @if(!empty($notitfication_actions))
                                @foreach($notitfication_actions as $notif)
                                <tr>
                                    <td>{{ $notif->name }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="notification_permissions" value="notifiable"
                                                id="{{ $notif->id }}" class="check_box {{ $notif->id }}" {{$notif->sub_noti == 1 ? 'checked' : ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="notification_permissions" value="email"
                                                id="{{ $notif->id }}" class="check_box {{ $notif->id }}" {{$notif->sub_email == 1 ? 'checked' : ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <input type="hidden" id="all_notification_list" value="{{json_encode(@$notitfication_actions)}}">
                            <input type="hidden" value="{{GetActiveGuardDetail()->id}}" id="employee_id">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary sm-mt15" id="update_emp_pref">Save</button>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>
@endsection
