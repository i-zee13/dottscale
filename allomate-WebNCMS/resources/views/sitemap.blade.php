@extends('layouts.cms') 
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/smoknic/css/static-page.css')}}">
@endsection
@section('content')
    <style>.dark-inner-header {
  background-color: var(--bs-primary);
  color: var(--bs-body-bg); 
}

.dark-inner-header h1 {
  font-size: var(--heading-02);
  margin-bottom: 0;
  margin-top: 15px;
  text-align: center;
  line-height: 1.1;
}

.dark-inner-header h1 span {
  font-weight: 100;
}
.dark-inner-header h2 {
  font-size: var(--heading-03);
  text-align: center;
  margin-bottom: 15px;
  display: block;
}
.dark-inner-header h2 span{ font-weight: normal;}

.dark-inner-header .dark-header-content {
  padding: 120px 0 60px 0;
}
.dark-inner-header .dark-header-content p{
  font-size: 18px;
  opacity: 0.7;
  text-align: center;
  width: 50%;
  margin: auto;
}
.dark-inner-header .dark-header-content .arrow-down{
  width: 55px; height: 55px;
  margin: 30px auto;
  display: block;

}
@media (max-width:1440px) {
.dark-inner-header .dark-header-content p{
  font-size: 16px;  
}
}
@media (max-width:1280px) {
.dark-inner-header .dark-header-content p{ 
  width: 60%; 
}
}
@media (max-width:991px) {
  .dark-inner-header .dark-header-content p{ 
    width: 80%; 
  }
  }
@media (max-width:767px) {
  .dark-inner-header .dark-header-content {
      padding: 80px 0 40px 0;
  }
  .dark-inner-header .dark-header-content p {
     font-size: 15px; 
    width: 100%; line-height: normal;
  }
  .dark-inner-header .dark-header-content .arrow-down {
    width: 45px;
    height: 45px;
    margin: 20px auto; 
}
.dark-inner-header h1 { 
  margin-top: 0; 
} 
}
@media (max-width:425px) {
  .dark-inner-header .dark-header-content {
    padding: 70px 0 30px 0;
  } 
  }
        .sitemap-list {
            padding-top: 30px;
            padding-bottom: 20px;
        }

        .sitemap-list-heading2 {
            font-size: 22px;
            font-weight: 500;
            position: relative;
            line-height: 1;
            margin-bottom: 15px;
        }

        .sitemap-list ul {
            margin: 0;
            padding-left: 1.875rem;
            position: relative;
            list-style: none;
            margin-bottom: 20px;
        }

        .sitemap-list ul li {
            position: relative;
            margin-bottom: 0rem;
            text-align: left;
            font-size: 0.875rem;
        }

        .sitemap-list ul li a {
            color: #040725 !important;
            text-decoration: none !important;
        }

        .sitemap-list ul li a:hover {
            color: #f12300 !important;
            text-decoration: underline !important;
        }

        .sitemap-list ul li:before {
            position: absolute;
            content: "";
            left: -1.875rem;
            top: 0.75rem;
            height: 0.125rem;
            width: 0.75rem;
            background: #001e35;
        }
        .section-content li:before {
            background: #001e35 !important;
        }

        .heading3 {
            font-size: 18px;
            color: #282828;
        }

        .heading3 a {
            color: #282828;
        }

        @media (max-width:767px) {
            .sitemap-list-heading2 {
                font-size: 20px;
            }
        }

        @media (max-width:480px) {
            .sitemap-list-heading2 {
                font-size: 18px;
            }

            .sitemap-list ul li {
                font-size: 13px;
            }
        }

        .sitemap-list ul ul li:before {
            background-color: #d4d4d3;

        }

        .set-cu-height {
            min-height: 310px !important;
        }

        @media (max-width:767px) {
            .set-cu-height {
                min-height: 200px !important;
            }
        }
    </style> 
<section class="dark-inner-header section-dark">
    <div class="dark-header-content">
        <div class="container">
            <ul data-raw-content="true" class="mil-breadcrumbs mil-light">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="javascript:void(0);">Sitemap</a></li>
            </ul>
            <div class="row">
                <div class="col-12">
                <h1>Sitemap</h1>
                    <!-- <h2 data-raw-content="true"><span>Be a Part of Something Great</span></h2> -->
                    <p data-raw-content="true">Explore and find tailored information, services, and resources easily on our site.</p><svg xmlns="http://www.w3.org/2000/svg" width="88.237" height="88.237" viewBox="0 0 88.237 88.237" class="arrow-down">
                        <g data-name="Group 127" transform="translate(2192.587 -264.18) rotate(135)" id="Group_127">
                            <g data-name="Ellipse 7" transform="translate(1706 1270)" fill="none" stroke="#f6f6f6" stroke-width="2" id="Ellipse_7">
                                <circle cx="31.196" cy="31.196" r="31.196" stroke="none"></circle>
                                <circle cx="31.196" cy="31.196" r="30.196" fill="none"></circle>
                            </g>
                            <path d="M13.546,23.927,12.574,23,22.932,12.644H0V11.282H22.981L12.622.924,13.546,0,25.51,11.963Z" transform="translate(1720.076 1302.115) rotate(-45)" fill="#f12300" stroke="#f12300" stroke-width="1" id="arrow"></path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="section-faqs section-content st-page-pt" style="padding-top: 0px !important;padding-bottom:0px !important;">
        <div class="sitemap-list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div style="margin-top: 15px;">
                            @foreach ($routes as $key => $route)
                                {{-- Pages --}}
                                @if ($key == 'pages')
                                    <h2 class="sitemap-list-heading2" itemprop="name" style="color:#282828">
                                        Pages
                                    </h2>
                                    <ul>
                                        @foreach ($route as $r)
                                        
                                            @if (isset($r['name']) && isset($r['slug']) && count($r) > 0 && ($r['name'] != 'pages'))
                                                <li>
                                                    <a href="{{ $r['slug'] }}"
                                                        title="{{ $r['name'] }}">{{ $r['name'] }}</a>

                                                </li>
                                                @else @dump($r)
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                             
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div style="margin-top: 15px;">
                            @foreach ($routes as $key => $route)
                                @if ($key == 'blogs')
                                    <h2 class="sitemap-list-heading2" itemprop="name">
                                        @php $name = strtoupper(str_replace('-', ' ', $key)); @endphp
                                        @if ($route[0] == 'blogs')
                                            <a style="color: #282828;" href="{{ $route[0] }}"
                                                title="{{ $name }}"> {{ $name }}</a>
                                        @else
                                            {{ $name }}
                                        @endif
                                    </h2>
                                    <ul>
                                        @foreach ($route as $r)
                                            @if (isset($r['name']) && isset($r['slug']) && count($r) > 0 && $r['name'] != 'blogs')
                                                <li>
                                                    <a href="{{ $r['slug'] }}"
                                                        title="{{ $r['name'] }}">{{ $r['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div style="margin-top: 15px;">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
