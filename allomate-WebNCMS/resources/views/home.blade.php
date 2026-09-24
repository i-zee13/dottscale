@extends('layouts.cms')
@section('content')
    <section class="slider-section position-relative">
        <a href="#">
            <figure class="main-img">
                <picture>
                    <source media="(max-width: 480px)" srcset="/images/header-xsm.jpg" data-src="/images/header-xsm.jpg">
                    <source media="(max-width: 1024px)" srcset="/images/header-md.jpg" data-src="/images/header-md.jpg">
                    <source media="(min-width: 1025px)" srcset="/images/header-lg.jpg" data-src="/images/header-lg.jpg">
                    <img src="/images/header-lg.jpg" data-src-base="/images/"
                        data-src="{xs:/images/header-xsm.jpg,md:/images/header-md.jpg,xl:/images/header-lg.jpg}"
                        title="Allomate Solutions" alt="Allomate Solutions">
                </picture>
            </figure>
        </a>
        <div class="container position-relative">
            <div class="content-overlay">
                <h1>Maximize Your <br><span>Real Estate</span> Investments</h1>
                <p>Expert solutions for Investors and Homeowners alike.</p>
                <a href="#" class="btn btn-primary" title="Contact Us">Contact Us</a>
            </div>
        </div>
    </section>

    <section class="welcome-section section-padding-set">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h2>With Over 50 Years of Combined Experience in Real Estate Investment</h2>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Allomate Solutions stands at the forefront of real estate investment, offering tailored
                        solutions that meet
                        the unique needs of institutional investors, portfolio owners, and individual homeowners.
                        Our expertise spans
                        across acquiring, managing, and optimizing real estate assets to ensure maximum returns and
                        sustainable growth.</p>
                    <a href="#" class="btn btn-primary" title="LEARN MORE">LEARN MORE</a>
                </div>
            </div>
        </div>

    </section>


    <section class="strategies-section section-padding-set">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-12">
                    <h2>Specialized Strategies<br> for Diverse Real Estate Needs</h2>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="strategies-01 d-flex flex-column justify-content-between">
                                <h3>Institutional Investment Strategy</h3>
                                <p>Robust solutions for institutional investors seeking sustainable growth and
                                    optimized returns in the
                                    real estate market.</p>
                                <button class="btn btn-primary mt-auto" title="LEARN MORE">LEARN MORE</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="strategies-02">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="strategies-l-img" src="/images/strategies-02.jpg"
                                            title="Single Homeowner Solutions" alt="Single Homeowner Solutions">
                                    </div>
                                    <div class="col d-flex flex-column justify-content-between">
                                        <h3>Single Homeowner Solutions</h3>
                                        <p>A comprehensive range of solutions for homeowners facing any situation,
                                            from selling to overcoming
                                            financial obstacles, ensuring stability and peace of mind.</p>
                                        <button class="btn btn-primary mt-auto" title="LEARN MORE">LEARN
                                            MORE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="strategies-03 d-flex align-items-end">
                        <div class="mt-auto">
                            <h3>Portfolio Management Strategy</h3>
                            <p>Custom strategies to enhance the value and performance of real estate portfolios,
                                leveraging deep market insights.</p>
                            <button class="btn btn-primary" title="LEARN MORE">LEARN MORE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="services-section-cards-2024 section-padding-set">
        <div class="container">
            <div class="row g-3">

                <div class="col-lg-6 col-md-12 d-flex flex-column">
                    <h2>Our Services</h2>
                    <div class="services-section-cards-img">
                        <img src="/images/services-section-cards-2024.jpg" title="Mortgage Consultation"
                            alt="Mortgage Consultation">
                        <button class="btn btn-primary" title="Mortgage Consultation">
                            <span>Mortgage Consultation</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.165" height="32.165"
                                viewBox="0 0 32.165 32.165">
                                <path id="arrow"
                                    d="M13.212,19.776l-.8-.764,8.562-8.562H0V9.325H21.009L12.448.764,13.212,0,23.1,9.888Z"
                                    transform="translate(0.854 17.334) rotate(-45)" stroke-width="1" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <p>Tailored services designed to meet your unique home financing needs. Expert assistance to
                        navigate the complexities of home financing.
                        Personalized solutions to guide you toward your dream home.</p>
                    <div class="row g-3">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="section-cards-w-2024 d-flex flex-column justify-content-between">
                                <h3>Refinancing Assistance</h3>
                                <p>Streamline your financial goals with our expert refinancing assistance.
                                    We guide you through the process to optimize your mortgage terms and save you
                                    money.</p>
                                <button class="btn btn-primary mt-auto" title="View Details">View Details</button>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="section-cards-pr-2024 d-flex flex-column justify-content-between">
                                <h3>Efficient Home Loan</h3>
                                <p>Expert guidance tailored to your unique financial situation, ensuring you make
                                    informed decisions on your mortgage journey.</p>
                                <button class="btn btn-primary mt-auto" title="View Details">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="insights-news section-padding-set">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="insights-news-card-list">

                        <div class="row g-3">
                            <div class="col">
                                <h2>Insights <span>News.</span></h2>
                            </div>
                            <div class="col-auto pl-0">
                                <button class="btn btn-primary" title="View All">View All</button>
                            </div>
                        </div>

                        <div class="overflowx scroll-x">
                            <div class="fp-overFlow">

                                <div class="row g-3">
                                    <div class="col-4 insights-news-w-colum">
                                        <div class="insights-news-card">
                                            <div class="published-date">Published: 28 Feb, 2024</div>
                                            <h3>10 Essential Tips for First-Time Homebuyers First-Time Homebuyers
                                            </h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry.
                                                Lorem Ipsum has been the industry's standard dummyIpsum is simply
                                                dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy</p>
                                            <a class="insights-link" href="#" title="Home Buying Guides">Home Buying
                                                Guides 1 2 3 4 5 6 7 8 9 2 3 4 5 6 7 8 9
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.401" height="15.269"
                                                    viewBox="0 0 27.401 15.269">
                                                    <path id="arrow"
                                                        d="M9.262,13.864,8.7,13.329l6-6H-10V6.537H14.729l-6-6L9.262,0l6.932,6.932Z"
                                                        transform="translate(10.5 0.707)" stroke-width="1" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 insights-news-w-colum">
                                        <div class="insights-news-card">
                                            <div class="published-date">Published: 28 Feb, 2024</div>
                                            <h3>10 Essential Tips for First-Time Homebuyers First-Time Homebuyers
                                            </h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry.
                                                Lorem Ipsum has been the industry's standard dummyIpsum is simply
                                                dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy</p>
                                            <a class="insights-link" href="#" title="Home Buying Guides">Home
                                                Buying
                                                Guides 1 2 3 4 5 6 7 8 9 2 3 4 5 6 7 8 9
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.401" height="15.269"
                                                    viewBox="0 0 27.401 15.269">
                                                    <path id="arrow"
                                                        d="M9.262,13.864,8.7,13.329l6-6H-10V6.537H14.729l-6-6L9.262,0l6.932,6.932Z"
                                                        transform="translate(10.5 0.707)" stroke-width="1" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 insights-news-w-colum">
                                        <div class="insights-news-card">
                                            <div class="published-date">Published: 28 Feb, 2024</div>
                                            <h3>10 Essential Tips for First-Time Homebuyers First-Time Homebuyers
                                            </h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry.
                                                Lorem Ipsum has been the industry's standard dummyIpsum is simply
                                                dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy</p>
                                            <a class="insights-link" href="#" title="Home Buying Guides">Home
                                                Buying
                                                Guides 1 2 3 4 5 6 7 8 9 2 3 4 5 6 7 8 9
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.401" height="15.269"
                                                    viewBox="0 0 27.401 15.269">
                                                    <path id="arrow"
                                                        d="M9.262,13.864,8.7,13.329l6-6H-10V6.537H14.729l-6-6L9.262,0l6.932,6.932Z"
                                                        transform="translate(10.5 0.707)" stroke-width="1" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 insights-news-w-colum">
                                        <div class="insights-news-card">
                                            <div class="published-date">Published: 28 Feb, 2024</div>
                                            <h3>10 Essential Tips for First-Time Homebuyers First-Time Homebuyers
                                            </h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry.
                                                Lorem Ipsum has been the industry's standard dummyIpsum is simply
                                                dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy</p>
                                            <a class="insights-link" href="#" title="Home Buying Guides">Home
                                                Buying
                                                Guides 1 2 3 4 5 6 7 8 9 2 3 4 5 6 7 8 9
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.401" height="15.269"
                                                    viewBox="0 0 27.401 15.269">
                                                    <path id="arrow"
                                                        d="M9.262,13.864,8.7,13.329l6-6H-10V6.537H14.729l-6-6L9.262,0l6.932,6.932Z"
                                                        transform="translate(10.5 0.707)" stroke-width="1" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="faq-202405 section-padding-set">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <h2>Questions & <span>Answers</span></h2>
                    <p>Don’t find the answer? We can help</p>
                    <button class="btn btn-primary" title="Contact Us">Contact Us</button>
                </div>

                <div class="col-lg-8 col-md-12">

                    <div class="accordion" id="faqAccordion" role="tablist" aria-multiselectable="true">
                        <!-- Question 1 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" role="tab" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span>01</span> What are the steps involved in buying a home?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.
                                </div>
                            </div>
                        </div>
                        <!-- Question 2 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" role="tab" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>02</span> How much money do I need for a down payment?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.
                                </div>
                            </div>
                        </div>
                        <!-- Question 3 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" role="tab" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>03</span> What is a mortgage pre-approval, and why is it important?
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.
                                </div>
                            </div>
                        </div>
                        <!-- Question 4 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" role="tab" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>04</span> What factors should I consider when choosing a neighborhood?
                                </button>
                            </h3>
                            <div id="collapseFour" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.
                                </div>
                            </div>
                        </div>
                        <!-- Question 5 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header" role="tab" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <span>05</span> What are closing costs, and who typically pays for them?
                                </button>
                            </h3>
                            <div id="collapseFive" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type and scrambled it
                                    to make a type specimen book.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="section-padding-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter-202405">
                        <h2>Stay informed with our newsletter for valuable tips and exclusive offers. Elevate your
                            homeownership journey –
                            sign up today!</h2>

                        <div class="subscribe">
                            <button type="button" class="btn btn-primary" title="Join">Join</button>
                            <input type="email" class="form-control" placeholder="Your Email *" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
