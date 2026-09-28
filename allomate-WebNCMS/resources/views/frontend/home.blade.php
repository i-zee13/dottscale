@extends('layouts.Frontend.app')

@section('title')
DottScale | Boost Your Digital Impact
@endsection

@section('meta_description')
DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.
@endsection

@section('meta_keywords')

@endsection

@section('og_description')
Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads.
@endsection

@section('content')
@php
    $homeImg = function ($path, $fallback) {
        if (empty($path)) {
            return $fallback;
        }
        if (str_starts_with($path, 'http') || str_starts_with($path, '/')) {
            return $path;
        }
        return '/storage/' . ltrim($path, '/');
    };
    $heroHeading = $home?->heading_1 ?? 'We Help Local Businesses Get Found & Grow';
    $heroParagraph = $home?->heading_2 ?? "SEO, Google Ads, websites, and reputation—built to turn searches into calls.\nClear strategy. Measurable leads. No buzzword theater.";
    $aboutHeading = $home?->large_heading ?? 'Driven by Real Business Impact';
    $aboutParagraph = $home?->paragraph ?? 'We are not here to sell tools for the sake of tools. We help service businesses show up on Google, win trust, and book more work—with digital systems that actually move the needle.';
    $aboutCta = $home?->award_heading ?? 'Learn More About Us';
    $desktopImg = $homeImg($home?->desktop_img, '/images/hero-img01.webp?v=4');
    $mobileImg = $homeImg($home?->mobile_img, '/images/main-bg-mobile.webp?v=4');
    $aboutImg = $homeImg($home?->award_img, '/images/testimonials-img.png');
