@extends('layouts.cms')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.css">

<style>
    .light-inner-banner {
        background-color: var(--bs-body-bg);
        color: var(--bs-primary);
    }
    .light-inner-banner h1 {
        font-size: var(--heading-01);
        margin-bottom: 40px;
    }
    .light-inner-banner h1 span {
        font-weight: 100;
    }
    .light-inner-banner .light-banner-content {
        padding: 120px 0 50px 0;
    }
    .light-inner-banner .light-banner-content p {
        font-size: 18px;
        opacity: 0.7;
        margin-bottom: 0;
    }
    @media (max-width:1440px) {
        .light-inner-banner .light-banner-content p {
            font-size: 16px;
        }
    }
    @media (max-width:767px) {
        .light-inner-banner .light-banner-content {
            padding: 70px 0 40px 0;
        }
        .light-inner-banner .light-banner-content p {
            font-size: 15px;
        }
        .light-inner-banner h1 {
            margin-bottom: 0;
        }
    }
    @media (max-width:425px) {
        .light-inner-banner .light-banner-content {
            padding: 70px 0 30px 0;
        }
    }
</style>
<section class="light-inner-banner">
    <div class="light-banner-content">
        <div class="mil-banner-content">
            <div class="container">
                <ul class="mil-breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><a href="/blogs">Blog</a></li>
                </ul>
                <h1>Exploring <span class="mil-thin">the World</span> <br> Through Our <span
                        class="mil-thin">Blog</span></h1>
                <!-- <p>Broad Skill Set, Proven Impact Broad Skill Set, Proven Impact</p> -->
            </div>
        </div>
    </div>
</section>
<div class="container ">
    <div class="row blogs-filter">

    </div>
</div>
<!-- section-home-blogs  -->
<section class="section-blog-list main-blogs">

</section>
<section class="mil-soft-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <span class="mil-suptitle">Looking to make
                    your mark? We'll help you turn <span>your project into a success story.</span></span>
            </div>
        </div>
        <div class="text-center">
            <h2>Let’s make an <span class="mil-thin">impact</span><br>
                together. Ready <span class="mil-thin">when you are</span></h2>
            <div>
                <a href="/contact-us" class="btn-primary">
                    <span>Contact Us</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                        <path
                            d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
<script>
    var blogs = @json($blogs);
        document.addEventListener('DOMContentLoaded', function() {
            if(blogs && blogs.length > 0) {
                    initializeList(blogs);
            }else{
                renderNoBlogsDiv();
            }
         });
    $(document).ready(function() {
        $('input[name="blogCheck"]').on('change', function() {
            console.log(blogs);
            var checkedId = $(this).attr('data-no');
            var relatedBlogs = [];
            console.log('Checked radio button id:', checkedId);
            if (checkedId == '0000') {
                relatedBlogs = blogs;
            } else if (checkedId == '0001') {
                relatedBlogs = blogs.filter(blog => blog.blog_type == 1);
            } else {
                relatedBlogs = blogs.filter(blog => blog.blog_category_id == checkedId);
                console.log(relatedBlogs);
            }
            if (relatedBlogs && relatedBlogs.length > 0) {
                initializeList(relatedBlogs);
            }
             else {
                renderNoBlogsDiv();
            }
        });
    });
    function renderNoBlogsDiv() {
        $('.list').empty();
        $(".pagination").empty();
        $('#blog-list').append(`
            <div class="row list ">
                <div class="col-md-12">
                    <div class="blog-placeholder">Currently, there are no blogs available in this category.</div>
                </div>
            </div>
        `);
    }
    function initializeList(blogs) {
        $('.list').empty();
        console.log(blogs);
        var options = {
            page: 9,
            pagination: true,
            blog: ['blog_date', 'image', 'service_name', 'slug', 'title', 'updated_at'],
            item: function (blog) {
                console.log(blog);
                const formattedDate = new Date(blog.blog_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });
                return `<div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <article class="card-our-blogs" itemscope itemtype="http://schema.org/BlogPosting">
                            <figure itemscope itemtype="http://schema.org/ImageObject">
                                <img width="100" height="100" src="/storage/${blog.image}" onerror="this.onerror=null;this.src='/images/blog-01.jpg';" alt="Allomate Blog Image" title="${blog.title}" itemprop="image">
                                <figcaption>
                                    <div class="row m-0">
                                        <div class="col">
                                            <time datetime="${blog.blog_date}" itemprop="datePublished"><small>${formattedDate}</small></time>
                                            <strong itemprop="articleSection">${blog.service_name ?? 'General'}</strong>
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
        console.clear()
        console.log(options,blogs)
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
</script>
@endpush
