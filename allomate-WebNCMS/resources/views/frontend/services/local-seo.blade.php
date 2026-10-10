@extends('layouts.Frontend.app')

@section('title')
Local SEO Services in Austin, TX | Dott Scale
@endsection

@section('meta_description')
Get more local visibility with Local SEO services in Austin, TX. Dott Scale helps businesses improve local rankings, reach nearby customers, and generate qualified leads.
@endsection

@section('meta_keywords')
Local SEO Austin, Local SEO services Austin TX, Google Maps SEO, Google Business Profile, local search visibility
@endsection

@section('og_description')
Get more local visibility with Local SEO services in Austin, TX. Dott Scale helps businesses improve local rankings, reach nearby customers, and generate qualified leads.
@endsection

@section('content')
@php
    $painPoints = [
        ['title' => 'Your Business Isn’t Showing for Important Local Searches', 'text' => 'Customers are searching for your services in your area, but your business may not appear prominently in those results. This can mean missed opportunities before a potential customer ever reaches your website.'],
        ['title' => 'Competitors Keep Appearing Above You', 'text' => 'If competitors consistently show up ahead of your business, they may be sending the clicks, calls, and inquiries that could have gone to you.'],
        ['title' => 'Your Local Search Presence Has Gaps', 'text' => 'Your website, business information, local listings, and other online signals may not be working together clearly enough to establish strong local relevance.'],
        ['title' => 'You’re Getting Visibility but Not Enough Leads', 'text' => 'Ranking and traffic are only part of the picture. If local visitors are not becoming inquiries, calls, bookings, or customers, there may be a gap between visibility and conversion.'],
        ['title' => 'You Don’t Know What to Fix First', 'text' => 'Local SEO involves multiple areas, and not every issue has the same impact. Without identifying the biggest opportunities first, you can spend time and money on changes that do little to improve your results.'],
    ];
    $journeySteps = [
        ['title' => 'A Customer Searches', 'text' => 'A potential customer searches for a service, business, or solution in their area. The search may happen through Google Search, Google Maps, or another local discovery path.'],
        ['title' => 'Google Determines What Is Relevant', 'text' => 'Search engines evaluate which businesses and pages are relevant to the search, the customer\'s location, and the information available about each business.'],
        ['title' => 'Your Business Appears', 'text' => 'Depending on the search, your business may appear in organic results, Google Maps, the Map Pack, or other local search features.'],
        ['title' => 'The Customer Compares Options', 'text' => 'Customers may compare your services, website, reviews, business information, reputation, and overall credibility with other local businesses before choosing one.'],
        ['title' => 'The Customer Takes Action', 'text' => 'The goal is to make it easier for a qualified local customer to take the next step — whether that means calling, requesting a quote, booking, visiting, or submitting an inquiry.'],
        ['title' => 'Performance Informs the Next Opportunity', 'text' => 'Local SEO should be evaluated against actual search visibility, relevant traffic, inquiries, and competitive changes so future priorities are based on what is happening in the market.'],
    ];
    $strategyPillars = [
        ['title' => 'Local Search & Keyword Strategy', 'text' => 'We identify the searches that matter to your business, including the services, locations, and search intent behind them. This helps prioritize opportunities instead of targeting keywords simply because they have search volume.', 'icon' => 'search'],
        ['title' => 'Website & On-Page SEO', 'text' => 'Your important service and location information needs to be clear, useful, and properly structured. We improve the pages that support your local search opportunities while keeping the website focused on what customers actually need.', 'icon' => 'layout'],
        ['title' => 'Google Maps & Local Search Visibility', 'text' => 'We work to strengthen your presence across local search results and Google Maps so your business has a stronger opportunity to reach customers looking for nearby services.', 'icon' => 'map'],
        ['title' => 'Business Information & Local Listings', 'text' => 'Accurate business information matters across the places where customers and search engines encounter your business. We identify inconsistencies, outdated information, and relevant listing opportunities that may affect your local presence.', 'icon' => 'list'],
        ['title' => 'Local Authority & Trust', 'text' => 'Local relevance is supported by more than your own website. Relevant references, genuine customer feedback, local mentions, and other trust signals can help establish your business within its market.', 'icon' => 'shield'],
        ['title' => 'Competitive Opportunities', 'text' => 'We look beyond your own website to understand which businesses are competing for the same local customers, where they are stronger, and where realistic opportunities exist for your business to compete.', 'icon' => 'chart'],
    ];
    $outcomes = [
        ['title' => 'Reach Customers With Local Intent', 'text' => 'Focus on searches from people who are actively looking for the services or solutions your business provides.', 'icon' => 'signal'],
        ['title' => 'Give Visitors a Reason to Choose You', 'text' => 'Once customers find your business, clear services, useful information, trust signals, and strong messaging can help them decide whether to take the next step.', 'icon' => 'gauge'],
        ['title' => 'Create Clear Paths to Contact', 'text' => 'Your website and local presence should make it easy for potential customers to call, request a quote, book a service, visit your location, or get in touch.', 'icon' => 'path'],
        ['title' => 'Measure What Matters', 'text' => 'We look beyond rankings alone and consider the broader picture — including visibility, relevant traffic, inquiries, and other meaningful actions connected to your business goals.', 'icon' => 'growth'],
    ];
    $seoIcons = [
        'search' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>',
        'layout' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5h16M4 12h10M4 19h7"/><rect x="16" y="10" width="4" height="9" rx="1" stroke-width="1.5"/>',
        'map' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5-2V6l5 2 6-2 5 2v12l-5-2-6 2zM9 8v12M15 6v12"/>',
        'list' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 6h12M8 12h12M8 18h12M4 6h.01M4 12h.01M4 18h.01"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3l8 3v6c0 5-3.5 8.5-8 9-4.5-.5-8-4-8-9V6l8-3z"/>',
        'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 19V5M4 19h16M8 15v-4M12 15V8M16 15v-6"/>',
        'signal' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14a2 2 0 100-4 2 2 0 000 4zM8.5 9.5a5 5 0 000 5M15.5 9.5a5 5 0 010 5M6 7a8 8 0 000 10M18 7a8 8 0 010 10"/>',
        'gauge' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 16V9l4 2M5.5 17.5A8 8 0 1118.5 17.5"/>',
        'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h10M11 8l4 4-4 4M5 19h6"/>',
        'growth' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 19V5M4 19h16M8 15l3-4 3 2 4-6"/>',
    ];
    $processSteps = [
        ['n' => '01', 'title' => 'Assess', 'text' => 'We review your current local search presence, website, competitors, and key opportunities to understand where visibility may be limited.'],
        ['n' => '02', 'title' => 'Prioritize', 'text' => 'Not every SEO issue deserves the same attention. We identify the areas that can have the greatest potential impact based on your goals and market.'],
        ['n' => '03', 'title' => 'Optimize', 'text' => 'We implement improvements across the areas identified in your strategy, from website and local search optimization to business information and authority signals.'],
        ['n' => '04', 'title' => 'Measure & Refine', 'text' => 'We monitor performance, identify changes in the search landscape, and refine the strategy as new opportunities or challenges emerge.'],
    ];
    $whyItems = [
        ['title' => 'Austin Market Focus', 'text' => 'We build the strategy around the local market you want to reach and the customers you want to attract.'],
        ['title' => 'Business-First Strategy', 'text' => 'Recommendations are based on your services, goals, competition, and opportunities rather than a generic SEO checklist.'],
        ['title' => 'Connected Digital Marketing', 'text' => 'Local SEO can work alongside your website, PPC, social media, reputation, and other digital marketing efforts when those channels support the same business objectives.'],
        ['title' => 'Clear Priorities', 'text' => 'We focus on identifying what matters most first, rather than overwhelming your business with a long list of low-impact tasks.'],
        ['title' => 'Transparent Reporting', 'text' => 'You should understand what is being worked on, why it matters, and how performance is changing.'],
        ['title' => 'Focused on Business Growth', 'text' => 'The objective is not simply to report rankings. It is to improve your ability to reach relevant local customers and create meaningful business opportunities.'],
    ];
    $faqs = [
        ['q' => 'What is Local SEO?', 'a' => 'Local SEO is the process of improving a business\'s visibility when people search for relevant products or services in a specific geographic area.'],
        ['q' => 'Does Local SEO help my business appear on Google Maps?', 'a' => 'Yes. Google Maps and local search visibility are important parts of Local SEO. The specific opportunities for each business depend on its market, competition, business information, and overall local presence.'],
        ['q' => 'How long does Local SEO take to show results?', 'a' => 'There is no universal timeline. Results can depend on your current visibility, competition, website condition, market, and the work required. Local SEO is an ongoing process rather than a guaranteed fixed-time result.'],
        ['q' => 'How much does Local SEO cost in Austin?', 'a' => 'The cost depends on your business, competition, current SEO condition, goals, and scope of work. Dott Scale does not use a one-size-fits-all Local SEO package for every business.'],
        ['q' => 'Can Local SEO help service-area businesses?', 'a' => 'Yes. Local SEO can support businesses that serve customers within defined service areas, even when their business model is not based on customers visiting a storefront.'],
        ['q' => 'Do I need Local SEO if I already have a Google Business Profile?', 'a' => 'A Google Business Profile is one part of your local search presence. Local SEO can involve your website, search strategy, business information, local authority, competitive positioning, and other factors beyond the profile itself.'],
        ['q' => 'Can you help if another SEO company is already working on my website?', 'a' => 'Yes. A local SEO assessment can help identify current opportunities, potential gaps, and areas that may need greater attention before you decide what to change.'],
        ['q' => 'Will Local SEO guarantee a #1 ranking?', 'a' => 'Ranking depends on your website, competitors, SERP difficulty, business history, and existing SEO signals. We first analyze your site and competitors to understand the opportunity, required effort, and realistic timeframe before setting ranking expectations.'],
    ];
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(function ($faq) {
            return [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ];
        }, $faqs),
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Local SEO Services in Austin, TX',
        'provider' => [
            '@type' => 'Organization',
            'name' => 'Dott Scale',
            'url' => url('/'),
            'areaServed' => [
                '@type' => 'City',
                'name' => 'Austin',
            ],
        ],
        'description' => 'Local SEO services for Austin businesses to improve local search visibility, Google Maps presence, and qualified lead generation.',
        'serviceType' => 'Local SEO',
        'url' => url('/services/local-seo'),
    ];
