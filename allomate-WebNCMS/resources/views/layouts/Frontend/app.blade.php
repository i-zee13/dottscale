<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DottScale | Boost Your Digital Impact')</title>
    <meta name="description" content="@yield('meta_description', 'DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta name="article:publisher" content="www.facebook.com/dottscalee/">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow">
    <meta property="og:description" content="@yield('og_description', 'Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads.')">
    <meta property="og:type" content="website">
    <meta property="og:image:alt" content="DottScale">
    <meta property="og:image:type" content="image/png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/dottscale-logo-alt.png') }}">
    <meta property="og:image:height" content="1000">
    <meta property="og:image:width" content="1000">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'DottScale')">
    <meta name="twitter:description" content="@yield('og_description', '')">
    <meta name="twitter:image" content="{{ asset('images/dottscale-logo-alt.png') }}">

    <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"WebPage","url":"{{ url()->current() }}"}</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('images/favicon-32.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon-32.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/dottscale.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @stack('head')
</head>
<body class="relative font-secondary bg-primary">
<img src="/images/hero-img01.webp?v=2" width="1680" sizes="100vw" alt="bg-image" class="pointer-events-none fixed inset-0 -z-10 hidden min-[1441px]:block h-screen w-screen object-cover">
    <img src="/images/hero-img1440.webp?v=2" width="1440" sizes="100vw" alt="bg-image" class="pointer-events-none fixed inset-0 -z-10 hidden md:block min-[1441px]:hidden h-screen w-screen object-cover">
    <img src="/images/main-bg-mobile.webp?v=2" width="425" sizes="100vw" alt="bg image" class="pointer-events-none fixed inset-0 -z-10 block md:hidden h-screen w-screen object-cover">

    
    <div id="notifDiv"></div>
    <div class="overlay first all-page"></div>

    @include('layouts.Frontend.partials.menu')
    @include('layouts.Frontend.partials.header')

    <main>
        <input type="hidden" value="{{ url('/') }}" id="app_url">
        <input type="hidden" value="1" id="pagebuilder_page_id">
        <input type="hidden" value="{&quot;organizationRecord&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;DottScale&quot;,&quot;phone_number&quot;:&quot;+1 (512) 564-8959&quot;,&quot;email&quot;:&quot;contact@dottscale.com&quot;,&quot;address&quot;:&quot;Austin, Texas, United States&quot;,&quot;city_id&quot;:&quot;150092&quot;,&quot;postal_code_id&quot;:&quot;71&quot;,&quot;state_id&quot;:&quot;5094&quot;,&quot;country_id&quot;:&quot;276&quot;,&quot;logo_img&quot;:&quot;images\/9n2eqc8PqNfieN48EOakaDCSYAmQA9s4gmIpBDUG.jpg&quot;,&quot;clutch_link&quot;:&quot;www.facebook.com\/dottscalee\/&quot;,&quot;behance_link&quot;:&quot;www.pinterest.com\/dottscale&quot;,&quot;dribble_link&quot;:null,&quot;fb_link&quot;:&quot;www.facebook.com\/dottscalee\/&quot;,&quot;insta_link&quot;:&quot;www.instagram.com\/dottscale&quot;,&quot;linkedin_link&quot;:&quot;www.linkedin.com\/company\/dottscale\/&quot;,&quot;youtube_link&quot;:null,&quot;twitter_link&quot;:&quot;www.pinterest.com\/dottscale&quot;,&quot;footer_ticker&quot;:&quot;Trusted by Startups. Chosen by Enterprises. Driven by Results.&quot;,&quot;footer_text&quot;:&quot;Think Forward. Go Digital.&quot;,&quot;notification_received_email&quot;:&quot;fakharbhatti6@gmail.com&quot;,&quot;page_meta_tags&quot;:&quot;{\&quot;page_title\&quot;:null,\&quot;meta_content_author\&quot;:null,\&quot;meta_tag_name\&quot;:null,\&quot;meta_keywords\&quot;:null,\&quot;meta_description\&quot;:null,\&quot;meta_og_title\&quot;:null,\&quot;meta_og_description\&quot;:null,\&quot;meta_structure_tags\&quot;:null,\&quot;is_indexable\&quot;:\&quot;0\&quot;,\&quot;is_followable\&quot;:\&quot;0\&quot;,\&quot;meta_og_image\&quot;:null}&quot;,&quot;created_by&quot;:&quot;4&quot;,&quot;created_at&quot;:&quot;2025-11-07T12:57:44.000000Z&quot;,&quot;updated_by&quot;:&quot;4&quot;,&quot;updated_at&quot;:&quot;2025-11-07T12:57:44.000000Z&quot;,&quot;country_name&quot;:&quot;Pakistan&quot;,&quot;city_name&quot;:&quot;Lahore&quot;,&quot;location&quot;:[{&quot;id&quot;:&quot;6&quot;,&quot;location_name&quot;:&quot;Austin&quot;,&quot;phone_no&quot;:&quot;+923144227755&quot;,&quot;email&quot;:&quot;contact@dottscale.com&quot;,&quot;address&quot;:&quot;Austin, Texas, United States&quot;,&quot;country_id&quot;:&quot;276&quot;,&quot;state_id&quot;:&quot;5094&quot;,&quot;city_id&quot;:&quot;150092&quot;,&quot;postal_code_id&quot;:&quot;72&quot;,&quot;latitude&quot;:&quot;3453&quot;,&quot;longitude&quot;:&quot;23452&quot;,&quot;created_at&quot;:&quot;2025-09-19 09:59:20&quot;,&quot;created_by&quot;:&quot;4&quot;,&quot;updated_at&quot;:&quot;2025-09-19 09:59:20&quot;,&quot;updated_by&quot;:&quot;4&quot;,&quot;country&quot;:&quot;United States&quot;,&quot;city&quot;:&quot;Austin&quot;},{&quot;id&quot;:&quot;8&quot;,&quot;location_name&quot;:&quot;Contact&quot;,&quot;phone_no&quot;:&quot;0333-1223-2323&quot;,&quot;email&quot;:&quot;contact@dottscale.com&quot;,&quot;address&quot;:&quot;Get In Touch +1 (512) 564-8959&quot;,&quot;country_id&quot;:&quot;276&quot;,&quot;state_id&quot;:&quot;5094&quot;,&quot;city_id&quot;:&quot;150092&quot;,&quot;postal_code_id&quot;:&quot;72&quot;,&quot;latitude&quot;:&quot;2345&quot;,&quot;longitude&quot;:&quot;3245&quot;,&quot;created_at&quot;:&quot;2025-09-19 09:42:27&quot;,&quot;created_by&quot;:&quot;4&quot;,&quot;updated_at&quot;:&quot;2025-09-19 09:42:27&quot;,&quot;updated_by&quot;:&quot;4&quot;,&quot;country&quot;:&quot;United States&quot;,&quot;city&quot;:&quot;Austin&quot;}]},&quot;footerItems&quot;:{&quot;Quick Links&quot;:{&quot;footer_menu&quot;:[{&quot;url&quot;:&quot;\/home&quot;,&quot;title&quot;:&quot;Home&quot;},{&quot;url&quot;:&quot;\/blogs&quot;,&quot;title&quot;:&quot;Blogs&quot;},{&quot;url&quot;:&quot;\/career&quot;,&quot;title&quot;:&quot;Career&quot;},{&quot;url&quot;:&quot;\/about-us&quot;,&quot;title&quot;:&quot;About Us&quot;},{&quot;url&quot;:&quot;\/contact-us&quot;,&quot;title&quot;:&quot;Contact Us&quot;},{&quot;url&quot;:&quot;\/terms-of-use&quot;,&quot;title&quot;:&quot;Terms of Use&quot;},{&quot;url&quot;:&quot;\/privacy-policy&quot;,&quot;title&quot;:&quot;Privacy Policy&quot;},{&quot;url&quot;:&quot;\/sitemap&quot;,&quot;title&quot;:&quot;Sitemap&quot;}]}}}" id="organization-detail">

        @yield('content')
    </main>

    @include('layouts.Frontend.partials.footer')
    @include('layouts.Frontend.partials.scripts')
    @stack('scripts')
</body>
</html>
