@extends('layouts.Frontend.app')

@section('title')
Dott Scale — Digital Marketing Agency in Austin, TX
@endsection

@section('meta_description')
We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.
@endsection

@section('meta_keywords')
Dott Scale, digital marketing agency Austin, local SEO, Google Ads, web design, Austin TX
@endsection

@section('og_description')
Digital marketing agency in Austin, TX — SEO, ads, websites, and reputation built to grow local businesses.
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
    // Content from Dott Scale homepage brief; Allomate theme/layout kept.
    $heroHeading = $home?->heading_1 ?? 'Digital Marketing Agency in Austin, TX';
    $heroParagraph = $home?->heading_2 ?? 'We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.';
    $aboutHeading = $home?->large_heading ?? 'Digital marketing for businesses in Austin, TX';
    $aboutParagraph = $home?->paragraph ?? "Austin's business market is crowded and search-driven — customers decide who to call largely based on who shows up first in Google Search and Maps. We build that visibility from the ground up: a Google Business Profile that ranks, a website that converts once someone clicks, and a reputation that holds up under scrutiny. Local SEO and paid advertising work together so you're found in the moment someone's ready to hire, and every channel feeds a website built to close the deal, not just collect a visit.";
    $aboutCta = $home?->award_heading ?? 'Learn More About Us';
    $desktopImg = $homeImg($home?->desktop_img, '/images/hero-img01.webp?v=4');
    $mobileImg = $homeImg($home?->mobile_img, '/images/main-bg-mobile.webp?v=4');
    $aboutImg = $homeImg($home?->award_img, '/images/testimonials-img.png');
@endphp
<div class="IDL70G23RUJ9HEB4"></div>

{{-- Hero: Allomate glass overlay on full-bleed image --}}
<section class="z-[1] min-h-screen flex items-center relative IDMEJHT2SVHL8J813 IDMEJIKW527FZEE0">
    <div class="relative w-full">
        <figure class="overflow-hidden hidden sm:block"><img width="1504" height="579" src="{{ $desktopImg }}" alt="{{ $heroHeading }}" title="{{ $heroHeading }}" class="w-full h-screen object-cover"></figure>
        <figure class="overflow-hidden block sm:hidden"><img width="480" height="768" src="{{ $mobileImg }}" alt="{{ $heroHeading }}" title="{{ $heroHeading }}" class="w-full h-screen object-cover"></figure>
        <div class="container mx-auto px-3 sm:px-4">
            <div class="absolute top-0 bottom-0 right-auto m-auto flex items-center justify-center">
                <div class="mr-3">
                    <div class="text-bodybg bg-primary/10 border border-white/15 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] rounded-[6px] backdrop-blur-[30px] p-[20px] sm:p-10 w-full md:w-[790px] IDMEJHT2T0ABEI714 IDMEJIKW56QW3HA1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                        </svg>
                        <h1 data-raw-content="true" class="leading-none text-[26px] sm:text-[30px] md:text-[34px] lg:text-[40px] xl:text-[46px] font-primary font-bold text-white uppercase mb-3 md:mb-5">{!! nl2br(e($heroHeading)) !!}</h1>
                        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg mb-2 md:mb-4 opacity-70">{!! nl2br(e($heroParagraph)) !!}</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="/contact-us" title="Get a Free Strategy Call" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 focus:px-7 transition-all duration-300 ease-in-out IDMEJHT2TC8SMUO15 IDMEJIKW5BV7LFG2">Get a Free Strategy Call</a>
                            <a href="#services" title="Get Started" class="group border border-white/20 text-bodybg rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:bg-bodybg/10 transition-all duration-300 ease-in-out">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@verbatim
{{-- Trust bar — Allomate glass cards --}}
<section class="py-5 md:py-8">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 text-center">
                <div class="font-primary text-2xl md:text-4xl font-bold text-bodybg mb-1">40+</div>
                <p class="font-secondary text-xs sm:text-sm text-bodybg/70 m-0">Businesses helped</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 text-center">
                <div class="font-primary text-2xl md:text-4xl font-bold text-bodybg mb-1">5+</div>
                <p class="font-secondary text-xs sm:text-sm text-bodybg/70 m-0">Years of experience</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 text-center">
                <div class="font-primary text-2xl md:text-4xl font-bold text-bodybg mb-1">120+</div>
                <p class="font-secondary text-xs sm:text-sm text-bodybg/70 m-0">Projects completed</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 text-center">
                <div class="font-primary text-2xl md:text-4xl font-bold text-bodybg mb-1">4.9★</div>
                <p class="font-secondary text-xs sm:text-sm text-bodybg/70 m-0">Average client rating</p>
            </div>
        </div>
    </div>
