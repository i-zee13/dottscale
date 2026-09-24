@extends('layouts.cms')
@section('content')
<style>
            .blog-card-list {
                padding-top: 15px;
                padding-bottom: 40px;
            }
            .blog-card-list .blog-th-img {
                padding-left: 0;
            }
            .blog-card-list .blog-th-img img {
                width: 100%;
                height: auto;
            }
            .blogs-list-header {}
            .blogs-list-header .subText {
                width: 70%;
                margin-left: auto;
                margin-right: auto;
            }
            .category {
                width: 100%;
                margin: auto;
                position: relative;
                padding: 15px 0 10px 0;
                float: left;
                overflow: auto;
            }
            .category .c-d-w {
                width: max-content;
            }
            .category a {
                font-size: 15px;
                padding: 6px 20px;
                float: left;
                border-radius: 1.875rem;
                text-decoration: none;
                white-space: nowrap;
                background-color: #f2f2f2;
                color: #515151;
                margin-left: 4px;
                margin-right: 4px;
                font-family: 'Barlow Condensed', sans-serif;
                font-weight: bold;
                text-transform: uppercase;
            }
            .category a.active,
            .category a:hover {
                background-color: #0038ba;
                color: #fff;
                cursor: pointer;
            }
            .mCSB_horizontal.mCSB_inside>.mCSB_container {
                margin-bottom: 25px;
            }
            .blog-card {
                position: relative;
                border: 1px solid #ACACAC;
                padding: 10px;
                margin-right: -50px;
                z-index: 2;
            }
            .blog-card .blog-card-div {
                background-color: #f7f5f5;
                padding: 30px;
                position: relative;
            }
            .blog-card .blog-card-div h1 {
                font-size: 40px;
                margin-bottom: 20px;
                text-transform: uppercase;
                line-height: 1;
                letter-spacing: normal;
                height: 85px;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                position: relative;
            }
            .blog-card .blog-card-div .date-d {
                background-color: #E4E4E4;
                font-size: 14px;
                padding: 6px 12px;
                border-radius: 20px;
                display: block;
                width: fit-content;
                line-height: 1;
                top: 0;
                margin-left: auto;
                margin-top: -15px;
                margin-right: -15px;
                letter-spacing: normal;
            }
            .blog-card .blog-card-div .cataegory-n {
                font-size: 18px;
                text-transform: uppercase;
                color: #0038ba;
                margin-bottom: 15px;
                font-weight: bold;
                display: block;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
            }
            .blog-card .blog-card-div .cataegory-n svg {
                margin-right: 8px;
            }
            .blog-card .blog-card-div p {
                font-size: 16px;
                margin-bottom: 20px;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                position: relative;
                height: 75px;
            }
            .blog-card .blog-card-div .btn-readmore {
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
            }
            .blog-card .blog-card-div .btn-readmore:hover,
            .blog-card .blog-card-div .btn-readmore:focus {
                text-decoration: none;
            }
            .left-img-blog {}
            .left-img-blog .blog-th-img {
                padding-left: 15px;
                padding-right: 0;
            }
            .left-img-blog .blog-card {
                margin-left: -50px;
                margin-right: 0;
            }
            .search-blogs {
                width: 360px;
                position: relative;
                margin-left: auto;
                margin-bottom: 15px;
            }
            .search-blogs input {
                font-size: 15px;
                background-color: #f2f2f2;
                padding: 6px 10px 6px 40px;
                border: solid 1px #f2f2f2;
                width: 100%;
                height: 38px;
                border-radius: 25px;
                letter-spacing: 1px;
            }
            .search-blogs input:focus {
                border: solid 1px #0038ba;
            }
            .search-blogs svg {
                width: 20px;
                height: 20px;
                position: absolute;
                top: 9px;
                left: 12px;
                opacity: 0.6;
            }
            .pagination {
                margin-bottom: 40px;
                margin-top: 20px;
            }
            .page-item.active .page-link {
                background-color: #0038ba;
                border-color: #0038ba;
                border-radius: 0;
            }
            .page-item:last-child .page-link {
                border-top-right-radius: 20px;
                border-bottom-right-radius: 20px;
                padding-right: 20px;
            }
            .page-item:first-child .page-link {
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
                padding-left: 20px;
            }
            .page-link,
            .page-link:hover {
                color: #0038ba;
            }
            @media (max-width:1024px) {
                .search-blogs {
                    width: 320px;
                }
                .blog-card .blog-card-div {
                    padding: 20px;
                }
                .blog-card .blog-card-div h1 {
                    font-size: 34px;
                    margin-bottom: 15px;
                    height: 72px;
                }
                .blog-card .blog-card-div .cataegory-n {
                    font-size: 16px;
                }
                .blog-card .blog-card-div p {
                    font-size: 14px;
                    height: 65px;
                }
                .blog-card .blog-card-div .btn-readmore {
                    font-size: 14px;
                }
                .blog-card .blog-card-div .date-d {
                    font-size: 12px;
                    margin-top: -5px;
                    margin-right: -5px;
                }
                .search-blogs input {
                    font-size: 14px;
                    height: 34px;
                    border-radius: 20px;
                }
                .search-blogs svg {
                    width: 18px;
                    height: 18px;
                    top: 9px;
                    left: 12px;
                }
            }
            @media (max-width:800px) {
                .left-img-blog .blog-card {
                    margin-left: 0;
                }
                .left-img-blog .blog-th-img {
                    padding-right: 15px;
                }
                .blog-card-list .blog-th-img {
                    padding-left: 15px;
                }
                .blog-card-list {
                    flex-direction: column-reverse;
                }
                .left-img-blog {
                    flex-direction: unset;
                }
                .blog-card-list {
                    padding-top: 0;
                }
                .blog-card,
                .left-img-blog .blog-card {
                    margin: -40px 15px 15px 15px;
                }
                .blogs-list-header .subText {
                    width: 90%;
                }
            }
            @media (max-width:767px) {
                .category a {
                    font-size: 14px;
                    padding: 4px 16px;
                }
                .blog-card .blog-card-div h1 {
                    font-size: 28px;
                    height: 59px;
                }
            }
            @media (max-width:425px) {
                .search-blogs {
                    width: 100%;
                }
                .blog-card .blog-card-div h1 {
                    font-size: 24px;
                    margin-top: 5px;
                    height: 50px;
                }
                .blog-card .blog-card-div .date-d {
                    margin-top: -8px;
                    margin-right: -8px;
                }
                .blog-card .blog-card-div .cataegory-n {
                    font-size: 14px;
                }
                .blog-card .blog-card-div .cataegory-n svg {
                    margin-right: 5px;
                    width: 18px;
                }
                .blog-card {
                    padding: 5px;
                }
                .blog-card,
                .left-img-blog .blog-card {
                    margin: -40px 10px 10px 10px;
                }
                .blog-card-list {
                    padding-bottom: 20px;
                }
                .blogs-list-header .subText {
                    width: 95%;
                }
            }
            @media (max-width:375px) {
                .blog-card,
                .left-img-blog .blog-card {
                    margin: -30px 10px 10px 10px;
                }
            }
            @media (max-width:320px) {
                .blog-card .blog-card-div {
                    padding: 10px;
                }
                .blog-card .blog-card-div .date-d {
                    margin-top: -5px;
                    margin-right: -5px;
                }
            }
        </style>
