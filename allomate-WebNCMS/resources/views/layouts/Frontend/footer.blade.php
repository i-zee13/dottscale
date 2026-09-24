<footer>
    <div class="container">

        <div class="row">

            <div class="col-xl-6 col-lg-7 col-md-21">
                <a href="/contact-us" title="" class="footer-icon-link">Get in touch with us we're eager to hear from you!
                    <span class="f-icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                            <path
                                d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                            </path>
                        </svg>
                    </span>
                </a>
                <p class="mb-0">Don't like the forms? Drop us a line via email.</p>
                <p><a class="f-email" href="mailto:{{ footerDetails()->organizationRecord['email'] }}">{{ footerDetails()->organizationRecord['email'] }}</a></p>
            </div>
            <div class="col-xl-2 col-lg-1">
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                <ul>
                @if (footerDetails()->footerItems)
                    @foreach (footerDetails()->footerItems as $footerItem)
                        @foreach ($footerItem['footer_menu'] as $link)
                            <li><a href="{{ $link['url'] }}" title="{{ $link['url'] }}">{{ $link['title'] }}</li></a>
                        @endforeach
                       
                    @endforeach
                @endif
                    <li><a href="/sitemap" title="Sitemap">Sitemap</li></a>
                </ul>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                <ul>
                    @if (footerDetails()->organizationRecord['behance_link'])
                        <li><a href="https://{{ footerDetails()->organizationRecord['behance_link'] }}" title="Behance" target="_blank"> Behance</li></a>
                    @endif
                    @if (footerDetails()->organizationRecord['dribble_link'])
                        <li><a href="https://{{ footerDetails()->organizationRecord['dribble_link'] }}" target="_blank" title="Dribbble"> Dribbble</li></a>
                    @endif
                    @if (footerDetails()->organizationRecord['clutch_link'])
                        <li><a href="https://{{ footerDetails()->organizationRecord['clutch_link'] }}" target="_blank" title="Clutch"> Clutch</li></a>
                    @endif
                    @if (footerDetails()->organizationRecord['insta_link'])
                        <li><a href="https://{{ footerDetails()->organizationRecord['insta_link'] }}" target="_blank" title="Instagram">Instagram</li></a>
                    @endif
                    @if (footerDetails()->organizationRecord['linkedin_link'])
                        <li><a href="https://{{ footerDetails()->organizationRecord['linkedin_link'] }}" target="_blank" title="Linkedin"> Linkedin</li></a>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row copyright">
            <div class="col-lg-6 col-md-6 col-sm-12 text-start">
                © DottScale {{date('Y')}}. All rights reserved
            </div>
        </div>
    </div>
</footer>