@endphp
<div class="IDL70G23RUJ9HEB4"></div>
<section class="z-[1] min-h-screen flex items-center relative IDMEJHT2SVHL8J813 IDMEJIKW527FZEE0">
    <div class="relative w-full">
        <figure class="overflow-hidden hidden sm:block"><img width="1504" height="579" src="{{ $desktopImg }}" alt="{{ $heroHeading }}" title="{{ $heroHeading }}" class="w-full h-screen object-cover"></figure>
        <figure class="overflow-hidden block sm:hidden"><img width="480" height="768" src="{{ $mobileImg }}" alt="{{ $heroHeading }}" title="{{ $heroHeading }}" class="w-full h-screen object-cover"></figure>
        <div class="container mx-auto px-3 sm:px-4">
            <div class="absolute top-0 bottom-0 right-auto m-auto flex items-center justify-center">
                <div class="mr-3">
                    <div class="text-bodybg bg-primary/15 border border-secondary/40 border-l-4 border-l-secondary shadow-[inset_0_0_40px_rgba(255,178,55,0.08)] rounded-2xl backdrop-blur-[30px] p-[20px] sm:p-10 w-full md:w-[790px] IDMEJHT2T0ABEI714 IDMEJIKW56QW3HA1"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex plus-icon2">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                            </path>
                        </svg>
                        <h1 data-raw-content="true" class="leading-none text-[26px] sm:text-[30px] md:text-[34px] lg:text-[40px] xl:text-[46px] font-primary font-bold text-white uppercase mb-3 md:mb-5">{!! nl2br(e($heroHeading)) !!}</h1>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg mb-2 md:mb-4 opacity-70">{!! nl2br(e($heroParagraph)) !!}</p><a href="/contact-us" title="Get Started" class="red-arrow-btn group bg-secondary text-primary rounded-full h-[40px] w-max px-5 flex items-center justify-center hover:px-7 focus:px-8 transition-all duration-300 ease-in-out IDMEJHT2TC8SMUO15 IDMEJIKW5BV7LFG2">Start the Conversation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 md:py-10 IDMELHLKGP4KI8K1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon1 z-[10]">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                </path>
            </svg>
            <figure> <img width="1000" height="1000" src="{{ $aboutImg }}" alt="{{ $aboutHeading }}" class="w-full h-[380px] sm:h-[450px] md:h-[600px] lg:h-[800px] object-cover rounded-[6px]"></figure>
            <div class="absolute bottom-[30px] right-0 sm:right-[10px] md:right-[30px] w-full sm:w-[50%] lg:w-[35%] p-3 md:p-6 bg-bodybg/10 sm:bg-bodybg/15 border border-white/10 border-l-4 border-l-secondary backdrop-blur-[15px] sm:backdrop-blur-[40px] rounded-2xl IDMELHLKGT9FEAJ2">
                <div class="min-h-[250px] md:min-h-[300px] flex flex-col justify-between items-start">
                    <div class="font-primary inline-block bg-secondary/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-full pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px] IDMELHLKGTZ46X23">
                        <p data-raw-content="true"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                                </path>
                            </svg> About Us</p>
                    </div>
                    <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold text-bodybg font-primary mb-3 sm:mb-5 flex">{{ $aboutHeading }}</h2>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm md:text-base text-bodybg/70 capitalize mb-3 md:mb-6">{{ $aboutParagraph }}</p><a href="about-us" title="Explore the Framework" class="red-arrow-btn group mt-4 pr-10 bg-secondary text-primary rounded-full h-[40px] w-max px-5 flex items-center justify-center hover:px-7 focus:px-8 transition-all duration-300 ease-in-out IDMELHLKH0Z6SKJ4">{{ $aboutCta }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@verbatim
                    <section class="py-5 md:py-10 home-our-services IDMEH5PS2RJVLE01">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4 md:mb-8">
            <div>
                <div class="font-primary inline-flex items-center gap-1 bg-secondary/20 text-bodybg text-[11px] rounded-full pr-4 pl-2 py-1 mb-3 uppercase tracking-[2px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                    What we do
                </div>
                <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary">
                    Growth services built for local businesses
                </h2>
            </div>
            <p class="font-secondary text-sm sm:text-base text-bodybg/70 max-w-md sm:text-right">SEO, ads, websites, and reputation—packaged to get you found, chosen, and booked.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
            <a href="services/enterprise-solutions" title="Local SEO" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/chart.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Local SEO</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">Rank in the Map Pack, own “near me” searches, and turn local intent into steady calls.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
            <a href="services/web-and-mobile-development" title="Website Design" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/mobile-app.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Website Design</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">Fast, mobile-first sites built to convert visitors into booked jobs—not just look pretty.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
            <a href="services/mvp-design-and-development" title="Google Ads" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/cube.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Google Ads</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">Campaigns aimed at buyers ready to call—tight keywords, clear offers, tracked ROI.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
            <a href="services/quality-assurance" title="Reputation Management" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/warranty.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Reputation Management</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">More 5-star reviews and smart replies so customers choose you before the first call.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
            <a href="services/ai-and-automation" title="Social Media Marketing" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/artificial-intelligence.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Social Media Marketing</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">Consistent presence that supports SEO and keeps your brand visible between searches.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
            <a href="services/dedicated-teams" title="CRM & IT Solutions" class="group relative flex flex-col justify-between min-h-[200px] p-5 md:p-6 rounded-2xl bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary hover:bg-bodybg/15 hover:-translate-y-1 transition-all duration-300 ease-in-out">
                <div>
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-secondary/20 mb-4">
                        <img src="/cms-uploads/teamwork.svg" alt="" width="24" height="24" class="w-6 h-6 object-contain filter invert brightness-0 opacity-90">
                    </span>
                    <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">CRM &amp; IT Solutions</h3>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm text-bodybg/70">Tools and workflows that keep leads, jobs, and follow-ups organized as you scale.</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-secondary text-sm font-medium">Explore <span class="group-hover:translate-x-1 transition-transform">→</span></span>
            </a>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 home-video-3-section IDMFF04WUVAD9RR1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[70%] lg:w-[60%] m-auto text-center mb-4 md:mb-8 flex items-center justify-center flex-col">
            <div class="font-primary inline-block bg-secondary/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-full pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px] IDMFF04WUYT3M972">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"> </path>
                    </svg> Tangible Results</p>
            </div>
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-1.5 md:mb-3">Proof across industries, not pitches</h2>
            <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70 mb-3 md:mb-5">From local service growth to SaaS adoption, our work shows up in the numbers. Every result here is earned, measured, and real.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6 m-auto">
            <div class="h-auto md:h-[500px] order-2 md:order-1">
                <div class="h-auto md:h-[200px] mb-3 justify-between bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary backdrop-blur-[40px] rounded-2xl p-[12px] md:p-[20px] flex flex-col content-baseline relative IDMFF04WVB4NU2K3">
                    <h2 data-raw-content="true" class="uppercase text-[20px] md:text-[24px] font-semibold text-secondary mb-1">40% Productivity</h2>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">The average lift when manual processes are replaced with clearer digital systems.</p>
                </div>
                <div class="relative w-full h-[288px] overflow-hidden rounded-2xl"><video allowfullscreen="allowfullscreen" title="" autoplay="" loading="eager" loop="" playsinline="" preload="metadata" muted="" poster="/storage/media/productivity-video-poster_1755848078.jpg" src="/storage/media/productivity-video01_1755848078.webm" controls="controls" class="w-full h-full object-cover"></video>
                    <source src="/storage/media/productivity-video01_1755848078.webm" type="video/webm">
                    Your browser does not support the video tag.


                </div>
            </div>
            <div class="h-auto sm:h-[230px] md:h-[500px] order-1 md:order-2">
                <div class="relative flex flex-col justify-between h-full rounded-2xl p-3 md:p-6 bg-secondary/15 border border-secondary/30 backdrop-blur-[40px] transition duration-300 IDMFF04WVNC5X5I4">
                    <h3 data-raw-content="true" class="text-lg sm:text-xl md:text-2xl text-white font-semibold">Digital growth systems that scale with you</h3>
                    <div>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70 mb-3">We connect SEO, ads, websites, and reputation into one playbook—so every channel supports the next booked job.</p><a href="/contact-us" title="Talk to us" class="inline-flex items-center gap-2 text-secondary text-sm font-medium hover:gap-3 transition-all">Talk to us <span>→</span></a>
                    </div>
                </div>
            </div>
            <div class="h-auto md:h-[500px] order-3 md:order-3">
                <div class="relative w-full h-auto md:h-[288px] overflow-hidden rounded-2xl mb-3">
                    <figure> <img width="300" height="300" src="/images/about-001.jpg" alt="DottScale digital growth" class="w-full h-full object-cover object-top rounded-2xl"></figure>
                </div>
                <div class="h-auto md:h-[200px] justify-between bg-bodybg/10 border border-white/10 border-t-2 border-t-secondary backdrop-blur-[40px] rounded-2xl p-[12px] md:p-[20px] flex flex-col content-baseline relative IDMFF04WVWR4UMR6">
                    <h2 data-raw-content="true" class="uppercase text-[20px] md:text-[24px] font-semibold text-secondary mb-1">75% faster</h2>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">The improvement service businesses see when automation and clearer funnels replace outdated tools.</p>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 IDMELHWY269SPO81">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative flex flex-col justify-between h-full rounded-[6px] px-3 md:px-6 pt-3 md:pt-6 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] transition duration-300 IDMELHWY28Q6UMN2"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                </path>
            </svg><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon3">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                </path>
            </svg>
            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <div class="w-full md:w-4/12 relative">
                    <div class="inline-block">
                        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-5 md:mb-7 tracking-[2px] IDMELHWY29BFRE53">
                            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"> </path>
                                </svg>The Next Horizon&nbsp;</p>
                        </div>
                        <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold text-bodybg font-primary mb-3 sm:mb-5 md:mb-7 flex">Nothing Stays the Same</h2>
                        <p data-raw-content="true" class="font-secondary font-normal text-base md:text-xl text-bodybg/70 mb-3 sm:mb-5 md:mb-7">Technology is not waiting. Every revolution has rewritten how we live and work. AI, quantum, and automation are not trends. They are the foundation of tomorrow’s business. At DottScale, we prepare for what comes next with clarity and purpose.</p><a href="/the-next-horizon" title="GET STARTED" class="group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] focus:w-[70px] transition-all duration-300 ease-in-out IDMELHWY2GEAQ6Y4"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="bi bi-arrow-right-short text-[#212529]">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8">
                                </path>
                            </svg></a>
                    </div>
                </div>
                <div class="w-full md:w-8/12 relative">
                    <figure class="float-right"> <img width="500" height="500" src="/cms-uploads/VR-Image.webp" alt="Get Started" class="w-full h-full sm:h-[400px] md:h-[550px] xl:h-[700px] 2xl:h-[830px] object-cover object-top"></figure>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 IDMFDSYSGNP32GC1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="flex items-center justify-center text-center w-full md:w-[70%] xl:w-[50%] m-auto">
            <div class="grid grid-cols-12 gap-2 sm:gap-5 items-center relative">
                <div class="group col-span-12">
                    <div class="inline-block">
                        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px] IDMELBSFBN1MY2L20 IDMELBYP5CXBS928">
                            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                                </svg> Clients</p>
                        </div><br>
                        <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-2">Our Trusted Clients</h2>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">&nbsp;We are proud to have collaborated with industry leaders and innovative startups worldwide.&nbsp;<br>&nbsp; &nbsp; Their trust inspires us to deliver top-quality solutions every day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-8 all-client-logos-main IDMF2JUVE4BU38N1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="grid place-content-center">
            <div class="overflow-hidden relative [mask-image:linear-gradient(to_right,hsl(0_0%_0%/0),hsl(0_0%_0%/1)_10%,hsl(0_0%_0%/1)_90%,hsl(0_0%_0%/0))]">
                <div class="flex w-full marquee__ctn">
                    <div class="flex marquee__track all-client-logos">
                        <p data-raw-content="true" class="text-white">Logos display here...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 IDMFDT4WNB43Y4F3">
    <div class="container mx-auto px-3 sm:px-4">
        <div>
            <div class="grid grid-cols-12 gap-2 sm:gap-5 items-center relative">
                <div class="group col-span-12">
                    <div class="inline-block">
                        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px] IDMELBSFBN1MY2L20 IDMELBYP5CXBS928">
                            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"> </path>
                                </svg> Latest&nbsp;</p>
                        </div><br>
                        <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-2">Our Latest Project</h2>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">Discover how we built a modern, fully responsive web application with performance, design, and user experience at its core.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 main-portfolio-div-homepage IDMF2EN8N4J5HGT1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 list-portfolio-append-div-homepage">
            <p data-raw-content="true" class="text-white">Portfolios list here...</p>
        </div><a href="/our-work" title="view All Work" class="mt-5 m-auto red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 focus:px-7 transition-all duration-300 ease-in-out IDMF2EN8N63XKC82">View All Work</a>
    </div>
