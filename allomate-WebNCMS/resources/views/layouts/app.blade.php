<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2-bootstrap4.css') }}">

    <link href="{{ asset('admin/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fSelect.css') }}">
    @yield('page-style')
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
        .dt-buttons .dt-button, .dt-buttons .dt-button:hover {
            background: linear-gradient(90deg, #2f4a70 0%, #3c5980 100%);
            border: 1px solid #2f4a70 !important;
            color: #fff !important;
            outline: none !important;
            padding: 5px 10px !important;
            line-height: 1 !important;
            font-size: 13px !important;
            letter-spacing: 1px;
        }
    </style>
    {{-- <script>
    let base_url = window.location.origin;
    alert(base_url)
  </script> --}}
</head>

<body id="page-top">
    <div id="notifDiv"></div>
    <div class="overlay"></div>
    <div id="app">
        @include('includes.nav-new')
        <div id="wrapper">
            <div id="content-wrapper">
                <div class="overlay-blure"></div>
                @yield('data-sidebar')
                <div class="container">
                    @yield('content')

                </div>
                @include('layouts.footer')
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

    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.33/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script src="{{ asset('/js/master.js') }}"></script>
    <script>
        let dateTimeFormat = "yyyy-mm-dd hh:ii";
        let dateFormat = "yyyy-mm-dd";
        let timeFormat = "hh:ii";
        var allControllersData = {!! json_encode($allControllers ?? []) !!};
        var rightsGiven = {!! json_encode($userPermissions ?? ['admin/index', 'admin/profile']) !!};
        var isWeb = {{ json_encode($isWeb ?? 1) }};

        var currentSegment = '{!! Request::segment(1) !!}';
        var csrfToken = $('[name="csrf_token"]').attr('content');

        var controller = '{!! $controller !!}';
        $(".sortable").sortable();

        $(document).ready(function() {

            $('#example').DataTable();
            $('#pl-close, .overlay').on('click', function() {
                $('#product-cl-sec').removeClass('active');
                $('.overlay').removeClass('active');
                $('body').removeClass('no-scroll')
            });
            $('#productlist01').on('click', function() {
                $('#product-cl-sec').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                $('body').addClass('no-scroll')
            });
        });

        $(document).ready(function() {

            $('#SN-close, .overlay-blure').on('click', function() {
                $('.hide-leads-menu').removeClass('active');
                $('#content-wrapper').removeClass('blur-div');
                $('body').removeClass('no-scroll')
            });
            $('#open-side-service').on('click', function() {
                $('.overlay-blure').click();
                $('.open-side-service').addClass('active');
                $('#content-wrapper').addClass('blur-div');
                $('body').addClass('no-scroll')
            });
            $('#open-side-blog').on('click', function() {
                $('.overlay-blure').click();
                $('.open-side-blog').addClass('active');
                $('#content-wrapper').addClass('blur-div');
                $('body').addClass('no-scroll')
            });
            $('#open-side-leads').on('click', function() {
                $('.overlay-blure').click();
                $('.open-side-leads').addClass('active');
                $('#content-wrapper').addClass('blur-div');
                $('body').addClass('no-scroll')
            });
            $('#open-side-webpages').on('click', function() {
                $('.overlay-blure').click();
                $('.open-side-webpages').addClass('active');
                $('#content-wrapper').addClass('blur-div');
                $('body').addClass('no-scroll')
            });
            $('#open-side-career').on('click', function() {
                $('.overlay-blure').click();
                $('.open-side-career').addClass('active');
                $('#content-wrapper').addClass('blur-div');
                $('body').addClass('no-scroll')
            });
        });
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
        })

        function initializeCKEditor(editorId, height) {
            CKEDITOR.replace(editorId, {
                height: height,
                toolbar: 'Classic',
                removePlugins: 'blockquote,about',
                toolbarStartupExpanded: false,
                contentsCss: ['../css/menu.css?v=6.4'],
                format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;div',
                stylesSet: 'custom_styles',
            });

            CKFinder.setupCKEditor(CKEDITOR.instances[editorId]);
        }
    </script>
    @stack('js')
</body>

</html>