@endphp

<script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

{{-- 1. Hero --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4 mt-20 sm:mt-24">
        <div class="w-full md:w-[85%] lg:w-[70%] m-auto text-center flex items-center justify-center flex-col">
            <div class="font-primary inline-block border border-white/10 backdrop-blur-[20px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-4 lg:mb-5 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex text-secondary"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Local SEO · Austin</p>
            </div>
            <h1 data-raw-content="true" class="!leading-[1.2] text-[26px] sm:text-[30px] md:text-[34px] lg:text-[40px] xl:text-[46px] font-primary font-bold text-bodybg mb-3">Local SEO for Austin Businesses</h1>
            <p data-raw-content="true" class="font-secondary font-normal text-sm sm:text-base text-bodybg/70 mb-5 md:mb-7 max-w-3xl">Get found when local customers are searching for the services you provide. Dott Scale helps Austin businesses improve their local search visibility, reach relevant customers, and turn local searches into more opportunities to connect and grow.</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="/contact-us" title="Get a Local SEO Assessment" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] px-6 inline-flex items-center justify-center hover:px-8 transition-all duration-300 ease-in-out">Get a Local SEO Assessment →</a>
                <a href="#how-it-works" title="See How It Works" class="group border border-white/20 text-bodybg rounded-[6px] h-[40px] px-6 inline-flex items-center justify-center hover:bg-bodybg/10 transition-all duration-300">See How It Works →</a>
            </div>
        </div>
    </div>
</section>

{{-- 2. Why visibility fails --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[80%] lg:w-[65%] mb-5 md:mb-8">
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-4">Why Your Business Isn’t Getting Enough Local Visibility</h2>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-bodybg/70">Being a good local business doesn’t automatically mean customers will find you when they search. You may have a website, a Google Business Profile, and positive reviews — but still struggle to appear where nearby customers are looking.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @foreach($painPoints as $item)
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6 {{ $loop->last ? 'sm:col-span-2 lg:col-span-1' : '' }}">
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">{{ $item['title'] }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 3. How local search works --}}
<section id="how-it-works" class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[80%] lg:w-[65%] mb-5 md:mb-8">
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-4">How Local Search Works for Your Business</h2>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-bodybg/70 mb-3">When someone searches for a local service, they are usually trying to solve a specific problem and may compare several businesses before deciding who to contact.</p>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-bodybg/70">Local SEO helps your business become visible at the right points in that journey — from the initial search to the moment a potential customer chooses to take action.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @foreach($journeySteps as $index => $item)
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <div class="text-secondary font-primary text-sm mb-2">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">{{ $item['title'] }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 4. Strategy — reference: icon grid / executive view --}}
<section class="py-8 md:py-14 bg-[#F3F5F7]">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full lg:w-[70%] mb-8 md:mb-12">
            <div class="inline-flex items-center gap-2 bg-[#0B1B33] text-white text-[11px] font-primary uppercase tracking-[2px] rounded-full px-3 py-1.5 mb-4 md:mb-5">
                <span class="text-[#E31B23] font-bold text-sm leading-none">+</span>
                <span>Local Strategy</span>
            </div>
            <h2 data-raw-content="true" class="text-2xl sm:text-3xl md:text-4xl lg:text-[44px] font-bold text-[#0B1B33] font-primary mb-3 md:mb-4 leading-tight">Your Local SEO Strategy</h2>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-[#5A6578] max-w-3xl">There is no single change that makes a business visible for every local search. Effective Local SEO brings together the areas that influence how your business is discovered, understood, evaluated, and chosen.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8 md:gap-x-8 md:gap-y-10">
            @foreach($strategyPillars as $item)
            <div class="flex flex-col items-start">
                <div class="w-11 h-11 rounded-[6px] bg-[#0B1B33] flex items-center justify-center mb-3 md:mb-4 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" class="w-5 h-5">{!! $seoIcons[$item['icon']] ?? $seoIcons['search'] !!}</svg>
                </div>
                <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-[#0B1B33] mb-2">{{ $item['title'] }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-[#5A6578] m-0 leading-relaxed">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 5. Visibility to opportunities — reference: growth engine card --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative overflow-hidden rounded-[12px] md:rounded-[16px] border border-white/10 bg-[#12151C]/90] backdrop-blur-[30px] p-5 sm:p-8 md:p-12 shadow-[inset_0_0_60px_rgba(255,255,255,0.04)]">
            <div class="pointer-events-none absolute -top-24 left-1/2 -translate-x-1/2 w-[80%] h-48 bg-gradient-to-b from-[#E31B23]/35 via-[#FF6A00]/15 to-transparent blur-3xl"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="absolute top-5 right-5 md:top-8 md:right-8 text-white/80"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <div class="relative z-[1]">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/10 text-white text-[11px] font-primary uppercase tracking-[2px] rounded-full px-3 py-1.5 mb-4 md:mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#E31B23]"></span>
                    <span>Growth Engine</span>
                </div>
                <h2 data-raw-content="true" class="text-2xl sm:text-3xl md:text-4xl lg:text-[44px] font-bold text-white font-primary mb-4 md:mb-5 leading-tight max-w-3xl">From Local Visibility to Real Business Opportunities</h2>
                <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-white/70 mb-8 md:mb-12 max-w-3xl">Getting discovered is only the beginning. A successful local search strategy should help move the right people from a Google search to a meaningful business action.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 pt-2 md:pt-4 border-t border-white/10">
                    @foreach($outcomes as $item)
                    <div class="flex flex-col items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" class="w-7 h-7 mb-3 md:mb-4 opacity-90">{!! $seoIcons[$item['icon']] ?? $seoIcons['growth'] !!}</svg>
                        <h3 data-raw-content="true" class="font-primary text-base md:text-lg font-semibold text-white mb-2">{{ $item['title'] }}</h3>
                        <p data-raw-content="true" class="font-secondary text-sm text-white/60 m-0 leading-relaxed">{{ $item['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. Process --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[80%] lg:w-[65%] mb-5 md:mb-8">
            <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Process</p>
            </div>
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-4">Our Local SEO Process</h2>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-bodybg/70">Our Local SEO process starts with understanding your current position and then prioritizing the opportunities most relevant to your business.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            @foreach($processSteps as $item)
            <div class="relative bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <div class="text-secondary font-primary text-sm mb-2">{{ $item['n'] }}</div>
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">{{ $item['title'] }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 7. What to fix first --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative rounded-[6px] p-5 md:p-10 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <h2 data-raw-content="true" class="capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 md:mb-4">What Should You Fix First?</h2>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-3 max-w-3xl">If your business is struggling with local visibility, the right starting point depends on what is actually limiting your performance.</p>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-3 max-w-3xl">You may need to address search targeting, website relevance, Google Maps visibility, business information, local authority, or the path between search visibility and customer conversion.</p>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-5 max-w-3xl">Instead of applying the same checklist to every business, we identify the areas that deserve attention first.</p>
            <a href="/contact-us" title="Get a Local SEO Assessment" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 inline-flex items-center justify-center hover:px-6 transition-all duration-300">Get a Local SEO Assessment →</a>
        </div>
    </div>
</section>

{{-- 8. Why Dott Scale --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="w-full md:w-[80%] lg:w-[65%] mb-5 md:mb-8">
            <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
                <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> Why Dott Scale</p>
            </div>
            <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-3 md:mb-4">Why Dott Scale</h2>
            <p data-raw-content="true" class="font-secondary text-sm sm:text-base text-bodybg/70">Local SEO should be connected to the way your business actually operates — not treated as a collection of disconnected SEO tasks.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @foreach($whyItems as $item)
            <div class="bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px] rounded-[6px] p-4 md:p-6">
                <h3 data-raw-content="true" class="font-primary text-lg font-semibold text-bodybg mb-2">{{ $item['title'] }}</h3>
                <p data-raw-content="true" class="font-secondary text-sm text-bodybg/70 m-0">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 9. Case studies — soft CTA until verified results --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative rounded-[6px] p-5 md:p-10 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <h2 data-raw-content="true" class="capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3 md:mb-4">Local SEO Results & Case Studies</h2>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-3 max-w-3xl">See how we approach local search challenges through research, strategy, implementation, and ongoing improvement.</p>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-5 max-w-3xl">Where relevant, we showcase real projects, the problems addressed, the work completed, and measurable outcomes.</p>
            <a href="/our-work" title="View Case Studies" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 inline-flex items-center justify-center hover:px-6 transition-all duration-300">View Case Studies →</a>
        </div>
    </div>
</section>

{{-- 10. Assessment CTA --}}
<section id="assessment" class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="relative rounded-[6px] p-5 md:p-10 bg-bodybg/10 border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] backdrop-blur-[30px]">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="inline-flex plus-icon2"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg>
            <h2 data-raw-content="true" class="capitalize text-2xl md:text-3xl lg:text-4xl font-bold text-bodybg font-primary mb-3">Get a Local SEO Assessment</h2>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-3 max-w-2xl">Not sure why your business isn't getting enough local visibility?</p>
            <p data-raw-content="true" class="font-secondary text-sm md:text-base text-bodybg/70 mb-5 max-w-2xl">Let's identify where your current local search presence stands, what may be limiting your visibility, and which opportunities deserve attention first.</p>
            <a href="/contact-us" title="Get Your Local SEO Assessment" class="red-arrow-btn group bg-bodybg text-primary rounded-[6px] h-[40px] w-max px-4 inline-flex items-center justify-center hover:px-6 transition-all duration-300">Get Your Local SEO Assessment →</a>
        </div>
    </div>
</section>

{{-- 11. FAQ --}}
<section class="py-5 md:py-10">
    <div class="container mx-auto px-3 sm:px-4">
        <div class="font-primary inline-block bg-bodybg/20 backdrop-blur-[40px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-3 md:mb-5 uppercase tracking-[2px]">
            <p data-raw-content="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#FFB237" viewBox="0 0 16 16" class="inline-flex"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path></svg> FAQ</p>
        </div>
        <h2 data-raw-content="true" class="capitalize text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white font-primary mb-4 md:mb-6">Frequently Asked Questions</h2>
        <div class="faq space-y-2">
            @foreach($faqs as $faq)
            <div class="faq-item {{ $loop->first ? 'active' : '' }} bg-bodybg/10 border border-white/10 rounded-[6px] px-4">
                <button type="button" class="faq-question w-full flex justify-between items-center py-4 text-left font-primary text-bodybg text-base md:text-lg">
                    <span>{{ $faq['q'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="shrink-0 ml-3"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/></svg>
                </button>
                <div class="faq-content" @if(!$loop->first) style="display:none" @endif>
                    <p class="font-secondary text-sm text-bodybg/70 pb-4">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
