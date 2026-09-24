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
    <script type="application/ld+json">
        {
            {
                !!$meta_structure_tags!!
            }
        }
    </script>
    @else
    {!! JsonLd::generate() !!}
    @endif

    <link rel="preload" rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="preload" rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/frontend/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/select2-bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/jquery.mCustomScrollbar.css')}}">
    <link href="{{ asset('admin/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/theme_config.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/menu.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $uri_segments = $uri_segments[1];
    ?>
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/webpagesbuilder.css')}}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    @if ($uri_segments && $uri_segments == 'career')
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/career.css')}}">
    @endif
    @if ($uri_segments && $uri_segments == 'blogs')
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/blog.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.css">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend/footer.css')}}">
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

        .select2-container--open .select2-dropdown--above,
        .select2-container--open .select2-dropdown--below {
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

        form p {
            font-size: 0.8125rem !important;
            margin-bottom: 0px !important;
        }

        /* section{ 
            transition: background-color 550ms linear;
        } */
        section.is-dark {
            height: 100%;
            /* transition: opacity 0.5s linear */
        }

        section.is-white {
            height: 100%;
            /* transition: opacity 0.5s linear */
        }


        .is-dark {
            background-color: #001e35;
        }

        /* .padding-set {
            padding: 160px 0 100px !important;
        } */
        @stack('builder-css')
    </style>
    @if(@$tagManagerHeader)
    {!! @$tagManagerHeader !!}
    @endif
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
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
    /* <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> */
    <script src="{{ asset('js/frontend/select2.min.js') }}"></script>
    <script src="{{asset('js/frontend/jquery.mCustomScrollbar.min.js')}}"></script>
    <script src="{{asset('js/frontend/custom/contact-form.js')}}"></script>
    <script src="{{asset('js/frontend/custom/pr-contact-form.js')}}"></script>
    <script src="{{ asset('/js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('/js/custom/frontend/subscriber-form.js') }}"></script>
    <script src="{{ asset('admin/js/dropify.min.js') }}"></script>
    /* <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> */
    @if ($uri_segments && $uri_segments == 'blogs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
    @endif
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="{{ asset('js/frontend/custom/basic.js') }}"></script>
    <script>
        $(document).ready(function() {

            function updateMenuIcon() {

                var menuIcon = document.getElementById("top-header");
                var sections = document.querySelectorAll("section");
                var windowHeight = window.innerHeight;
                var scrollPosition = window.scrollY;


                sections.forEach(function(section) {
                    var sectionTop = section.offsetTop;
                    var sectionHeight = section.offsetHeight;

                    // Calculate where the 70% mark of the viewport is
                    var triggerPoint = scrollPosition + windowHeight * 0.5; // 50% from the top
                    var sectionBottom = sectionTop + sectionHeight;

                    if (triggerPoint >= sectionTop && triggerPoint < sectionBottom) {
                        $('.section-dark').css('background-color', 'transparent');
                        $('body').css('background-color', '#001e35');
                        // This checks if the section meets the threshold point (within the 70% from the top)
                        if (section.classList.contains("section-dark")) {
                            $('body').css('transition', 'background-color 1s ease, opacity 1s ease');
                            menuIcon.classList.add("dark-menu-icon");
                            // $(section).removeClass("is-white");
                            // $(section).addClass("padding-set"); 
                            // if ($(section).css("opacity") == 0) {
                            // $(section).addClass("is-dark");
                            $('section').each(function() {
                                if ($(this).hasClass("section-dark")) {
                                    $(this).css("opacity", 1);
                                } else {
                                    $(this).css("opacity", 0);
                                }
                            });
     // Apply body color change for dark section without transition flicker
    //  $('body').css('background-color', '#001e35'); // Set dark background instantly

// Apply section opacity changes
// $('section').each(function() {
//     if (!$(this).hasClass("section-dark")) {
//         $(this).css({
//             'opacity': 0,
//             'transition': 'opacity 0.5s ease' // Smooth opacity change for non-dark sections
//         });
//     } else {
//         $(this).css({
//             'opacity': 1,
//             'transition': 'opacity 0.5s ease' // Smooth opacity change for dark section
//         });
//     }
// });
                            // }
                        } else {
                            $('body').css('transition', 'background-color 1s ease,opacity 1s ease');
                            // $(section).addClass("is-white"); 

                            menuIcon.classList.remove("dark-menu-icon");

                            $('section').each(function() {
                                if (!$(this).hasClass("section-dark")) {
                                    $(this).css("opacity", 1);
                                } else {
                                    $(this).css("opacity", 0);
                                }
                            });
                            $('body').css('background-color', '#f6f6f6');
                            // $(section).removeClass("is-dark");
                        }
                    }
                });
            }


            window.addEventListener("load", updateMenuIcon);
            window.addEventListener("scroll", updateMenuIcon);

            $(function() {
                $(".mil-menu-btn").on("click", function() {
                    $(".mil-menu-btn").toggleClass("mil-active");
                    $(".mil-menu").toggleClass("mil-active");
                    $(".mil-menu-frame").toggleClass("mil-active");
                    $("body").toggleClass("mil-active");
                });

                $(".mil-has-children a").on("click", function() {
                    $(".mil-has-children ul").removeClass("mil-active");
                    $(".mil-has-children a").removeClass("mil-active");
                    $(this).toggleClass("mil-active");
                    $(this).next().toggleClass("mil-active");
                });
            });
        });
        $(document).on('input', '.only_alphabets', function() {
            this.value = this.value.replace(/[^a-z\s.]/gi, '');
        });
        $(document).on('input', '.only_phone', function() {
            this.value = this.value.replace(/[^0-9+\s]/g, '');
        });
        $(".formselect").select2();
        /* AOS.init({
            duration: 1000,
            offset: 200,
        }); */
    </script>
    @stack('js')
</body>

</html>