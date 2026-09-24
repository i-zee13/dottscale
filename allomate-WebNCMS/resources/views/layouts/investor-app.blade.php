<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>DottScale</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/investor/css/bootstrap.min.css">
    <link href="/investor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/investor/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="/investor/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/investor/css/select2-bootstrap4.css">
    <link href="/investor/css/datepicker.css" rel="stylesheet">
    <link href="/investor/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="/investor/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/investor/css/style.css">
    <link rel="stylesheet" type="text/css" href="/investor/css/menu.css">
    <link rel="stylesheet" type="text/css" href="/investor/css/product.css">
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
            left: 12%;
            z-index: 10000;
            padding: 10px 20px
        }
    </style>
    {{-- <script>
    let base_url = window.location.origin;
    alert(base_url)
  </script> --}}
</head>

<body>
    <?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $uri_segments1 = $uri_segments[1];
    $uri_segments2 = $uri_segments[2];
    ?>
    <div id="notifDiv"></div>
    <div class="overlay"></div>
    @include('includes.investor-nav')
    <div id="wrapper">
        <div id="content-wrapper">
            <div class="overlay-blure"></div>
            <div id="blureEffct" class="container PB-30">
                @yield('content')
                @if($uri_segments2 && $uri_segments2 != "profile")
                @include('layouts.investor-footer')
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2.min.js') }}"></script>

    <script src="{{ asset('admin/js/dropify.min.js') }}"></script>
    <script src="{{ asset('admin/js/form-file-upload-data.js') }}"></script>
    <script src="{{ asset('admin/js/dropzone.js') }}"></script>
    <script src="{{ asset('admin/js/dropzone-data.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('admin/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/js/list.js') }}"></script>

    <script src="{{ asset('/js/master.js') }}"></script>
    <script>
        $(document).on('input', '.only_phone', function() {
            this.value = this.value.replace(/[^0-9+\s]/g, '');
        });
        $(document).on('input', '.only_alphabets', function() {
            this.value = this.value.replace(/[^a-z\s.]/gi, '');
        });
        let dateTimeFormat = "yyyy-mm-dd hh:ii";
        let dateFormat = "yyyy-mm-dd";
        let timeFormat = "hh:ii";
        var allControllersData = JSON.parse('{!! json_encode($allControllers) !!}');

        var rightsGiven = JSON.parse('{!! json_encode($userPermissions) !!}');
        var isWeb = {{ json_encode($isWeb) }};

        var currentSegment = '{!! Request::segment(1) !!}';
        var csrfToken = $('[name="csrf_token"]').attr('content');

        var controller = '{!! $controller !!}';
        $(".sortable").sortable();
        $('.form-control').on('focus blur', function(e) {
                $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
            })
            .trigger('blur');

        $('.form-control').on('focus blur', function(e) {
                $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
            })
            .trigger('blur');
        $(".formselect").select2();
        $('.sd-type').select2({
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                }
            }
        });

        $('#tags').select2({
            tags: true,
            // data: ["tag1","tag2"],
            tokenSeparators: [','],
            placeholder: "Add Tags",
            /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
            selectOnClose: true,
            closeOnSelect: false
        });
        $(document).on('click', '.red-bg', function() {
            $('.swal-button--cancel').removeAttr('tabindex', '0');
        });
    </script>
    @stack('js')
</body>

</html>
