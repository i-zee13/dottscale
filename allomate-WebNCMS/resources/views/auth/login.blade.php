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
                <img class="Loging-Logo" src="{{ url('/images/dottscale-logo-alt.png') }}" alt="DottScale" />
                <!-- Row -->
                <div class="table-struct full-width">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form">

                            <div class="row m-0">
                                <div class="col-md-12 col-height">
                                    <div class="login-right">
                                        <div class="log-form">
                                        <div style="width: 310px; margin: auto">
                                            <h3 class="mb-20">LOG <span>IN</span></h3>
                                            <form method="POST" action="{{route('mylogin')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="user"> <span class="fa fa-user-alt"></span>
                                                        <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                                                        @if ($errors->has('username'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="clearfix"></div>
                                                    <div class="pass"> <span class="fa fa-unlock"></span>
                                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>

                                                        @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (Route::has('password.request'))
                                                <a class="f_pass" href="{{ route('password.request') }}">Forgot password?</a>
                                                @endif
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-info btn-login">LOG <span>IN</span></button>
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
                <div class="Log_footer">Copyright © {{ date('Y') }} DottScale. All rights reserved.</div>
            </div>

        </div>
        <!--	<div class="ebobLog"><img src="images/ebob-img.png"  alt=""/></div>-->
    </div>

    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>

</html>