</section>

{{-- Services — Allomate glass cards, HTML service list --}}
<section id="services" class="py-5 md:py-10 home-our-services IDMEH5PS2RJVLE01">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> What we do</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-5 lg:mb-7">Digital marketing services for Austin businesses</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Website Design &amp; Development</h3>
                        <img src="/cms-uploads/mobile-app.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Fast, conversion-focused websites built to turn visitors into calls.</p>
                </div>
                <a href="services/web-and-mobile-development" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Local SEO</h3>
                        <img src="/cms-uploads/chart.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Rank higher in Google Search and Maps for the terms your customers use.</p>
                </div>
                <a href="services/enterprise-solutions" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">PPC Advertising</h3>
                        <img src="/cms-uploads/cube.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Google and Meta Ads managed for cost-per-lead, not just clicks.</p>
                </div>
                <a href="services/mvp-design-and-development" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Social Media Marketing</h3>
                        <img src="/cms-uploads/teamwork.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Consistent content and management that builds trust before the call.</p>
                </div>
                <a href="services/dedicated-teams" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Graphic Design &amp; Branding</h3>
                        <img src="/cms-uploads/warranty.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">A visual identity that looks credible the moment someone lands on it.</p>
                </div>
                <a href="services/quality-assurance" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Google Business Profile</h3>
                        <img src="/cms-uploads/chart.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Optimization, ranking, and ongoing management of your GBP listing.</p>
                </div>
                <a href="services/enterprise-solutions" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">Reputation Management</h3>
                        <img src="/cms-uploads/warranty.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">More reviews, better ratings, and a cleaner presence across platforms.</p>
                </div>
                <a href="services/quality-assurance" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">AI Automation</h3>
                        <img src="/cms-uploads/artificial-intelligence.svg" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">Automated lead follow-up, customer service, and workflow systems.</p>
                </div>
                <a href="services/ai-and-automation" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
        </div>
    </div>
</section>

