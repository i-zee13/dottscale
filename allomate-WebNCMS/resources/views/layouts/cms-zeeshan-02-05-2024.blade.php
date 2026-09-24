<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=2">
    {{-- <title>Allomate Solutions</title> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}

    @if ($meta_structure_tags)
        <script type="application/ld+json">{    {!! $meta_structure_tags !!}    }</script>
    @else
        {!! JsonLd::generate() !!}
    @endif

    <link  rel="preload" rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link  rel="preload" rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link  rel="stylesheet" href="{{asset('css/frontend/bootstrap.min.css')}}">
    <link  rel="preload" rel="stylesheet" type="text/css" href="{{ asset('css/frontend/select2.min.css') }}">
    <link  rel="preload" rel="stylesheet" type="text/css" href="{{ asset('css/frontend/select2-bootstrap4.css') }}">
    <link  rel="preload" rel="stylesheet" type="text/css" href="{{asset('css/frontend/jquery.mCustomScrollbar.css')}}">
    <link  rel="preload" href="{{ asset('admin/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <link   rel="stylesheet" type="text/css" href="{{asset('css/frontend/theme_config.css')}}">
    <link   rel="stylesheet" type="text/css" href="{{asset('css/frontend/menu.css')}}">
    <?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $uri_segments = $uri_segments[1];
    ?>

    @if ($uri_segments && $uri_segments == 'insights')
        <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/blog.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/webpagesbuilder.css')}}">
    @if ($uri_segments && $uri_segments == 'career')
        <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/career.css')}}">
    @endif
    <link  rel="stylesheet" type="text/css" href="{{asset('css/frontend/footer.css')}}">
    <style>
        #notifDiv {
            display: none;
            background: red;
            color: white;
            font-weight: 400;
            font-size: 15px;
            width: 350px;
            position: fixed;
            top: 80%;
            left: 69%;
            z-index: 10000;
            padding: 10px 20px
        }

        @media (max-width:767px) {
            #notifDiv {
                font-size: 14px;
                top: auto;
                left: 15px;
                padding: 10px;
                bottom: 15px;
            }
        }

        .pagination-ul .pagination-list {
            display: inline-block;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #c3c3c3 !important;
            border-radius: var(--border-radius) !important;
        }
        .select2-container .select2-selection--single {
            height: 2.625rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 8px !important;
        }
        .select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below {
            border: solid 1px #c5c5c5 !important;
            border-bottom: solid 2px #3c5980 !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .175) !important
        }
        section a {
            color: var(--bs-primary);
        }

        section a:hover {
            color: var(--bs-secondary);
        }
        form p{
            font-size: 0.8125rem !important;
            margin-bottom: 0px !important;
        }

        @stack('builder-css')
    </style>
    @if(@$tagManagerHeader)
        {!! @$tagManagerHeader !!}
    @endif
</head>

<body>
    @if(@$tagManagerBody)
        {!! @$tagManagerBody !!}
    @endif
    <div id="notifDiv"></div>
    @include('layouts.Frontend.menu')
    <main>
        @yield('content')
    </main>
    @include('layouts.Frontend.footer')

    <script src="{{asset('js/frontend/jquery-3.4.0.min.js')}}"></script>
    <script src="{{asset('js/frontend/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/frontend/select2.min.js') }}"></script>
    <script src="{{asset('js/frontend/jquery.mCustomScrollbar.min.js')}}"></script>
    <script src="{{asset('js/frontend/custom/contact-form.js')}}"></script>
    <script src="{{asset('js/frontend/custom/pr-contact-form.js')}}"></script>
    <script src="{{ asset('/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('/js/frontend/custom/web-master.js') }}"></script>
    <script src="{{ asset('/js/custom/frontend/subscriber-form.js') }}"></script>
    <script src="{{ asset('admin/js/dropify.min.js') }}" ></script>
    @if ($uri_segments && $uri_segments == 'insights')
          <script src="{{ asset('/js/list.js') }}"></script>
    @endif 
    <script>
    $(document).on('input', '.only_alphabets', function() {
        this.value = this.value.replace(/[^a-z\s.]/gi, '');
    });
    $(document).on('input', '.only_phone', function() {
        this.value = this.value.replace(/[^0-9+\s]/g, '');
    });
    $(".formselect").select2();
    </script>
    @stack('js')
</body>

</html>
