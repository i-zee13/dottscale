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
    $homeJson = function ($raw, $fallback = []) {
        if (empty($raw)) {
            return $fallback;
        }
        $decoded = is_string($raw) ? json_decode($raw, true) : $raw;
        return is_array($decoded) && count($decoded) ? $decoded : $fallback;
    };
    $heroHeading = $home?->heading_1 ?? 'Digital Marketing Agency in Austin, TX';
    $heroParagraph = $home?->heading_2 ?? 'We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.';
    $heroCtaPrimary = $home?->hero_cta_primary ?? 'Get a Free Strategy Call';
    $heroCtaSecondary = $home?->hero_cta_secondary ?? 'Get Started';
    $aboutHeading = $home?->large_heading ?? 'Digital marketing for businesses in Austin, TX';
    $aboutParagraph = $home?->paragraph ?? "Austin's business market is crowded and search-driven — customers decide who to call largely based on who shows up first in Google Search and Maps. We build that visibility from the ground up: a Google Business Profile that ranks, a website that converts once someone clicks, and a reputation that holds up under scrutiny. Local SEO and paid advertising work together so you're found in the moment someone's ready to hire, and every channel feeds a website built to close the deal, not just collect a visit.";
    $aboutCta = $home?->award_heading ?? 'Learn More About Us';
    $aboutEyebrow = $home?->about_eyebrow ?? 'Local to Austin';
    $desktopImg = $homeImg($home?->desktop_img, '/images/hero-img01.webp?v=4');
    $mobileImg = $homeImg($home?->mobile_img, '/images/main-bg-mobile.webp?v=4');
    $aboutImg = $homeImg($home?->award_img, '/images/testimonials-img.png');
    $stats = $homeJson($home?->stats_json ?? null, [
        ['value' => '40+', 'label' => 'Businesses helped'],
        ['value' => '5+', 'label' => 'Years of experience'],
        ['value' => '120+', 'label' => 'Projects completed'],
        ['value' => '4.9★', 'label' => 'Average client rating'],
    ]);
    $servicesEyebrow = $home?->services_eyebrow ?? 'What we do';
    $servicesHeading = $home?->services_heading ?? 'Digital marketing services for Austin businesses';
    $whyEyebrow = $home?->why_eyebrow ?? 'Why Dott Scale';
    $whyHeading = $home?->why_heading ?? 'A growth partner, not just another marketing agency';
    $whyItems = $homeJson($home?->why_json ?? null, [
        ['title' => 'Strategy before execution', 'text' => 'We map the plan before we touch a single ad or page.'],
        ['title' => 'Data-driven decisions', 'text' => 'Every move is backed by numbers, not guesswork.'],
        ['title' => 'SEO, paid, and web working together', 'text' => 'Channels are built to reinforce each other, not compete.'],
        ['title' => 'Transparent reporting', 'text' => "You'll always know what's working and what isn't."],
        ['title' => 'Conversion-focused approach', 'text' => "Traffic that doesn't turn into calls isn't the goal."],
        ['title' => 'Scalable systems', 'text' => 'Built to grow with you, from one market to many.'],
    ]);
    $aboutList = $homeJson($home?->about_list_json ?? null, [
        'Austin market positioning', 'Local search visibility', 'Google Business Profile', 'Search engine optimization',
        'Paid advertising', 'Website conversion', 'Reputation management', 'Local customer acquisition',
    ]);
    $processEyebrow = $home?->process_eyebrow ?? 'Process';
    $processHeading = $home?->process_heading ?? 'How we grow your business';
    $processItems = $homeJson($home?->process_json ?? null, [
        ['n' => '01', 'title' => 'Discover', 'text' => 'Understand your business, market, competitors, and goals.'],
        ['n' => '02', 'title' => 'Build', 'text' => 'Website, SEO foundations, campaigns, branding, and systems.'],
        ['n' => '03', 'title' => 'Optimize', 'text' => 'Use data to improve rankings, traffic, leads, and conversions.'],
        ['n' => '04', 'title' => 'Scale', 'text' => 'Expand the strategies and channels that are proving out.'],
    ]);
    $proofEyebrow = $home?->proof_eyebrow ?? 'Proof';
    $proofHeading = $home?->proof_heading ?? 'Results that speak for themselves';
    $proofItems = $homeJson($home?->proof_json ?? null, [
        [
            'client' => 'V-Fix Phone Repair — Berkeley, CA',
            'title' => 'From invisible on Maps to booked walk-ins',
            'text' => 'A local SEO and GBP overhaul rebuilt visibility for a phone repair shop competing against national chains.',
            'stats' => [['value' => '↑', 'label' => 'Local rankings'], ['value' => '↑', 'label' => 'GBP calls']],
        ],
        [
            'client' => 'Client name — Industry, City',
            'title' => 'Result headline goes here',
            'text' => 'One or two lines on the problem and the strategy used to solve it.',
            'stats' => [['value' => '—', 'label' => 'Organic traffic'], ['value' => '—', 'label' => 'Leads']],
        ],
    ]);
    $industriesEyebrow = $home?->industries_eyebrow ?? 'Who we work with';
    $industriesHeading = $home?->industries_heading ?? 'Industries we serve';
    $industries = $homeJson($home?->industries_json ?? null, [
        'Home Services', 'Professional Services', 'Local Businesses', 'E-commerce', 'Healthcare', 'Real Estate', 'B2B',
    ]);
    $visibilityEyebrow = $home?->visibility_eyebrow ?? 'Local visibility';
    $visibilityHeading = $home?->visibility_heading ?? 'Get found where Austin customers are searching';
    $visibilityList = $homeJson($home?->visibility_list_json ?? null, [
        'Google Search & Maps rankings', 'Google Business Profile optimization', 'Reviews and reputation signals',
        'Local citations and listings', 'Local landing pages built to convert',
    ]);
    $visibilityCtaText = $home?->visibility_cta_text ?? 'See our Local SEO service';
    $visibilityCtaLink = $home?->visibility_cta_link ?? 'services/local-seo';
    $visibilityCardTitle = $home?->visibility_card_title ?? 'Dott Scale';
    $visibilityCardSubtitle = $home?->visibility_card_subtitle ?? 'Austin, Texas';
    $visibilityCardRating = $home?->visibility_card_rating ?? '★★★★★ 4.9 on Google · 40+ reviews';
    $ctaHeading = $home?->cta_heading ?? 'Ready to grow your business?';
    $ctaParagraph = $home?->cta_paragraph ?? "Tell us about your business and we'll map out where the fastest wins are.";
    $ctaPrimary = $home?->cta_primary_text ?? 'Book Your Free Strategy Call';
    $ctaSecondary = $home?->cta_secondary_text ?? 'Explore Our Services';
    $defaultSectionOrder = [
        'hero' => 1, 'stats' => 2, 'services' => 3, 'why' => 4, 'about' => 5,
        'process' => 6, 'proof' => 7, 'industries' => 8, 'visibility' => 9, 'cta' => 10,
    ];
    $sectionOrder = $homeJson($home?->sections_order_json ?? null, $defaultSectionOrder);
    foreach ($defaultSectionOrder as $key => $priority) {
        $sectionOrder[$key] = isset($sectionOrder[$key]) && is_numeric($sectionOrder[$key])
            ? (int) $sectionOrder[$key]
            : $priority;
    }
    $so = fn ($key) => (int) ($sectionOrder[$key] ?? $defaultSectionOrder[$key] ?? 99);
    $homeSchema = '';
    if (!empty($home?->page_meta_tags)) {
        $metaDecoded = is_string($home->page_meta_tags) ? json_decode($home->page_meta_tags) : $home->page_meta_tags;
        if (is_array($metaDecoded) || is_object($metaDecoded)) {
            foreach ($metaDecoded as $meta) {
                $meta = (object) $meta;
                if (!empty($meta->meta_structure_tags)) {
                    $homeSchema = trim($meta->meta_structure_tags);
                }
            }
        }
    }