{{-- Why Dott Scale --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Why Dott Scale</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-7">A growth partner, not just another marketing agency</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">Strategy before execution</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">We map the plan before we touch a single ad or page.</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">Data-driven decisions</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Every move is backed by numbers, not guesswork.</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">SEO, paid, and web working together</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Channels are built to reinforce each other, not compete.</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">Transparent reporting</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">You'll always know what's working and what isn't.</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">Conversion-focused approach</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Traffic that doesn't turn into calls isn't the goal.</p>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">Scalable systems</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Built to grow with you, from one market to many.</p>
            </div>
        </div>
    </div>
</section>
@endverbatim

{{-- Local to Austin — Allomate image + overlay panel --}}
<section class="py-5 md:py-10 IDMELHLKGP4KI8K1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon1 z-[10]">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
            </svg>
            <figure> <img width="1000" height="1000" src="{{ $aboutImg }}" alt="{{ $aboutHeading }}" class="w-full h-[380px] sm:h-[450px] md:h-[600px] lg:h-[800px] object-cover rounded-[6px]"></figure>
            <div class="absolute bottom-[30px] right-0 sm:right-[10px] md:right-[30px] w-full sm:w-[50%] lg:w-[40%] p-3 md:p-6 bg-bodybg/5 sm:bg-bodybg/10 backdrop-blur-[15px] sm:backdrop-blur-[40px] rounded-[6px] IDMELHLKGT9FEAJ2">
                <div class="min-h-[250px] md:min-h-[300px] flex flex-col justify-between items-start">
                    <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px] IDMELHLKGTZ46X23">
                        <p data-raw-content="true"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                            </svg> Local to Austin</p>
                    </div>
                    <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 sm:mb-5 flex">{{ $aboutHeading }}</h2>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm md:text-base text-bodybg/70 mb-3 md:mb-4">{{ $aboutParagraph }}</p>
                    <ul class="font-secondary text-xs sm:text-sm text-bodybg/70 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1.5 mb-3 md:mb-5 list-disc pl-5 w-full">
                        <li>Austin market positioning</li>
                        <li>Local search visibility</li>
                        <li>Google Business Profile</li>
                        <li>Search engine optimization</li>
                        <li>Paid advertising</li>
                        <li>Website conversion</li>
                        <li>Reputation management</li>
                        <li>Local customer acquisition</li>
                    </ul>
                    <a href="about-us" title="{{ $aboutCta }}" class="red-arrow-btn group mt-2 pr-10 bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 focus:px-7 transition-all duration-300 ease-in-out IDMELHLKH0Z6SKJ4">{{ $aboutCta }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@verbatim
{{-- Process --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Process</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-7">How we grow your business</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                <div class="text-secondary font-primary text-sm mb-2">01</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">Discover</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Understand your business, market, competitors, and goals.</p>
            </div>
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                <div class="text-secondary font-primary text-sm mb-2">02</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">Build</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Website, SEO foundations, campaigns, branding, and systems.</p>
            </div>
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                <div class="text-secondary font-primary text-sm mb-2">03</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">Optimize</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Use data to improve rankings, traffic, leads, and conversions.</p>
            </div>
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                <div class="text-secondary font-primary text-sm mb-2">04</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">Scale</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">Expand the strategies and channels that are proving out.</p>
            </div>
        </div>
    </div>
</section>

{{-- Proof / results --}}
<section class="py-5 md:py-10 home-video-3-section">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[70%] lg:w-[60%] m-auto text-center mb-4 md:mb-8 flex items-center justify-center flex-col">
            <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Proof</p>
            </div>
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-1.5 md:mb-3">Results that speak for themselves</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <div class="text-secondary text-xs font-semibold uppercase tracking-wide mb-2">V-Fix Phone Repair — Berkeley, CA</div>
                <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">From invisible on Maps to booked walk-ins</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 mb-4">A local SEO and GBP overhaul rebuilt visibility for a phone repair shop competing against national chains.</p>
                <div class="flex gap-6">
                    <div><div class="font-primary text-xl text-bodybg">↑</div><div class="text-xs text-bodybg/70">Local rankings</div></div>
                    <div><div class="font-primary text-xl text-bodybg">↑</div><div class="text-xs text-bodybg/70">GBP calls</div></div>
                </div>
            </div>
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <div class="text-secondary text-xs font-semibold uppercase tracking-wide mb-2">Client name — Industry, City</div>
                <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">Result headline goes here</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 mb-4">One or two lines on the problem and the strategy used to solve it.</p>
                <div class="flex gap-6">
                    <div><div class="font-primary text-xl text-bodybg">—</div><div class="text-xs text-bodybg/70">Organic traffic</div></div>
                    <div><div class="font-primary text-xl text-bodybg">—</div><div class="text-xs text-bodybg/70">Leads</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Industries --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Who we work with</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-6">Industries we serve</h2>
        <div class="flex flex-wrap gap-2 md:gap-3">
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">Home Services</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">Professional Services</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">Local Businesses</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">E-commerce</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">Healthcare</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">Real Estate</span>
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">B2B</span>
        </div>
    </div>
</section>

{{-- Local visibility — Allomate two-column panel --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative flex flex-col md:flex-row justify-between gap-4 md:gap-8 rounded-[6px] p-3 md:p-6 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <div class="w-full md:w-7/12">
                <div class="font-primary inline-block bg-bodybg/20 text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-4 uppercase tracking-[2px]">
                    <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Local visibility</p>
                </div>
                <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 md:mb-5">Get found where Austin customers are searching</h2>
                <ul class="font-secondary text-sm md:text-base text-bodybg/70 space-y-2 mb-5 list-disc pl-5">
                    <li>Google Search &amp; Maps rankings</li>
                    <li>Google Business Profile optimization</li>
                    <li>Reviews and reputation signals</li>
                    <li>Local citations and listings</li>
                    <li>Local landing pages built to convert</li>
                </ul>
                <a href="services/enterprise-solutions" title="See our Local SEO service" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 transition-all duration-300">See our Local SEO service</a>
            </div>
            <div class="w-full md:w-5/12 bg-bodybg/10 border border-white/10 rounded-[6px] p-5 md:p-8 flex flex-col justify-center">
                <div class="w-10 h-10 rounded-full bg-secondary text-primary flex items-center justify-center font-bold mb-4">◎</div>
                <div class="font-primary text-xl text-bodybg mb-1">Dott Scale</div>
                <div class="font-secondary text-sm text-bodybg/70">Austin, Texas</div>
                <div class="font-secondary text-sm text-bodybg/70 mt-4">★★★★★ 4.9 on Google · 40+ reviews</div>
            </div>
        </div>
    </div>
</section>

{{-- Clients logos (Allomate dynamic slot) --}}
<section class="py-5 md:py-10 IDMFDSYSGNP32GC1">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="flex items-center justify-center text-center w-full md:w-[70%] xl:w-[50%] m-auto">
            <div>
                <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
                    <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Clients</p>
                </div>
                <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-2">Our Trusted Clients</h2>
                <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">We are proud to have collaborated with industry leaders and innovative startups worldwide.</p>
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

{{-- Testimonials (Allomate reviews slot) --}}
<section class="py-5 md:py-10 mainReviewsClient IDMETKFAGPVDDW31">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="mb-4 sm:mb-6 lg:mb-8">
            <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Testimonials</p>
            </div>
            <h2 data-raw-content="true" class="uppercase text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary">What our clients say</h2>
            <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">Clear plans, measurable leads, and reporting that actually makes sense.</p>
        </div>
        <div class="hasClientReviews all-reviews-section-list"></div>
    </div>
</section>

{{-- FAQ — Allomate faq-item pattern (toggle via layouts/Frontend scripts) --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> FAQ</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-6">Common questions</h2>
        <div class="faq space-y-2">
            <div class="faq-item active bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">What does a digital marketing agency in Austin do?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">We handle the channels that bring a business new customers — SEO, paid advertising, your website, social media, your Google Business Profile, and your online reputation — so leads come in consistently.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">How much does digital marketing cost in Austin?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">It depends on your goals and channels. We'll build a plan and quote after understanding your business on a free strategy call.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">What services does Dott Scale offer?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">Website design, local SEO, PPC advertising, social media marketing, branding, Google Business Profile management, reputation management, and AI automation.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">Do you work with businesses outside Austin?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">Yes — while Austin is our home market, we also work with clients remotely across the country.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">How long does SEO take?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">Most businesses see meaningful movement within 90 days, with stronger compounding results by month six.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">Do you offer ongoing SEO?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">Yes — SEO is a monthly engagement, since rankings and visibility need to be maintained and built on over time.</p></div>
            </div>
            <div class="faq-item bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">Can you manage Google Ads and SEO together?<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg></button>
                <div class="faq-content"><p class="font-secondary text-sm text-bodybg/70 pb-4">Yes, and we usually recommend it — paid and organic working together shortens the time to your first leads.</p></div>
            </div>
        </div>
    </div>
</section>

{{-- Final CTA — Allomate glass panel --}}
<section id="contact" class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative rounded-[6px] p-5 md:p-10 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <h2 data-raw-content="true" class="capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3">Ready to grow your business?</h2>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-5 max-w-2xl">Tell us about your business and we'll map out where the fastest wins are.</p>
            <div class="flex flex-wrap gap-3">
                <a href="/contact-us" title="Book Your Free Strategy Call" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 transition-all duration-300">Book Your Free Strategy Call</a>
                <a href="#services" title="Explore Our Services" class="group border border-white/20 text-bodybg rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:bg-bodybg/10 transition-all duration-300">Explore Our Services</a>
            </div>
        </div>
    </div>
</section>

{{-- Blogs slot kept --}}
<section class="py-5 md:py-10 IDMEQRUU5ALEO671">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Insights</p>
        </div>
        <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary">Our Blogs</h2>
        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">Practical guides on SEO, ads, and digital growth for local businesses.</p>
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
