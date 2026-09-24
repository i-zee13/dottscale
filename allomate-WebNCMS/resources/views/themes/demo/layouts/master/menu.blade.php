<div id="topHeader" class="topheader">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 navbar-top">

                <div class="row">
                    <div class="col-auto">
                        <div class="khanllp"><a href="{{ route('home') }}"><img alt="" src="{{asset('images/khan-law.png')}}"></a> </div>
                    </div>
                    <div class="col m-auto">
                        <a class="head-btn tophead-btn" href="{{route('get-in-touch')}}">Contact US</a>
                        <a class="top-phone-no" href="tel:+16476435426"><i class="fa fa-phone"></i>
                            647-643-5426</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <nav id="navigation1" class="navigation">
            <div class="nav-header">
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper">
                <a href="index.html" class="mob-menu-logo"><img alt="" src="{{asset('images/khan-law.png')}}"></a>
                <ul class="nav-menu">
                    @foreach($primary_services as $primary)
                    <li>
                        <a href="{{route('services-detail')}}" class="dropdown-active">
                             {{$primary->service_name}}</a>
                        @if($primary->sub_survices->count())
                        <!-- Secondary services -->
                        <ul class="nav-dropdown">
                            @foreach($primary->sub_survices as $secondary)
                            <li>
                                <a href="{{route('services-detail')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                      </svg>
                                    {{$secondary->service_name}}</a>
                                <!-- Sub Secondary services -->
                                @if($secondary->sub_survices->count())
                                <ul class="nav-dropdown">
                                    @foreach($secondary->sub_survices as $sub)
                                    <li>
                                        <a href="{{route('services-detail')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                      </svg>
                                            {{$sub->service_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                <!-- End-Sub Secondary -->
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <!-- End Secondary -->

                    </li>
                    @endforeach
                    <a href="javascript:void(0);">Dropdown Menu</a>
                    <ul class="nav-dropdown">
                        <li>
                            <a href="javascript:void(0);">Menu Level 2</a>
                            <ul class="nav-dropdown">
                                <li><a href="javascript:void(0);" target="_blank">Link 1</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 2</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 3</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 4</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 5</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 6</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 7</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 8</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 9</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 10</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Menu Level 2</a>
                            <ul class="nav-dropdown">
                                <li>
                                    <a href="javascript:void(0);">Menu Level 3</a>
                                    <ul class="nav-dropdown">
                                        <li><a href="javascript:void(0);" target="_blank">Link 1</a></li>
                                        <li><a href="javascript:void(0);" target="_blank">Link 2</a></li>
                                        <li><a href="javascript:void(0);" target="_blank">Link 3</a></li>
                                        <li><a href="javascript:void(0);" target="_blank">Link 4</a></li>
                                        <li><a href="javascript:void(0);" target="_blank">Link 5</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);" target="_blank">Link 1</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 2</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 3</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 4</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 5</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Menu Level 2</a>
                            <ul class="nav-dropdown">
                                <li><a href="javascript:void(0);" target="_blank">Link 1</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 2</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 3</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 4</a></li>
                                <li><a href="javascript:void(0);" target="_blank">Link 5</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" target="_blank">Link 1</a></li>
                        <li><a href="javascript:void(0);" target="_blank">Link 2</a></li>
                        <li><a href="javascript:void(0);" target="_blank">Link 3</a></li>
                        <li><a href="javascript:void(0);" target="_blank">Link 4</a></li>
                        <li><a href="javascript:void(0);" target="_blank">Link 5</a></li>
                    </ul>
                    </li>

                    <!-- <li>
                        <a href="javascript:void(0);" class="dropdown-active">Full width</a>
                        <div class="megamenu-panel">
                            <div class="megamenu-lists">
                                <ul class="megamenu-list list-col-4">
                                    <li class="megamenu-list-title"><a href="javascript:void(0);">Title Name</a></li>
                                    <li><a href="javascript:void(0);">Link 1</a></li>
                                    <li><a href="javascript:void(0);">Link 2</a></li>
                                    <li><a href="javascript:void(0);">Link 3</a></li>
                                    <li><a href="javascript:void(0);">Link 4</a></li>
                                    <li><a href="javascript:void(0);">Link 5</a></li>
                                </ul>
                                <ul class="megamenu-list list-col-4">
                                    <li class="megamenu-list-title"><a href="javascript:void(0);">Title Name</a></li>
                                    <li><a href="javascript:void(0);">Link 1</a></li>
                                    <li><a href="javascript:void(0);">Link 2</a></li>
                                    <li><a href="javascript:void(0);">Link 3</a></li>
                                    <li><a href="javascript:void(0);">Link 4</a></li>
                                    <li><a href="javascript:void(0);">Link 5</a></li>
                                </ul>
                                <ul class="megamenu-list list-col-4">
                                    <li class="megamenu-list-title"><a href="javascript:void(0);">Title Name</a></li>
                                    <li><a href="javascript:void(0);">Link 1</a></li>
                                    <li><a href="javascript:void(0);">Link 2</a></li>
                                    <li><a href="javascript:void(0);">Link 3</a></li>
                                    <li><a href="javascript:void(0);">Link 4</a></li>
                                    <li><a href="javascript:void(0);">Link 5</a></li>
                                </ul>
                                <ul class="megamenu-list list-col-4">
                                    <li class="megamenu-list-title"><a href="javascript:void(0);">Title Name</a></li>
                                    <li><a href="javascript:void(0);">Link 1</a></li>
                                    <li><a href="javascript:void(0);">Link 2</a></li>
                                    <li><a href="javascript:void(0);">Link 3</a></li>
                                    <li><a href="javascript:void(0);">Link 4</a></li>
                                    <li><a href="javascript:void(0);">Link 5</a></li>
                                </ul>
                            </div>
                        </div>
                    </li> -->

                    <li>
                        <a href="javascript:void(0);">More</a>
                        <ul class="nav-dropdown">
                            <li><a href="{{route('what-we-do')}}">What We Do</a></li>
                            <li><a href="{{route('the-difference')}}">The Difference</a></li>
                            <li><a href="{{route('services-detail')}}">Services Page</a></li>
                            <li><a href="javascript:void(0);">Form Page</a></li>
                            <li><a href="{{route('blogs')}}">Blogs List</a></li>
                            <!-- <li><a href="blogs-detail.html">Blog Detail</a></li> -->
                            <li><a href="{{route('faqs')}}">FAQs</a></li>
                            <li><a href="{{route('get-in-touch')}}">Contact US</a></li>
                            <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </li>

                    <li><a href="{{route('aboutus')}}">Our Team</a></li>
                    <li><a href="{{route('blogs')}}">Blogs</a></li>
                </ul>
            </div>
        </nav>
    </div>

</div>
