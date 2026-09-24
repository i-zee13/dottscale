@extends('layouts.cms')
@section('content')

<style>
            .blog-detail-Header {
                color: #fff;
                width: 100%;
                height: 800px;
                position: relative;
                background-image: url(images/blog-detail-page.jpg);
                background-repeat: no-repeat;
                background-position: top center;
                background-color: #000000;
                background-size: auto 100%;
            }
            .blog-detail-Header .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            }
            .blog-detail-Header h1 {
                font-size: 90px;
                font-weight: 300;
                text-transform: uppercase;
                line-height: 1;
                margin-bottom: 0;
            }

            .blog-detail-Header h1 span {
                font-weight: 500;
                display: inline-block;
                background-color: #0038ba;
                padding: 5px 5px 10px 7px;
                line-height: .75;
            }

            .bd-cataegory {
                background-color: #fff;
                padding: 8px 22px;
                border-radius: 25px;
                color: #282828;
                font-size: 18px;
                font-family: 'Barlow Condensed', sans-serif;
                display: inline-block;
                line-height: 1;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .blog-detail-Header-b {
                margin-top: -60px;
                margin-bottom: 30px;
            }

            .bd-date {
                background-color: #555555;
                padding: 7px 20px;
                border-radius: 20px;
                color: #fff;
                font-size: 16px;
                display: inline-block;
                line-height: 1;
            }

            .social-f {
                float: right;
            }

            .social-f a {
                color: #fff;
                margin-top: 0;
                display: inline-block;
                height: 34px;
                width: 34px;
                text-align: center;
                background-color: #555555;
                -webkit-transition: all .3s ease 0s;
                -moz-transition: all .3s ease 0s;
                -o-transition: all .3s ease 0s;
                transition: all .3s ease 0s;
                margin-right: 0.625rem;
                border-radius: 50%;
            }

            .social-f a:HOVER {
                color: #101010;
                background-color: #fff;
            }

            .social-f .fa {
                font-size: 18px;
                line-height: 34px
            }

            .btn-next-blog,
            .btn-pre-blog {
                width: auto;
                border-radius: 18px;
                color: #fff;
                font-size: 16px;
                font-weight: 500;
                letter-spacing: 1px;
                text-transform: uppercase;
                padding: 8px 18px;
                line-height: 1;
                -webkit-transition: all .4s ease-in-out;
                -moz-transition: all .4s ease-in-out;
                -o-transition: all .4s ease-in-out;
                -ms-transition: all .4s ease-in-out;
                transition: all .4s ease-in-out;
                background: linear-gradient(90deg, #1e54d3 0, #0038ba 100%);
                display: inline-block;
                margin-bottom: 15px;
                margin-top: 15px;
            }

            .btn-next-blog:focus,
            .btn-pre-blog:focus,
            .btn-next-blog:hover,
            .btn-pre-blog:hover {
                background: linear-gradient(90deg, #282828 0, #1d1d1d 100%);
                text-decoration: none;
                color: #fff;
            }

            .btn-next-blog svg {
                margin-top: -2px;
                margin-left: 5px;
            }

            .btn-pre-blog svg {
                margin-top: -2px;
                margin-right: 5px;
            }

            .ck-editor {
                padding-top: 50px;
                padding-bottom: 30px;
            }

            @media (max-width:1440px) {
                .blog-detail-Header h1 {
                    font-size: 70px;
                    width: 84%;
                }

                .blog-detail-Header {
                    height: 670px;
                }
            }

            @media (max-width:1024px) {
                .blog-detail-Header {
                    height: 580px;
                }
            }

            @media (max-width:1024px) {
                .blog-detail-Header h1 {
                    font-size: 60px;
                }
            }

            @media (max-width:800px) {
                .blog-detail-Header h1 {
                    font-size: 50px;
                    width: 95%;
                }

                .bd-cataegory {
                    padding: 5px 20px;
                    font-size: 16px;
                }

            }

            @media (max-width:767px) {
                .blog-detail-Header h1 {
                    font-size: 35px;
                    width: 100%;
                }

                .blog-detail-Header {
                    height: 400px;
                }

                .bd-date {
                    padding: 5px 18px;
                    font-size: 14px;
                }

                .blog-detail-Header-b {
                    margin-top: -90px;
                }

                .social-f {
                    float: left;
                    margin-top: 15px;
                }

                .social-f a {
                    height: 32px;
                    width: 32px;
                }

                .social-f .fa {
                    font-size: 16px;
                    line-height: 32px;
                }

                .blog-detail-Header h1 span {
                    padding: 4px 4px 7px 4px;
                }

                .blog-detail-Header-b {
                    margin-bottom: 25px;
                }

                .btn-next-blog,
                .btn-pre-blog {
                    font-size: 14px;
                    padding: 6px 16px;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }

                .ck-editor {
                    padding-top: 30px;
                    padding-bottom: 20px;
                }
            }

            @media (max-width:480px) {
                .blog-detail-Header {
                    height: 65vh;
                }

                .blog-detail-Header h1 {
                    line-height: 1.15;
                    ;
                }
            }

            @media (max-width:425px) {
                .blog-detail-Header h1 {
                    font-size: 35px;
                }

                .bd-date {
                    padding: 4px 14px;
                    font-size: 13px;
                }

                .btn-next-blog,
                .btn-pre-blog {
                    padding: 6px 13px;
                }

                .btn-next-blog svg {
                    margin-left: 2px;
                }

                .btn-pre-blog svg {
                    margin-right: 2px;
                }
            }

            @media (max-width:375px) {
                .blog-detail-Header h1 {
                    font-size: 32px;
                }

                .bd-cataegory {
                    padding: 5px 15px;
                    font-size: 14px;
                }
            }

            @media (max-width:320px) {
                .blog-detail-Header h1 {
                    font-size: 28px;
                }

                .btn-next-blog svg {
                    margin-left: 0px;
                }

                .btn-pre-blog svg {
                    margin-right: 0px;
                }

                .btn-next-blog,
                .btn-pre-blog {
                    padding: 6px 8px;
                    font-size: 13px;
                    letter-spacing: normal;
                }
            }
        </style>


        <div class="blog-detail-Header d-flex" style="background-image:url(/storage/{{$blog_details->cover_image}}) !important;">
            <div class="container mt-auto  mb-auto">
                <div class="row">
                    <div class="col-12">
                        <div class="bd-cataegory">{{@$service_name->service_name ? @$service_name->service_name : 'General'}}</div>
                        <!-- <h1>Leveraging <span>Tech To Drive</span> A Better IT Experience</h1> -->
                        <h1>{{$blog_details->title}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container blog-detail-Header-b">
            <div class="row">
                <div class="col-md-6">
                    <div class="bd-date">{{date('d F, Y',strtotime($blog_details->blog_date))}}</div>
                </div>
                <div class="col-md-6">
                    <div class="social-f">
                        <a href="javascript:void(0);" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:void(0);" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:void(0);" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="javascript:void(0);" target="_blank"><i class="fa fa-envelope-o"></i></a>
                    </div>
                </div>
            </div>
        </div>



        <div class="container">

            <div class="row">
                <div class="col-12 ck-editor">  {!! $blog_details->blog_details !!} </div>
            </div>


            <div class="row">
                <div class="col-6 pr-0">
                    @if($single_previous_blog != '0')
                    <a href="/blogs/blog-details/{{$single_previous_blog->slug}}" class="btn-pre-blog">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14.502" height="12.69"
                            viewBox="0 0 14.502 12.69">
                            <path id="arrow-right-circle"
                                d="M8.156,13.594a.906.906,0,0,0,0,1.813h10.5L14.765,19.3a.907.907,0,1,0,1.283,1.283l5.438-5.437a.906.906,0,0,0,0-1.283L16.048,8.421A.907.907,0,0,0,14.765,9.7l3.891,3.89Z"
                                transform="translate(21.752 20.845) rotate(180)" fill="#fff" fill-rule="evenodd" />
                        </svg>
                        Previous Blog</a>
                        @endif
                    </div>
                <div class="col-6">
                @if($single_next_blog != '0')
                <a href="/blogs/blog-details/{{$single_next_blog->slug}}" class="btn-next-blog float-right">Next Blog <svg
                            xmlns="http://www.w3.org/2000/svg" width="14.502" height="12.69" viewBox="0 0 14.502 12.69">
                            <path id="arrow-right-circle"
                                d="M8.156,13.594a.906.906,0,0,0,0,1.813h10.5L14.765,19.3a.907.907,0,1,0,1.283,1.283l5.438-5.437a.906.906,0,0,0,0-1.283L16.048,8.421A.907.907,0,0,0,14.765,9.7l3.891,3.89Z"
                                transform="translate(-7.25 -8.155)" fill="#fff" fill-rule="evenodd" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

        </div>


@endsection
@push('js')
<!-- <script src="{{mix('js/custom/blogs.js')}}"></script> -->
@endpush
