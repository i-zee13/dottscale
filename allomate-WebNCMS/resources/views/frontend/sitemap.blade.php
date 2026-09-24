@extends('layouts.Frontend.app')

@section('title')
Sitemap
@endsection

@section('meta_description')
DottScale
@endsection

@section('meta_keywords')

@endsection

@section('og_description')
DottScale
@endsection

@section('content')
@verbatim
<section class="py-5 md:py-10">
        <div class="container mx-auto px-3 sm:px-4 mt-20 sm:mt-24">
            <div class="w-full md:w-[80%] lg:w-[60%] m-auto text-center flex items-center justify-center flex-col">
                <div
                    class="font-primary inline-block border border-white/10 backdrop-blur-[20px] text-bodybg text-[11px] rounded-[6px] pr-4 pl-2 py-1 mb-4 lg:mb-5 uppercase tracking-[2px]">
                    <p> <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex text-secondary" width="22"
                            height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                            </path>
                        </svg>
                        Site Map</p>
                </div>
                <h1
                    class="!leading-[1.2] text-2xl md:text-3xl lg:text-[40px] font-bold text-white font-primary mb-1.5 md:mb-4">
                    Explore Our Website
                </h1>
                <p class="font-secondary font-normal text-sm sm:text-base text-bodybg/70">
                    Our sitemap is designed to help you quickly navigate and find the information you're looking
                    for.
                    Browse through the main sections, services, and resources available on our website to easily
                    access the content that matters most to you.
                </p>
            </div>
        </div>
    </section>
       
    <section
        class=" content-area m-auto list-none [&_ul]:mt-4 [&_li]:relative [&_li]:pl-7 [&_li]:mb-1.5  [&_li::before]:content-[''] [&_li::before]:bg-secondary [&_li::before]:w-4 [&_li::before]:h-[1px] [&_li::before]:absolute [&_li::before]:left-0 [&_li::before]:top-[10px] [&_li::before]:text-2xl pb-3 md:pb-6">
        <div class="container mx-auto px-3 sm:px-4">
            <div
                class="border border-white/10 shadow-[inset_0_0_50px_rgba(255,255,255,0.1)] rounded-[6px] backdrop-blur-[30px] p-[20px] sm:p-[30px] w-full relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    viewBox="0 0 16 16" class="inline-flex plus-icon2">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                    </path>
                </svg>
                <div class="grid grid-cols-12 gap-3 sm:gap-5">
                    <div class="group col-span-12 lg:col-span-3">
                                                    
                                                            <h2 itemprop="name">
                                    General Pages
                                </h2>
                                <ul>
                                                                                                                        <li>
                                                <a href="terms-of-use"
                                                    title="Terms of Use">Terms of Use</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="privacy-policy"
                                                    title="Privacy Policy">Privacy Policy</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="home"
                                                    title="Home">Home</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="career"
                                                    title="Career">Career</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="about-us"
                                                    title="About Us">About Us</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="our-team"
                                                    title="Our Team">Our Team</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="the-next-horizon"
                                                    title="The Next Horizon">The Next Horizon</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="sell360-sales-platform"
                                                    title="SELL360 Sales Platform">SELL360 Sales Platform</a>

                                            </li>
                                                                                                            </ul>
                                                                                
                                                                                
                                                                                
                                                                        </div>

                    <div class="group col-span-12 lg:col-span-3">
                                                    
                                                                                
                                                            <h2 itemprop="name">
                                    Our Services
                                </h2>
                                <ul>
                                                                                                                        <li>
                                                <a href="/services/web-and-mobile-development"
                                                    title="Web And Mobile Development">Web And Mobile Development</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/services/enterprise-solutions"
                                                    title="Enterprise Solutions">Enterprise Solutions</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/services/mvp-design-and-development"
                                                    title="MVP Design &amp; Development">MVP Design &amp; Development</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/services/quality-assurance"
                                                    title="Quality Assurance">Quality Assurance</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/services/ai-and-automation"
                                                    title="AI and Automation">AI and Automation</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/services/dedicated-teams"
                                                    title="Dedicated Team">Dedicated Team</a>

                                            </li>
                                                                                                            </ul>
                                                                                
                                                                                
                                                                        </div>
                                        <div class="group col-span-12 lg:col-span-3">
                                                    
                                                                                
                                                                                
                                                            <h2 itemprop="name">
                                    Our Work
                                </h2>
                                <ul>
                                                                                                                        <li>
                                                <a href="/our-work/khan-law"
                                                    title="Khan Law">Khan Law</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/smoknic"
                                                    title="Smoknic">Smoknic</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/bni-inks"
                                                    title="Bni Inks">Bni Inks</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/disposable-vaping"
                                                    title="Disposable Vaping">Disposable Vaping</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/psl"
                                                    title="Pakistan Sign Langugae">Pakistan Sign Langugae</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/vape-suite"
                                                    title="Vape Suite">Vape Suite</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/source-code-academia"
                                                    title="Source Code Academia">Source Code Academia</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/danpak"
                                                    title="Danpak">Danpak</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/iron-horse-residential"
                                                    title="Iron Horse Residential">Iron Horse Residential</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/al-khair-distribution"
                                                    title="Al Khair Distribution">Al Khair Distribution</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/green-earth-recyling"
                                                    title="Green Earth Recyling">Green Earth Recyling</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/astorion"
                                                    title="Astorion">Astorion</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/masaj"
                                                    title="Masaj">Masaj</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/picpax"
                                                    title="PicPax">PicPax</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/h-shippers"
                                                    title="H Shippers">H Shippers</a>

                                            </li>
                                                                                                                                                                <li>
                                                <a href="/our-work/pocket-help"
                                                    title="Pocket Help">Pocket Help</a>

                                            </li>
                                                                                                            </ul>
                                                                                
                                                                        </div>
                    
                    <div class="group col-span-12 lg:col-span-3">
                                                                                                                                                                                                                                                <h2 itemprop="name">
                                                                                                                <a href="blogs"
                                            title="BLOGS"> BLOGS</a>
                                                                    </h2>
                                <ul>
                                                                                                                                                                                                    <li>
                                                <a href="blogs/blog-details/ai-voice-agents-the-475-billion-revolution-in-customer-experience"
                                                    title="Ai voice agents: the $47.5 billion revolution in customer experience">Ai voice agents: the $47.5 billion revolution in customer experience</a>
                                            </li>
                                                                                                                                                                <li>
                                                <a href="blogs/blog-details/ai-voice-agents-in-retail-hospitality-the-conversational-concierge"
                                                    title="Ai voice agents in retail &amp; hospitality: the conversational concierge">Ai voice agents in retail &amp; hospitality: the conversational concierge</a>
                                            </li>
                                                                                                                                                                <li>
                                                <a href="blogs/blog-details/ai-voice-agents-for-smbs"
                                                    title="Ai voice agents for smbs: the 24/7 virtual receptionist">Ai voice agents for smbs: the 24/7 virtual receptionist</a>
                                            </li>
                                                                                                            </ul>
                                                                        </div>
                </div>
            </div>
        </div>
    </section>
@endverbatim
@endsection