<div class="DemoHeader d-flex justify-content-center blogs-list-header">
    <div class="align-self-center">
        <h1 class="wow fadeInUp" data-wow-delay="0.1s"><span>Our </span> Blogs</h1>
        <div class="LSpace m-auto mt-20 wow fadeInUp" data-wow-delay="0.3s"></div>
        <small class="subText wow fadeInUp" data-wow-delay="0.4s">Powerful and intuitive solution to make your
            frontline sales team more productive and effective.</small>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="category demo-x">
                <div class="c-d-w" id="">
                    <a id="" class="active service"  data-value="">All</a>
                    @foreach($services as $service)
                    <a id="" class="service" data-value="{{$service->id}}">{{$service->service_name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="search-blogs">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
                <input type="text" class="form-control dynamic_search" id="dynamic_search" placeholder="Search">
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="all_blogs" placeholder="all_blogs" id="all_blogs" value="{{$all_blogs}}">

<div class="container productList2" id="productList2">
    <div class="col list" id="productItem-list">
    </div>
    <!-- <div class="ProductPageNav text-center">
            <ul class="justify-content-center pagination list-page" data-role="listview">
            </ul>
    </div> -->
    <div class="row">
        <div class="col-12 text-center">
        <ul class="justify-content-center pagination page-item" data-role="listview">
            </ul>
        </div>
    </div>

</div>
</div>

@endsection
@push('js')
<script src="{{mix('js/custom/blogs.js')}}"></script>
@endpush