@endphp
<div class="IDL70G23RUJ9HEB4"></div>
@if(!empty($homeSchema))
<script type="application/ld+json">{!! $homeSchema !!}</script>
@endif

<div class="home-sections-stack" style="display:flex;flex-direction:column;">
<section class="z-[1] min-h-screen flex items-center relative IDMEJHT2SVHL8J813 IDMEJIKW527FZEE0" style="order:{{ $so('hero') }}">
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
                            <a href="/contact-us" title="{{ $heroCtaPrimary }}" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 focus:px-7 transition-all duration-300 ease-in-out IDMEJHT2TC8SMUO15 IDMEJIKW5BV7LFG2">{{ $heroCtaPrimary }}</a>
                            <a href="#services" title="{{ $heroCtaSecondary }}" class="group border border-white/20 text-bodybg rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:bg-bodybg/10 transition-all duration-300 ease-in-out">{{ $heroCtaSecondary }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 md:py-8" style="order:{{ $so('stats') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            @foreach($stats as $stat)
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 text-center">
                <div class="font-primary text-2xl md:text-4xl font-bold text-bodybg mb-1">{{ $stat['value'] ?? '' }}</div>
                <p class="font-secondary text-xs sm:text-sm text-bodybg/70 m-0">{{ $stat['label'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="py-5 md:py-10 home-our-services IDMEH5PS2RJVLE01" style="order:{{ $so('services') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $servicesEyebrow }}</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-5 lg:mb-7">{{ $servicesHeading }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            @forelse(($services ?? collect()) as $service)
            <div class="group bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-[15px] md:p-5 flex flex-col justify-between min-h-[180px]">
                <div>
                    <div class="flex justify-between items-start mb-3">
                        <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mr-2">{{ $service->service_name }}</h3>
                        @if(!empty($service->icon))
                        <img src="{{ $service->icon }}" alt="" width="26" height="26" class="w-[26px] h-[26px] object-contain filter invert brightness-0 opacity-50 shrink-0">
                        @endif
                    </div>
                    <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70">{{ $service->description }}</p>
                </div>
                <a href="{{ ltrim($service->route ?? '#', '/') }}" title="Learn more" class="mt-4 group bg-bodybg rounded-[6px] w-[40px] h-[40px] flex items-center justify-center hover:w-[70px] transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16" fill="currentColor" class="text-[#212529]"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"></path></svg></a>
            </div>
            @empty
            <p class="font-secondary text-sm text-bodybg/70 col-span-full">Services coming soon.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5 md:py-10" style="order:{{ $so('why') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $whyEyebrow }}</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-7">{{ $whyHeading }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @foreach($whyItems as $item)
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 pl-4 border-l-2 border-l-secondary">
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-bodybg mb-2">{{ $item['title'] ?? '' }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 md:py-10 IDMELHLKGP4KI8K1" style="order:{{ $so('about') }}">
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
                            </svg> {{ $aboutEyebrow }}</p>
                    </div>
                    <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 sm:mb-5 flex">{{ $aboutHeading }}</h2>
                    <p data-raw-content="true" class="font-secondary font-normal text-sm md:text-base text-bodybg/70 mb-3 md:mb-4">{{ $aboutParagraph }}</p>
                    <ul class="font-secondary text-xs sm:text-sm text-bodybg/70 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1.5 mb-3 md:mb-5 list-disc pl-5 w-full">
                        @foreach($aboutList as $item)
                        <li>{{ is_array($item) ? ($item['label'] ?? '') : $item }}</li>
                        @endforeach
                    </ul>
                    <a href="about-us" title="{{ $aboutCta }}" class="red-arrow-btn group mt-2 pr-10 bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 focus:px-7 transition-all duration-300 ease-in-out IDMELHLKH0Z6SKJ4">{{ $aboutCta }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 md:py-10" style="order:{{ $so('process') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $processEyebrow }}</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-7">{{ $processHeading }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            @foreach($processItems as $item)
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
                <div class="text-secondary font-primary text-sm mb-2">{{ $item['n'] ?? '' }}</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">{{ $item['title'] ?? '' }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 md:py-10 home-video-3-section" style="order:{{ $so('proof') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[70%] lg:w-[60%] m-auto text-center mb-4 md:mb-8 flex items-center justify-center flex-col">
            <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $proofEyebrow }}</p>
            </div>
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-1.5 md:mb-3">{{ $proofHeading }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
            @foreach($proofItems as $item)
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <div class="text-secondary text-xs font-semibold uppercase tracking-wide mb-2">{{ $item['client'] ?? '' }}</div>
                <h3 data-raw-content="true" class="font-primary text-lg md:text-xl font-semibold text-bodybg mb-2">{{ $item['title'] ?? '' }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 mb-4">{{ $item['text'] ?? '' }}</p>
                <div class="flex gap-6">
                    @foreach(($item['stats'] ?? []) as $ps)
                    <div><div class="font-primary text-xl text-bodybg">{{ $ps['value'] ?? '' }}</div><div class="text-xs text-bodybg/70">{{ $ps['label'] ?? '' }}</div></div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 md:py-10" style="order:{{ $so('industries') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $industriesEyebrow }}</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-6">{{ $industriesHeading }}</h2>
        <div class="flex flex-wrap gap-2 md:gap-3">
            @foreach($industries as $label)
            <span class="border border-white/15 bg-bodybg/10 text-bodybg text-sm rounded-[6px] px-4 py-2">{{ is_array($label) ? ($label['label'] ?? '') : $label }}</span>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 md:py-10" style="order:{{ $so('visibility') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative flex flex-col md:flex-row justify-between gap-4 md:gap-8 rounded-[6px] p-3 md:p-6 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <div class="w-full md:w-7/12">
                <div class="font-primary inline-block bg-bodybg/20 text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-4 uppercase tracking-[2px]">
                    <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> {{ $visibilityEyebrow }}</p>
                </div>
                <h2 data-raw-content="true" class="leading-none capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 md:mb-5">{{ $visibilityHeading }}</h2>
                <ul class="font-secondary text-sm md:text-base text-bodybg/70 space-y-2 mb-5 list-disc pl-5">
                    @foreach($visibilityList as $item)
                    <li>{{ is_array($item) ? ($item['label'] ?? '') : $item }}</li>
                    @endforeach
                </ul>
                <a href="{{ ltrim($visibilityCtaLink, '/') }}" title="{{ $visibilityCtaText }}" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 transition-all duration-300">{{ $visibilityCtaText }}</a>
            </div>
            <div class="w-full md:w-5/12 bg-bodybg/10 border border-white/10 rounded-[6px] p-5 md:p-8 flex flex-col justify-center">
                <div class="w-10 h-10 rounded-full bg-secondary text-primary flex items-center justify-center font-bold mb-4">◎</div>
                <div class="font-primary text-xl text-bodybg mb-1">{{ $visibilityCardTitle }}</div>
                <div class="font-secondary text-sm text-bodybg/70">{{ $visibilityCardSubtitle }}</div>
                <div class="font-secondary text-sm text-bodybg/70 mt-4">{{ $visibilityCardRating }}</div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 md:py-10 IDMFDSYSGNP32GC1" style="order:100">
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
<section class="py-5 md:py-8 all-client-logos-main IDMF2JUVE4BU38N1" style="order:101">
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

<section class="py-5 md:py-10 mainReviewsClient IDMETKFAGPVDDW31" style="order:102">
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

<section class="py-5 md:py-10" style="order:103">
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

<section id="contact" class="py-5 md:py-10" style="order:{{ $so('cta') }}">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative rounded-[6px] p-5 md:p-10 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <h2 data-raw-content="true" class="capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3">{{ $ctaHeading }}</h2>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-5 max-w-2xl">{{ $ctaParagraph }}</p>
            <div class="flex flex-wrap gap-3">
                <a href="/contact-us" title="{{ $ctaPrimary }}" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:px-6 transition-all duration-300">{{ $ctaPrimary }}</a>
                <a href="#services" title="{{ $ctaSecondary }}" class="group border border-white/20 text-bodybg rounded-[6px] h-[40px] w-max px-4 flex items-center justify-center hover:bg-bodybg/10 transition-all duration-300">{{ $ctaSecondary }}</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 md:py-10 IDMEQRUU5ALEO671" style="order:104">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-2 lg:mb-4 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Insights</p>
        </div>
        <h2 data-raw-content="true" class="leading-none capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary">Our Blogs</h2>
        <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">Practical guides on SEO, ads, and digital growth for local businesses.</p>
    </div>
</section>
<section class="py-5 md:py-10 has-latest-blogs-main IDMEQRTEKNJ4WTN4" style="order:105">
    <div class="container mx-auto px-3 sm:px-4 has-latest-blogs">
        <div class="grid grid-cols-12 gap-3 sm:gap-4 latest-blogs-list">
            <p data-raw-content="true" class="text-white">Latest Blogs here...</p>
        </div>
    </div>
</section>
</div>
@endsection
