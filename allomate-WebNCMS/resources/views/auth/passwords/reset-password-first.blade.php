<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="admin/css/style.css" rel="stylesheet">
</head>

<body class="bg_main">

    <div id="wrapper" class="EbobBGImg">
        <div class="log_con">

            <div class="container">
                <img class="Loging-Logo" src="admin/images/allomate-logo-w.svg" alt="" />
                <!-- Row -->
                <div class="table-struct full-width">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form">

                            <div class="row m-0">
                                <div class="col-md-12 col-height">
                                    <div class="login-right">
                                        <div class="log-form">
                                            <div style="width: 310px; margin: auto">
                                                <h3 class="mb-20">Update <span>Password First</span></h3>
                                                <form method="POST" id="updatePasswordForm">
                                                    @csrf
                                                    <input type="hidden" name="user_id"
                                                        value="{{ encrypt(GetActiveGuardDetail()->id) }}">
                                                    <style>
                                                        .success-feedback {
                                                            margin-top: 0.25rem;
                                                            font-size: 80%;
                                                            color: #89d500;
                                                            font-weight: bolder;
                                                            margin-bottom: 5px;
                                                        }

                                                        .invalid-feedback {
                                                            font-weight: bolder;
                                                            color: red;
                                                            margin-bottom: 5px;
                                                        }
                                                    </style>
                                                    <div class="form-group">
                                                        <div class="user"> <span class="fa fa-user-alt"></span>
                                                            <input class="form-control" type="password"
                                                                id="new_password" name="new_password"
                                                                placeholder="New Password">
                                                            @if ($errors->has('username'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="clearfix"></div>
                                                        <div class="pass"> <span class="fa fa-unlock"></span>

                                                            <input class="form-control" type="password"
                                                                id="confirm_password" name="confirm_password"
                                                                placeholder="Confirm New Password">
                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <span class="invalid-feedback" style="display: block;font-size:13px"
                                                        role="alert">

                                                    </span>

                                                    <div class="form-group mb-0 mt-10">
                                                        <button type="button" id="update_password_btn"
                                                            class="btn btn-info  btn-login"
                                                            style="width:auto">Update
                                                            <span>Password</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>

                </div>
                <div class="Log_footer">Copyright © {{ date('Y') }} {{ config('app.name') }} All rights reserved.
                    <br> Design &amp; Developed by <a href="https://allomate.com" target="_blank">Allomate Solutions</a>
                </div>
            </div>

        </div>
        <!--	<div class="ebobLog"><img src="images/login-img.png"  alt=""/></div>-->
    </div>
    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script> --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '#update_password_btn', function() {

                if ($('#new_password').val() == "" || $('#confirm_password').val() == "") {

                    $('.invalid-feedback').show();
                    $('.invalid-feedback').html('Fill all required fileds');
                    return;
                }
                if ($('#new_password').val() != "" || $('#confirm_password').val() != "") {

                    if ($('#new_password').val() != $('#confirm_password').val()) {
                        $('.invalid-feedback').show();
                        $('.invalid-feedback').html('New Password and Confirm Password does not match!');
                        return;
                    }
                    if ($('#new_password').val().length < 6 || $('#confirm_password').val().length < 6) {
                        $('.invalid-feedback').css('display', 'block')
                        $('.invalid-feedback').html(
                            'New Password and Confirm Password should have atleast 6 characters');
                        return;
                    }
                }
                $('.invalid-feedback').hide();
                $(this).text('PROCESSING...');
                $(this).attr("disabled", "disabled");
                $('#updatePasswordForm').ajaxSubmit({
                    type: "POST",
                    url: "/update_user_password_first",
                    cache: false,
                    success: function(response) {
                        console.log(response)
                        $("#update_userpassword").removeAttr('disabled');
                        $("#update_userpassword").text('Update Password');
                        if (JSON.parse(response) == "success") {
                            $('.success-feedback').css('display', 'block');
                            $('.success-feedback').html('Password updated successfully');
                            setTimeout(() => {
                                window.location = '/admin/index';
                            }, 1000);
                        } else if (JSON.parse(response) == "failed") {
                            $('.invalid-feedback').html('Unable to update at this moment');
                        }
                    }
                });
            });
        })
    </script>
</body>

</html>
