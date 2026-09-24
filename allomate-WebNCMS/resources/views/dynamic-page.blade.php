@extends('layouts.cms')
@push('builder-css')
{!! str_replace('/upload',env('APP_URL').'/upload',$data['css']) !!}
@endpush
@section('content')
<style>
    .social a {
        display: inline-block!important;
        margin-bottom: 15px!important;
    }
</style>
<input type="hidden" value="{{env('APP_URL')}}" data="{{config('app.APP_URL')}}" id="app_url">

<input type="hidden" value="{{$page_id}}" id="pagebuilder_page_id">
<input type="hidden" value="{{ footerDetails()->organizationRecord['email'] }}" id="company_email_address">
<input type="hidden" value="{{ str_replace('<br>','',footerDetails()->organizationRecord['address'])}}"
    id="company_loaction_address">

@foreach ($data['blocks']['en'] as $key => $d)
{!! str_replace('/upload', env('APP_URL').'/upload', $d['html']) !!}
@endforeach
@endsection



@push('js')
<script>
    var all_blogs = [];
    var page_segments = location.href.split('/');
    if (page_segments[3] == "contact-us") {
        $('.subheader-insights').addClass('subheader-contact-page');
    }
    var iframe = [];
    var vedio = [];

    var block = $('.VideoWrapper').text();
    var block_id = block.split('][')
    $("iframe").each(function() {
        vedio.push($(this));
    })

    // var h1Text = $('.VideoWrapper').text().toLowerCase();
    vedio.forEach(function(element, ss) {
        $('.VideoWrapper').each(function() {
            var data = $(this).text();

            if (data.match((element.attr('block_id')))) {
                $(this).closest('.VideoWrapper').empty();
                $(this).closest('.VideoWrapper').append(element) //addClass((element.attr('block_id')));
            }
        })
        // if ($(this).text().toLowerCase() == h1Text)
        //       $(this).closest('.VideoWrapper').addClass((element.attr('block_id')));
    });
    $('.section-content').children().find('[data-raw-content]').each(function() {
        if ($(this).text() == '') {
            $(this).remove();
        } else {
            console.log($(this).text())
        }
    });
    var allBlogsInsights = [];
    $('.container').each(function() {
        if ($(this).find('.careers-cards-append').length > 0) {

            $.ajax({
                url: '/get-careers-positions',
                success: function(response) {
                    if (response.positions.length > 0) {
                        $('.careers-cards-append').empty();
                        response.positions.forEach(work => {
                            $('.careers-cards-append').append(`
                                <div class="col-lg-3 col-md-12">
                                    <div class="allo-position-cards allo-sc-gray">
                                        <div class="w-100">
                                            <h3>${work.title ?? ''}</h3>
                                        </div>
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col mt-auto mb-auto">
                                                    <p>${work.location ?? ''}</p>
                                                </div>
                                                <div class="col-auto pl-0 mt-auto">
                                                    <a href="/career/${work.slug ?? 'noSlugAvailable'}" class="allo-services-btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                                                            <path d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('.careers-cards-append').remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', status, error);
                }
            });
        }
        if ($(this).find('.client-logos').length > 0) {
            $.ajax({
                url: '/get-client-logos',
                success: function(response) {
                    if (response.data.length > 0) {
                        $('.client-logos').empty();
                        response.data.forEach(item => {
                            $('.client-logos').append(`
                                <div class="col-lg-2 col-4">
                                    <img width="130" height="65" height alt="${item.alt_text}" src="/storage/${item.logo}">
                                </div>
                            `);
                        });
                    } else {
                        $('.main-client-logos-div').remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', status, error);
                }
            });
        }
        // if ($(this).find('.portfolio-append-div').length > 0) {
        //     $.ajax({
        //         url: `/get-portfolios/1`,
        //         success: function(response) {
        //             if (response.data.length > 0) {
        //                 appendPortfolios(response.data,'portfolio-append-div');
        //             } else {
        //                 $('.main-portfolio-div').remove();
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.log('AJAX error:', status, error);
        //             $('.main-portfolio-div').remove();
        //         }
        //     });

        // }


        if ($(this).find('.contact-form').length > 0) {
            var organizationRecord  =   @json(footerDetails()->organizationRecord['location']);
            var mainOGRecord        =   @json(footerDetails()->organizationRecord);
            if(organizationRecord) {
                $('.allContactLocationInfo').empty();
                organizationRecord.forEach((location,key) => {
                    $('.allContactLocationInfo').append(`
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="title-menu city-name-div">${location.city != null ? location.city : ''},${location.country != null ? location.country : ''}</div>

                            <p class="address-div">${location.address != null ? location.address : ''}</p>
                                <span class="mil-no-wrap phone-div">${location.phone_no != null ? location.phone_no : ''}</span>
                                <span class="mil-no-wrap phone-div">${location.email != null ? location.email : ''}</span>
                            </p>
                        </div>
                    `);
                });
                $('.allContactLocationInfo').append(`
                    <div class="col-12"></div>
                `);
                $(`.contactusinfo`).append(`
                    <div class="row justify-content-between">
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="title-menu">Say Hello</div>
                            <a href="mailto:${mainOGRecord.email}"> ${mainOGRecord.email}</a>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="title-menu">Our Messengers:</div>
                            <div class="social">
                                ${mainOGRecord.fb_link ? `
                                <a target="_blank" href="${mainOGRecord.fb_link}" aria-label="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                                        </path>
                                    </svg>
                                </a>`:''}
                                ${mainOGRecord.twitter_link ? `
                                <a target="_blank" href="${mainOGRecord.twitter_link}" aria-label="Twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
                                        </path>
                                    </svg>
                                </a>`:''}
                                ${mainOGRecord.linkedin_link ? `
                                <a target="_blank" href="${mainOGRecord.linkedin_link}" aria-label="Linkedin">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z">
                                        </path>
                                    </svg>
                                </a>`:''}
                                ${mainOGRecord.insta_link ? `
                                <a target="_blank" href="${mainOGRecord.insta_link}" aria-label="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                                        </path>
                                    </svg>
                                </a>`:''}
                                ${mainOGRecord.youtube_link ? `
                                <a target="_blank" href="${mainOGRecord.youtube_link}" aria-label="Youtube">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-youtube" viewBox="0 0 16 16">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z">
                                        </path>
                                    </svg>
                                </a>`:''}
                                ${mainOGRecord.behance_link ? `
                                <a target="_blank" href="${mainOGRecord.behance_link}" aria-label="Behance">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-behance" viewBox="0 0 16 16">
                                                <path d="M4.654 3c.461 0 .887.035 1.278.14.39.07.711.216.996.391s.497.426.641.747c.14.32.216.711.216 1.137 0 .496-.106.922-.356 1.242-.215.32-.566.606-.997.817.606.176 1.067.496 1.348.922s.461.957.461 1.563c0 .496-.105.922-.285 1.278a2.3 2.3 0 0 1-.782.887c-.32.215-.711.39-1.137.496a5.3 5.3 0 0 1-1.278.176L0 12.803V3zm-.285 3.978c.39 0 .71-.105.957-.285.246-.18.355-.497.355-.887 0-.216-.035-.426-.105-.567a1 1 0 0 0-.32-.355 1.8 1.8 0 0 0-.461-.176c-.176-.035-.356-.035-.567-.035H2.17v2.31c0-.005 2.2-.005 2.2-.005zm.105 4.193c.215 0 .426-.035.606-.07.176-.035.356-.106.496-.216s.25-.215.356-.39c.07-.176.14-.391.14-.641 0-.496-.14-.852-.426-1.102-.285-.215-.676-.32-1.137-.32H2.17v2.734h2.305zm6.858-.035q.428.427 1.278.426c.39 0 .746-.106 1.032-.286q.426-.32.53-.64h1.74c-.286.851-.712 1.457-1.278 1.848-.566.355-1.243.566-2.06.566a4.1 4.1 0 0 1-1.527-.285 2.8 2.8 0 0 1-1.137-.782 2.85 2.85 0 0 1-.712-1.172c-.175-.461-.25-.957-.25-1.528 0-.531.07-1.032.25-1.493.18-.46.426-.852.747-1.207.32-.32.711-.606 1.137-.782a4 4 0 0 1 1.493-.285c.606 0 1.137.105 1.598.355.46.25.817.532 1.102.958.285.39.496.851.641 1.348.07.496.105.996.07 1.563h-5.15c0 .58.21 1.11.496 1.396m2.24-3.732c-.25-.25-.642-.391-1.103-.391-.32 0-.566.07-.781.176s-.356.25-.496.39a.96.96 0 0 0-.25.497c-.036.175-.07.32-.07.46h3.196c-.07-.526-.25-.882-.497-1.132zm-3.127-3.728h3.978v.957h-3.978z" />
                                            </svg>
                                </a>`:''}
                                ${mainOGRecord.clutch_link ? `
                                <a target="_blank" href="${mainOGRecord.clutch_link}" aria-label="Clutch">
                                   <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 59.8 60" style="enable-background:new 0 0 59.8 60;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #FFFFFF;
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0" d="M41,42.3c-3.1,2.7-7.1,4.2-11.2,4.1c-9.5,0-16.5-7-16.5-16.5S20,13.6,29.8,13.6c4.1-0.1,8.1,1.4,11.2,4.1
                                                                l2.1,1.8l9.2-9.2L50,8.2c-5.5-4.9-12.7-7.6-20.1-7.5C12.8,0.6,0.4,12.9,0.4,29.8s12.7,29.6,29.5,29.6c7.5,0.1,14.8-2.7,20.4-7.7
                                                                l2.3-2.1l-9.4-9.2L41,42.3z" />
                                                    <circle class="st0" cx="29.4" cy="30" r="9.9" />
                                                </g>
                                            </svg>
                                </a>`:''}
                            </div>
                        </div>
                    </div>
                `);
            }
        }
        if ($(this).find('.list-portfolio-append-div').length > 0) {
            $.ajax({
                url: `/get-portfolios`,
                success: function(response) {
                    if (response.data.length > 0) {
                        appendPortfolios(response.data,'list-portfolio-append-div');
                    } else {
                        $('.main-portfolio-list').remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', status, error);
                    $('.main-portfolio-div').remove();
                }
            });

        }
        if ($(this).find('.appendServicesDiv').length > 0) {
            var limit = page_segments[3] != 'services' ? 3 : '';
            appendServices(limit)
        }

        if ($(this).find('.hasClientReviews').length > 0) {
            $.ajax({
                url: '/get-client-reviews',
                success: function(response) {
                    var reviewsRating = 0;
                    if (response.reviews.length > 0) {
                        $('.hasClientReviews').empty();
                        $('.hasClientReviews').append(`
                                        <div class="swiper-slide">
                                            <div class="reviews-clutch-card-01">
                                                <div>Reviews on</div>
                                                <div class="clutch-rating-star">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="154" height="91.625"
                                                        viewBox="0 0 154 91.625">
                                                        <g id="Group_242" data-name="Group 242"
                                                            transform="translate(-193 -6019.254)">
                                                            <rect id="Rectangle_81" data-name="Rectangle 81" width="7.076"
                                                                height="43.869" transform="translate(233.139 6019.254)"
                                                                fill="#fff" />
                                                            <path id="Path_41" data-name="Path 41"
                                                                d="M353.707,245.078h7.076V215.36h-7.076v15.694h.128c0,6.562-5.66,7.2-7.2,7.2-4.117,0-5.016-3.989-5.016-6.432V215.36H334.54v16.724a15.141,15.141,0,0,0,3.473,9.907,12.014,12.014,0,0,0,8.491,3.087c2.446,0,5.66-.644,7.2-2.446Z"
                                                                transform="translate(-88.922 5818.045)" fill="#fff" />
                                                            <path id="Path_42" data-name="Path 42"
                                                                d="M437.754,218.446h7.076V195.8h5.146v-7.076H444.83V178.18h-7.076v10.548H432.48V195.8h5.274Z"
                                                                transform="translate(-159.076 5844.677)" fill="#fff" />
                                                            <path id="Path_43" data-name="Path 43"
                                                                d="M513.854,243.642a15.573,15.573,0,0,0,10.548-3.989l1.03-1.03-4.888-4.888-1.03,1.285a8.471,8.471,0,0,1-14.151-6.432c0-5.146,3.473-8.491,8.491-8.491a7.655,7.655,0,0,1,5.66,2.187l1.03.9,4.63-4.63-1.03-1.03a16.073,16.073,0,0,0-10.293-3.989c-8.746-.128-15.181,6.176-15.181,15.05A14.944,14.944,0,0,0,513.854,243.642Z"
                                                                transform="translate(-206.487 5819.354)" fill="#fff" />
                                                            <path id="Path_44" data-name="Path 44"
                                                                d="M611.536,192.759c0-6.562,4.888-7.2,6.432-7.2,4.117,0,4.117,3.989,4.117,6.432v17.368h7.075v-17.5c.128-3.858-.772-7.334-3.087-9.649a10.56,10.56,0,0,0-7.72-3.087,10.021,10.021,0,0,0-6.948,2.446V165.49H604.33v43.869h7.076v-16.6h.13Z"
                                                                transform="translate(-282.172 5853.767)" fill="#fff" />
                                                            <path id="Path_45" data-name="Path 45"
                                                                d="M533.15,253.936a5.016,5.016,0,1,0,5.016-5.016A5.021,5.021,0,0,0,533.15,253.936Z"
                                                                transform="translate(-231.186 5794.006)" fill="#e52421" />
                                                            <path id="Path_46" data-name="Path 46"
                                                                d="M169.267,212.466a19.692,19.692,0,0,0,14.665-6.176l1.03-1.03-4.63-4.888-.9,1.285a14.74,14.74,0,0,1-10.162,4.117c-7.975,0-13.638-6.176-13.638-14.537,0-8.491,5.66-14.537,13.507-14.537a15.48,15.48,0,0,1,10.162,4.117l1.03,1.03,4.63-4.63-1.03-1.03a19.831,19.831,0,0,0-14.665-6.176c-11.578.128-20.2,9.135-20.2,21.227S157.689,212.466,169.267,212.466Z"
                                                                transform="translate(43.93 5850.53)" fill="#fff" />
                                                            <path id="Path_54" data-name="Path 54"
                                                                d="M412.011,379.1h-8.335c-.2,0-.6-.2-.6-.4l-2.577-7.937a.762.762,0,0,0-1.387,0L396.54,378.7c0,.2-.4.4-.6.4H387.61a.654.654,0,0,0-.4,1.19l6.747,4.961c.2.2.4.4.2.792l-2.577,7.937c-.2.595.6,1.19.993.792l6.747-4.961a.6.6,0,0,1,.792,0l6.747,4.961a.662.662,0,0,0,.993-.792l-2.577-7.937a1.2,1.2,0,0,1,.2-.792l6.747-4.961C413,379.9,412.8,379.1,412.011,379.1Z"
                                                                transform="translate(-192.919 5715.973)" fill="#ff3d2f" />
                                                            <path id="Path_55" data-name="Path 55"
                                                                d="M473.231,379.1H464.9c-.2,0-.6-.2-.6-.4l-2.577-7.937a.762.762,0,0,0-1.387,0L457.76,378.7c0,.2-.4.4-.6.4H448.83a.654.654,0,0,0-.4,1.19l6.747,4.961c.2.2.4.4.2.792l-2.577,7.937c-.2.595.6,1.19.993.792l6.747-4.961a.6.6,0,0,1,.792,0l6.747,4.961a.662.662,0,0,0,.993-.792l-2.577-7.937a1.2,1.2,0,0,1,.2-.792l6.747-4.961C474.023,379.9,473.826,379.1,473.231,379.1Z"
                                                                transform="translate(-222.858 5715.973)" fill="#ff3d2f" />
                                                            <path id="Path_56" data-name="Path 56"
                                                                d="M535.8,379.1h-8.335c-.2,0-.6-.2-.6-.4l-2.577-7.937a.762.762,0,0,0-1.387,0L520.33,378.7c0,.2-.4.4-.595.4H511.4a.654.654,0,0,0-.4,1.19l6.747,4.961c.2.2.4.4.2.792l-2.577,7.937c-.2.595.6,1.19.993.792l6.747-4.961a.6.6,0,0,1,.792,0l6.746,4.961a.662.662,0,0,0,.993-.792l-2.577-7.937a1.2,1.2,0,0,1,.2-.792l6.747-4.961C536.6,379.9,536.4,379.1,535.8,379.1Z"
                                                                transform="translate(-253.457 5715.973)" fill="#ff3d2f" />
                                                            <path id="Path_57" data-name="Path 57"
                                                                d="M597.931,379.1H589.6c-.2,0-.6-.2-.6-.4l-2.577-7.937a.762.762,0,0,0-1.387,0L582.46,378.7c0,.2-.4.4-.6.4H573.53a.654.654,0,0,0-.4,1.19l6.747,4.961c.2.2.4.4.2.792l-2.577,7.937c-.2.595.6,1.19.993.792l6.747-4.961a.6.6,0,0,1,.792,0l6.747,4.961a.662.662,0,0,0,.993-.792l-2.577-7.937a1.2,1.2,0,0,1,.2-.792l6.747-4.961C598.723,379.9,598.526,379.1,597.931,379.1Z"
                                                                transform="translate(-283.844 5715.973)" fill="#ff3d2f" />
                                                            <path id="Path_58" data-name="Path 58"
                                                                d="M659.089,380.3a.654.654,0,0,0-.4-1.19h-8.335c-.2,0-.6-.2-.6-.4l-2.577-7.937a.762.762,0,0,0-1.387,0l-2.577,7.937c0,.2-.4.4-.6.4H634.29a.654.654,0,0,0-.4,1.19l6.747,4.961c.2.2.4.4.2.792l-2.577,7.937c-.2.6.595,1.19.993.792L646,389.821a.6.6,0,0,1,.792,0l6.747,4.961a.662.662,0,0,0,.993-.792l-2.577-7.937a1.2,1.2,0,0,1,.2-.792Z"
                                                                transform="translate(-313.534 5715.967)" fill="#ff3d2f" />
                                                        </g>
                                                    </svg>

                                                </div>

                                                <div class="clutch-rating-bottom">
                                                    <div class="clutch-rating-total">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="29.17" height="32.818"
                                                            viewBox="0 0 29.17 32.818">
                                                            <g id="Group_243" data-name="Group 243"
                                                                transform="translate(-165.606 -5850)">
                                                                <path id="Path_59" data-name="Path 59"
                                                                    d="M515.22,246.351a16.974,16.974,0,0,0,11.5-4.348l1.123-1.123-5.328-5.328-1.122,1.4a8.932,8.932,0,0,1-6.169,2.384c-5.328,0-9.255-3.785-9.255-9.394s3.785-9.255,9.255-9.255a8.344,8.344,0,0,1,6.169,2.384l1.122.98,5.047-5.047-1.123-1.123a17.519,17.519,0,0,0-11.219-4.348c-9.534-.139-16.547,6.732-16.547,16.4A16.289,16.289,0,0,0,515.22,246.351Z"
                                                                    transform="translate(-333.064 5636.467)" fill="#fff" />
                                                                <path id="Path_60" data-name="Path 60"
                                                                    d="M533.15,254.387a5.467,5.467,0,1,0,5.467-5.467A5.473,5.473,0,0,0,533.15,254.387Z"
                                                                    transform="translate(-356.883 5612.08)" fill="#e52421" />
                                                            </g>
                                                        </svg>
                                                        <div>${ response?.reviews.length ?? 0}</div>
                                                    </div>
                                                    <a href="https://clutch.co/profile/allomate-solutions" target="_blank" class="btn">Go to clutch</a>
                                                </div>
                                            </div>
                                        </div>
                            `);

                        response.reviews.forEach(review => {
                            reviewsRating += review.rating;
                            $('.hasClientReviews').append(`
                                <div class="swiper-slide">
                                    <div class="reviews-clutch-card">
                                        <div class="clutch-rating">
                                            <span class="clutch-icon">
                                                <svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.3666 8.97754C14.5728 8.97754 15.7295 9.45478 16.5824 10.3043C17.4352 11.1538 17.9144 12.3059 17.9144 13.5073C17.9144 14.7087 17.4352 15.8608 16.5824 16.7103C15.7295 17.5598 14.5728 18.0371 13.3666 18.0371C12.1605 18.0371 11.0037 17.5598 10.1509 16.7103C9.29798 15.8608 8.81885 14.7087 8.81885 13.5073C8.81885 12.3059 9.29798 11.1538 10.1509 10.3043C11.0037 9.45478 12.1605 8.97754 13.3666 8.97754Z" fill="#E94E3C"></path>
                                                    <path d="M13.5741 21.0418C15.5586 21.0418 17.3671 20.362 18.7367 19.1356L19.6928 18.2866L24 22.5063L22.9747 23.4601C20.5106 25.7407 17.1626 27 13.5725 27C5.84668 27 0 21.1467 0 13.4154C0 5.65124 5.70987 0 13.5725 0C17.0966 0 20.4099 1.25931 22.9055 3.50383L23.967 4.45771L19.7258 8.68047L18.7713 7.86286C17.3671 6.63644 15.5241 5.98956 13.5741 5.98956C9.09711 5.98956 5.98663 9.05482 5.98663 13.4483C5.98663 17.8418 9.19932 21.0418 13.5741 21.0418Z" fill="black"></path>
                                                </svg>
                                            </span>
                                            <div class="clutch-rating-stars">
                                            ${Array(review.rating).fill().map(() => `
                                                <span class="clutch-rating-star">
                                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.3668 0.794895C11.6977 0.124376 12.6538 0.124376 12.9848 0.794895L16.0092 6.92304C16.1406 7.1893 16.3946 7.37385 16.6884 7.41655L23.4512 8.39925C24.1912 8.50677 24.4867 9.41611 23.9512 9.93804L19.0576 14.7081C18.845 14.9154 18.748 15.214 18.7982 15.5067L19.9534 22.2421C20.0798 22.9791 19.3063 23.5411 18.6444 23.1932L12.5956 20.0131C12.3328 19.8749 12.0188 19.8749 11.756 20.0131L5.70712 23.1932C5.04527 23.5411 4.27174 22.9791 4.39814 22.2421L5.55337 15.5067C5.60356 15.214 5.50654 14.9154 5.29391 14.7081L0.400298 9.93804C-0.135144 9.41611 0.160319 8.50677 0.900281 8.39925L7.66309 7.41655C7.95693 7.37385 8.21094 7.1893 8.34235 6.92304L11.3668 0.794895Z" fill="#E94E3C"></path>
                                                    </svg>
                                                </span>
                                            `).join('')}
                                            </div>
                                            <span class="clutch-rating-text-v">${review.rating}</span>
                                        </div>

                                        <div class="reviews-clutch-card-content">
                                            <p>${review.review_content}</p>
                                        </div>
                                        <div class="reviews-clutch-card-name">
                                            <div>${review.author_name}</div>
                                            <span>${review.author_description}</span>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('.mainReviewsClient').remove();
                    }
                    if (parseInt(reviewsRating) > 0) {
                        var totalReviews = parseInt(response.reviews.length);
                        var averageRating = parseInt(reviewsRating) / totalReviews;
                        $('.reviews-clutch-verified').html(totalReviews + `<span>Verified Reviews</span>`);
                        $('.reviews-clutch-average').html(averageRating.toFixed(1) + `<span>Average Rating</span>`);

                    }

                }
            });
        }
        // Reviews Section Fetch
        if ($(this).hasClass('client-review-section')) {
            $.ajax({
                url: '/get-clients-review',
                success: function(response) {
                    var allIndicators = "";
                    var allReviews = "";
                    if (response.review_record.length > 0) {
                        response.review_record.forEach((element, key) => {
                            allIndicators += `
                                          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="${key}"
                                                class="${key == 0 ? 'active' : ''}" aria-current="true" aria-label="Slide ${key+1}"></button>
                                    `;
                            allReviews += `
                                          <div class="carousel-item ${key == 0 ? 'active' : ''}" data-bs-interval="8000">
                                                <figure class="mb-0"><img class="testimonials-icon" src="images/testimonials-icon.svg" alt="testimonials icon"></figure>
                                                <p itemprop="description">${element.review}</p>
                                                <div class="row g-3">
                                                      <div class="col-auto mt-auto mb-auto">
                                                            <figure class="mb-0"><img class="testimonial-avatar" src="images/testimonial-avater.svg" alt="avatar" itemprop="image"></figure>
                                                      </div>
                                                      <div class="col mt-auto mb-auto">
                                                            <div class="testimonial-name" itemprop="author">${element.name}</div>
                                                      </div>
                                                </div>
                                          </div>
                                    `;
                        });
                        $('.client-review-section-content').html(`
                                    <div id="carouselExampleDark" class="carousel carousel-dark slide review-dyanamic-div" data-bs-ride="carousel">
                                          <div class="carousel-indicators">
                                                ${allIndicators}
                                          </div>
                                          <div class="carousel-inner">
                                                ${allReviews}
                                          </div>
                                    </div>
                              `);
                    } else {
                        $('.section-client-testimonials').remove();
                    }
                }
            })
        }
        // Blogs Section Scroll Listing
        if ($(this).hasClass('has-blogs')) {
            $.ajax({
                url: '/get-latest-blogs',
                success: function(response) {
                    if (response.blogs.length > 0) {
                        $('.top-blog-list').empty();
                        response.blogs.forEach(blog => {
                            $('.top-blog-list').append(`

                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <article class="card-our-blogs" itemscope itemtype="http://schema.org/BlogPosting">
                                                    <figure itemscope itemtype="http://schema.org/ImageObject">
                                                        <img width="100" height="100" src="${blog.after_header_image}" alt="${blog.image}"
                                                            title="${blog.title}" itemprop="image" onerror="this.onerror=null;this.src='images/blog-01.jpg';">
                                                        <figcaption>
                                                            <div class="row m-0">
                                                                <div class="col">
                                                                    <time datetime="${blog.blog_date}" itemprop="datePublished"><small>${blog.blog_date}</small></time>
                                                                    <strong itemprop="articleSection">${blog.category}</strong>
                                                                </div>
                                                                <div class="col-auto pl-0 mt-auto mb-auto">
                                                                    <a href="${blog.slug ? '/blogs/blog-details/'+blog.slug : '#'}" class="card-our-blogs-link" itemprop="url">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                            class="mil-arrow">
                                                                            <path
                                                                                d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                                                                            </path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                    <h3 itemprop="headline">${blog.title}
                                                    </h3>
                                                    <meta itemprop="author" content="Allomate">
                                                    <meta itemprop="dateModified" content="${blog.blog_date}">
                                                    <meta itemprop="publisher" content="Allomate">
                                                </article>
                                            </div>

                                `);
                        });
                    } else {
                        $('.blog-section').remove();
                    }
                }
            });
        }
        // Blogs Section Scroll Listing
        if ($(this).hasClass('has-faqs')) {
            $.ajax({
                type: "POST",
                url: `/get-all-faqs`,
                data: {
                    _token: $('[name="csrf_token"]').attr('content'),
                    faqs_for: $('#pagebuilder_page_id').val()
                },
                success: function(response) {
                    if (response.faqs.length > 0) {
                        $('.faqs-list').empty();
                        response.faqs.forEach((faq, key) => {
                            $('.faqs-list').append(`
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" role="tab" id="heading${key+1}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse${key+1}" aria-expanded="false" aria-controls="collapse${key+1}">
                                                 ${faq.question}
                                            </button>
                                        </h3>
                                        <div id="collapse${key+1}" class="accordion-collapse collapse" role="tabpanel"
                                            aria-labelledby="heading${key+1}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                ${faq.answer ? faq.answer : ''}
                                            </div>
                                        </div>
                                    </div>
                                `);
                        });
                    } else {
                        $('.faqs-section').remove();
                    }
                }
            });
        }
        // Blogs listing in insight page
        // Blogs Section Scroll Listing

        if ($(this).hasClass('worksAppendDiv')) {
            $.ajax({
                url: '/get-works',
                success: function(response) {
                    if (response.works.length > 0) {
                        $('.worksAppendDiv').empty();
                        response.works.forEach(work => {
                            $('.worksAppendDiv').append(`
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                         <a href="portfolio-details.html" title="Masaj">
                            <div class="project-card">
                                <figure itemscope itemtype="http://schema.org/ImageObject">
                                    <img width="100" height="100" src="/${work.thumbnail}"
                                        alt="Allomate Works Images" itemprop="contentUrl">
                                    <figcaption>
                                        <small>${wo}</small>
                                        <h3 itemprop="name">${work_title}</h3>
                                    </figcaption>
                                </figure>
                            </div>
                        </a>
                    </div>

                                `);
                        });
                    } else {
                        $('.blog-section').remove();
                    }
                }
            });
        }
    });
    if ($(document).find('.mainPortfolioWorkSwiper').length > 0) {
            $.ajax({
                url: `/get-portfolios`,
                success: function(response) {
                    if (response.data.length > 0) {
                        console.log('portfolio',response.data);
                        $('.appendPortfolioSwiper').empty()
                        response.data.forEach(item => {
                            $('.appendPortfolioSwiper').append(`
                                    <a href="${item.route}" class="swiper-slide">
                                        <div class="project-card">
                                            <figure itemscope itemtype="http://schema.org/ImageObject">
                                                <img width="100" height="100" src="/storage/${item.thumbnail}"
                                                    alt="${item.portfolio_name??'image'}" itemprop="contentUrl">
                                                <figcaption>
                                                    <small>${item.category_names??''}</small>
                                                    <h3 itemprop="name">${item.portfolio_name??''}</h3>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </a>
                        `);
                        })
                        loadCustomScript(response.data);
                    } else {
                        $('.mainPortfolioWorkSwiper').remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', status, error);
                    $('.mainPortfolioWorkSwiper').remove();
                }
            });

        }
    if ($(document).find('.blogs-filter').length > 0) {
            $('.blogs-filter').empty();
            $.ajax({
                url: '/get-all-blogs',
                success: function(response) {
                    var insightsCategories = response.categories;
                    if (insightsCategories.length > 0) {
                        all_blogs = response.all_blogs;
                        $('.blogs-filter').append(`
                                        <div class="col-12">
                                            <div class="category-scroll">
                                                <div class="category-slots allBlogsCategories scroll-x">

                                                </div>
                                            </div>
                                        </div>
                                        `);
                                        $('.main-blogs').empty();
                                        $('.main-blogs').append(`
                                         <div class="container" id="blog-list">
                                            <div class="row g-3 g-lg-3 g-xl-4 list">
                                            </div>
                                            <div class="pagination justify-content-center pb-20"></div>
                                        </div>
                                        `);
                        if(insightsCategories.length > 1){
                            $('.allBlogsCategories').append(`
                                <input type="radio" name="blogCheck" id="radio-0000" data-no="0000" autocomplete="off" checked class="btn-check">
                                <label for="radio-0000" class="btn btn-outline-warning">All</label>
                            `);
                            }
                        insightsCategories.forEach((service,key) => {
                            $('.allBlogsCategories').append(`
                                <input type="radio" name="blogCheck" id="radio-${service.id}" data-no="${service.id}" autocomplete="off" class="btn-check">
                                <label for="radio-${service.id}" class="btn btn-outline-warning">${service.service_name}</label>
                            `);
                        });
                    } else {
                        $('.main-blogs').empty();
                        $('.blogs-filter').remove();
                    }
                    if(all_blogs && all_blogs.length > 0) {
                            initializeList(all_blogs);
                    }else{
                        renderNoBlogsDiv();
                    }
                    $('input[name="blogCheck"]').on('change', function() {
                        var checkedId = $(this).attr('data-no');
                        var relatedBlogs = [];
                        if (checkedId == '0000') {
                            relatedBlogs = all_blogs;
                        }   else {
                            relatedBlogs = all_blogs.filter(blog => blog.blog_category_id == checkedId);
                        }
                        if (relatedBlogs && relatedBlogs.length > 0) {
                            initializeList(relatedBlogs);
                        }
                        else {
                            renderNoBlogsDiv();
                        }
                    });
                    function renderNoBlogsDiv() {
                        $('.list').empty();
                        $(".pagination").empty();
                        $('.main-blogs').append(`
                        <div class="container">
                            <div class="row list ">
                                <div class="col-md-12">
                                    <div class="blog-placeholder">Currently, there are no blogs available in this category.</div>
                                </div>
                            </div>
                            <div>
                        `);
                    }
                    function initializeList(blogs) {
                        $('.list').empty();
                        var options = {
                            page: 9,
                            pagination: true,
                            blog: ['blog_date', 'after_header_image', 'service_name', 'slug', 'title', 'updated_at'],
                            item: function (blog) {
                                const formattedDate = new Date(blog.blog_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });
                                return `<div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <article class="card-our-blogs" itemscope itemtype="http://schema.org/BlogPosting">
                                            <figure itemscope itemtype="http://schema.org/ImageObject">
                                                <img width="100" height="100" src="${blog.after_header_image}" onerror="this.onerror=null;this.src='/images/blog-01.jpg';" alt="Allomate Blog Image" title="${blog.title}" itemprop="image">
                                                <figcaption>
                                                    <div class="row m-0">
                                                        <div class="col">
                                                            <time datetime="${blog.blog_date}" itemprop="datePublished"><small>${formattedDate}</small></time>
                                                            <strong itemprop="articleSection">${blog.category_name ?? 'General'}</strong>
                                                        </div>
                                                        <div class="col-auto pl-0 mt-auto mb-auto">
                                                            <a href="/blogs/blog-details/${blog.slug}" class="card-our-blogs-link" itemprop="url" title="Read Blog">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                                                                    <path d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <h3 class="title" itemprop="headline">${blog.title}</h3>
                                            <meta itemprop="author" content="Author Name">
                                            <meta itemprop="dateModified" content="${blog.updated_at}">
                                            <meta itemprop="publisher" content="Publisher Name">
                                        </article>
                                    </div>
                                `;
                            }
                        };
                        var blogList = new List('blog-list', options, blogs);
                        $('.pagination').find('li').addClass('page-item');
                        $('.pagination').find('a').addClass('page-link');
                        $('.pagination').find('a').attr('href','javascript:void(0)');
                    }
                    $(document).on('click','.page',function(){
                        $('.pagination').find('li').addClass('page-item');
                        $('.pagination').find('a').addClass('page-link');
                        $('.pagination').find('a').attr('href','javascript:void(0)');
                    });
                }

            });
    }

    function appendPortfolios(data, appendDiv) {
    $(`.${appendDiv}`).empty();
            data.forEach(item => {
                console.log(item);
                $(`.${appendDiv}`).append(`
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <a href="${item.route}" title="${item.portfolio_name??''}">
                            <div class="project-card">
                                <figure itemscope itemtype="http://schema.org/ImageObject">
                                    <img width="100" height="100" src="/storage/${item.thumbnail}"
                                        alt="${item.portfolio_name??'image'}" itemprop="contentUrl">
                                    <figcaption>
                                        <small>${item.category_names??''}</small>
                                        <h3 itemprop="name">${item.portfolio_name??''}</h3>
                                    </figcaption>
                                </figure>
                            </div>
                        </a>
                    </div>
                `);
            });
        }

        function appendServices(limit = null) {
        $.ajax({
            url: `/get-services/${limit}`,
            success: function(response) {
                if (response.services.length > 0) {
                    $('.appendServicesDiv').empty();
                    var key = 1;
                    response.services.forEach(services => {
                        if (response.services.length == key && page_segments[3] != 'services') {
                            $('.appendServicesDiv').append(`
                                          <div class="col-lg-4 col-md-6">
                                                <div class="home-services-card dark-card-pr">
                                                    <div class="row">
                                                        <div class="col-auto pr-0">
                                                            <div class="oac-icon">
                                                                <img src="/storage/${services.icon}" width="100" height="100" alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="col mt-auto mb-auto">
                                                            <h3>${services.service_name}</h3>
                                                        </div>

                                                    </div>
                                                    <p>${services.description}</p>
                                                    <a href="${services.route}" class="allo-services-btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                                                            <path
                                                                d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>

                                                <a href="/services" class="btn btn-primary home-view-all-services">
                                                    <span>View All Services</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                                                        <path
                                                            d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                `);
                        } else {
                            key = key + 1;
                            $('.appendServicesDiv').append(`
                                        <div class="col-lg-4 col-md-6">
                                                <div class="home-services-card">
                                                    <div class="row">
                                                        <div class="col-auto pr-0">
                                                            <div class="oac-icon">
                                                                <img src="/storage/${services.icon}"  width="100" height="100" alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="col mt-auto mb-auto">
                                                            <h3>${services.service_name}</h3>
                                                        </div>
                                                    </div>
                                                    <p>${services.description}</p>
                                                    <a href="${services.route}" class="allo-services-btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                                                            <path
                                                                d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                        </div>
                                `);
                        }

                    });
                } else {
                    $('.has-services').remove();
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', status, error);
            }
        });
    }
    $('#contact-form #first_name,#contact-form #last_name').addClass('only_alphabets');
    $('#contact-form #phone').addClass('only_phone');
    $('#propertForm #firstName,#propertForm #lastName').addClass('only_alphabets');
    $('#propertForm #phone').addClass('only_phone');
    $('#propertForm #askingPrice').addClass('only_point_numerics');
    $('#propertForm #zipCode').addClass('only_numerics');
    var company_email_address = $('#company_email_address').val();
    $('.company_email').attr('href', `mailto:${company_email_address}`);
    $('.company_email').html(company_email_address);
    $('.company_address').html($('#company_loaction_address').val());
    $(document).on('click', '.page', function() {
        $('.pagination').find('li').addClass('page-item');
        $('.pagination').find('a').addClass('page-link');
    });
    $(document).on('input', '.only_alphabets', function() {
        this.value = this.value.replace(/[^a-z\s.]/gi, '');
    });

    $(document).on('input', '.only_phone', function() {
        this.value = this.value.replace(/[^0-9+\s]/g, '');
    });
    $(document).on('input', '.only_point_numerics', function() {
        this.value = this.value.replace(/[^0-9.:]|(\.[0-9]{15,})/g, '');
    });
    $(document).on('input', '.only_numerics', function() {
        this.value = this.value.replace(/[^0-9]/gi, '');
    });
    $('form').each(function() {
        var form_id = $(this).attr('id');
        if (form_id == "propertForm") {
            $.ajax({
                url: '/get-all-states',
                cache: false,
                success: function(response) {
                    var all_states = response.states;
                    $('#propertForm #pr-form-state').empty();
                    $('#propertForm #pr-form-state').append('<option value="">Select State</option>');
                    if (all_states.length > 0) {
                        all_states.forEach(state => {
                            $('#propertForm #pr-form-state').append(`<option value="${state.id}">${state.name}</option>`);
                        });
                    }
                    $('#pr-form-state-error').hide();
                }
            });
        }
    });
    $(document).ready(function() {
        $('.collapse').removeClass('show');
        $('.collapse').first().addClass('show');
        var homeLink = $('a:contains("Home")');
        homeLink.attr('href', '/home');
        var contact = $('a:contains("Contact")');
        contact.attr('href', '/contact-us');

    })
    function loadCustomScript(portfolio) {
            // setTimeout(() => {
            const swiper = new Swiper(".swiper", {
                loop: false,
                centeredSlides: false,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                keyboard: {
                    enabled: true,
                    onlyInViewport: false,
                },
                mousewheel: {
                    invert: false,
                    //releaseOnEdges: true,
                    forceToAxis: true,
                },
                breakpoints: {
                    375: {
                        slidesPerView: 2,
                        spaceBetween: 8,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 8,
                    },
                    800: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                },
                on: {
                    init: function () {
                        updateSlideNumber(this);
                    },
                    slideChange: function () {
                        updateSlideNumber(this);
                    },
                },
                });
            function updateSlideNumber(swiperInstance) {
                console.clear();
                const currentSlide = document.querySelector('.currentSlide');
                const totalSlides = document.querySelector(".total-slide");
                if (!currentSlide || !totalSlides) {
                    return;
                }
                const realIndex = (swiperInstance.realIndex % portfolio.length) + 1;
                currentSlide.textContent = realIndex;
                totalSlides.textContent = '/' + (portfolio.length );
                console.log(currentSlide.classList);
                // Adding animation class for currentSlide
                currentSlide.classList.add("animate-number");
                setTimeout(() => {
                    currentSlide.classList.remove("animate-number");
                }, 300); // Duration of the animation
            }
            // Ensure the total slide count is set on page load
            const totalSlidesElement = document.querySelector(".total-slide");
            console.log(totalSlidesElement);

            const totalSlidesCount = document.querySelectorAll(
                ".swiper-wrapper > .swiper-slide:not(.swiper-slide-duplicate)"
            ).length;
            console.log(totalSlidesCount, 'zee');
            totalSlidesElement.textContent = "/" + portfolio.length;;
        // }, 200);

}




</script>


@endpush