</section>
                    <section class="ds-benefits relative z-[2] overflow-hidden py-[80px] md:py-[110px]">
    <div class="pointer-events-none absolute inset-0 -z-[1] bg-cover bg-center" style="background-image: url('/images/dottscale/counter-bg.jpg')"></div>
    <div class="pointer-events-none absolute inset-0 -z-[1] bg-cover bg-center" style="background-image: url('/images/dottscale/counter-gradient.png')"></div>
    <div class="pointer-events-none absolute inset-0 -z-[1] bg-gradient-to-b from-[#fff8e8]/55 via-transparent to-[#ffb237]/45"></div>
    <div class="container mx-auto px-3 sm:px-4">
        <div class="text-center mb-10 md:mb-12">
            <div class="ds-benefits__tag mb-3">
                <img src="/images/dottscale/sec-title-shape.png" alt="" width="14" height="14">
                <span class="font-primary text-[13px] tracking-[2px] uppercase">Company Benefits</span>
            </div>
            <h2 class="font-primary text-[30px] sm:text-[38px] md:text-[46px] leading-[1.15] font-bold">Why you Choose our IT Solution</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-8 mb-8 max-w-[1100px] mx-auto">
            <article class="ds-benefits__card pr-2">
                <img src="/images/dottscale/shape2.png" alt="" class="pointer-events-none absolute left-0 top-0 z-[2] hidden sm:block">
                <img src="/images/dottscale/shape3.png" alt="" class="pointer-events-none absolute bottom-[25px] left-[155px] z-[2] hidden md:block">
                <div class="ds-benefits__photo">
                    <div class="ds-benefits__photo-inner">
                        <img src="/images/dottscale/counter-img1.jpg" alt="Our Mission" class="h-full w-full object-cover">
                    </div>
                </div>
                <div class="relative z-[1] flex-1 px-5 py-6 sm:pl-7 sm:-mt-3">
                    <h3 class="font-primary text-[20px] md:text-[22px] font-semibold mb-1.5">Our Mission</h3>
                    <p class="m-0 text-sm md:text-[15px] leading-relaxed text-[#080501]/80">Helping businesses scale with technology and creative marketing solutions.</p>
                </div>
            </article>

            <article class="ds-benefits__card ds-benefits__card--alt">
                <img src="/images/dottscale/shape4.png" alt="" class="pointer-events-none absolute right-0 top-0 z-[2] hidden sm:block">
                <img src="/images/dottscale/shape5.png" alt="" class="pointer-events-none absolute bottom-[25px] right-[173px] z-[2] hidden md:block">
                <div class="relative z-[1] flex-1 px-5 py-6 sm:pl-14 sm:pr-5 sm:-mt-3 order-2 sm:order-1">
                    <h3 class="font-primary text-[20px] md:text-[22px] font-semibold mb-1.5">Company Benefits</h3>
                    <p class="m-0 text-sm md:text-[15px] leading-relaxed text-[#080501]/80">Driving growth with expert solutions and custom strategies.</p>
                </div>
                <div class="ds-benefits__photo order-1 sm:order-2">
                    <div class="ds-benefits__photo-inner">
                        <img src="/images/dottscale/counter-img2.jpg" alt="Company Benefits" class="h-full w-full object-cover">
                    </div>
                </div>
            </article>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-4 max-w-4xl mx-auto text-center mb-10 md:mb-14">
            <div>
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/dottscale/star.png" alt="" width="40" height="40">
                    <p class="font-primary text-[48px] md:text-[60px] leading-none font-semibold m-0">80+</p>
                </div>
                <p class="font-primary text-[18px] md:text-[20px] font-medium leading-7 mt-2 m-0">Our Successful<br>Completed Projects</p>
            </div>
            <div>
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/dottscale/star.png" alt="" width="40" height="40">
                    <p class="font-primary text-[48px] md:text-[60px] leading-none font-semibold m-0">50+</p>
                </div>
                <p class="font-primary text-[18px] md:text-[20px] font-medium leading-7 mt-2 m-0">Our Agency<br>IT Specialists</p>
            </div>
            <div>
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/dottscale/star.png" alt="" width="40" height="40">
                    <p class="font-primary text-[48px] md:text-[60px] leading-none font-semibold m-0">80+</p>
                </div>
                <p class="font-primary text-[18px] md:text-[20px] font-medium leading-7 mt-2 m-0">Our Successful<br>Completed Projects</p>
            </div>
        </div>

        <div class="text-center">
            <h3 class="font-primary text-[26px] sm:text-[32px] md:text-[36px] leading-[1.35] font-semibold mb-8">Assisting you in Overcoming your<br class="hidden sm:block"> Technological Obstacles</h3>
            <a href="/contact-us" class="inline-flex items-center justify-center bg-[#080501] text-white uppercase tracking-[0.5px] font-medium text-sm md:text-base px-10 h-[52px] md:h-[60px] rounded-[3px] hover:bg-white hover:text-[#080501] transition-colors duration-300">Discover more</a>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 mainReviewsClient IDMETKFAGPVDDW31">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="mb-4 sm:mb-6 lg:mb-8">
            <div class="grid grid-cols-12 gap-2 sm:gap-5 items-center">
                <div class="group col-span-12">
                    <div class="inline-block">
                        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px] IDMETKFAGQ79X3R2">
                            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"> </path>
                                </svg> client Reviews</p>
                        </div><br>
                        <h2 data-raw-content="true" class="uppercase text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary">
                            What they think
                        </h2>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">
                            From startups to global brands, we’ve delivered impactful solutions. Explore some of
                            our
                            latest projects
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hasClientReviews all-reviews-section-list">
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 IDMEQRUU5ALEO671">
    <div class="container mx-auto px-3 sm:px-4">
        <div>
            <div class="grid grid-cols-12 gap-2 sm:gap-5 items-center relative">
                <div class="group col-span-12">
                    <div class="inline-block">
                        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px] IDMELBSFBN1MY2L20 IDMELBYP5CXBS928">
                            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                                </svg>​​​​​​​&nbsp;Blogs</p>
                        </div><br>
                        <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary">Our Blogs</h2>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">
                            From startups to global brands, we’ve delivered impactful solutions. Explore some of
                            our
                            latest projects
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    <section class="py-5 md:py-10 has-latest-blogs-main IDMEQRTEKNJ4WTN4">
    <div class="container mx-auto px-3 sm:px-4 has-latest-blogs">
        <div class="grid grid-cols-12 gap-3 sm:gap-4 latest-blogs-list">
            <p data-raw-content="true" class="text-white">Latest Blogs here...</p>
        </div>
    </div>
</section>
@endverbatim
@endsection
