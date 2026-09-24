@extends('layouts.cms')
@section('content')
<section class="light-inner-header">
  <div class="light-header-content">
    <div class="container">
      <ul class="mil-breadcrumbs">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="/blogs">Blog</a></li>  
        <li><a class="blog-d-category" href="javascript:void(0);">{{@$service_name != null ? $service_name :
            'General'}}</a></li> 
      </ul>
      <div class="row">
        <div class="col-12">
          <h1>{{@$blog_details->title}}</h1>
          <p>{{@$blog_details->short_description}}</p>
          @php
          $date = new DateTime(@$blog_details->blog_date);
          $formattedDate = $date->format('d F Y');
          @endphp
          <div class="blog-d-date">{{$formattedDate}}</div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="section-blog-details">
  <div class="container">
    <div class="row">
      <div class="col-12">
        {!! $blog_details->blog_details ?? '' !!}

      </div>
    </div>
  </div>
</section>




<section class="section-home-blogs section-padding-set">
  <div class="container">
    <div class="row">
      <div class="col-12 heading-large-paragraph pt-0 pb-4">
        <h2>You may also like If you liked the previous article, you will definitely like these</h2>
      </div>
    </div>
    <div class="row g-3">
      @foreach($all_related_blogs as $key => $blog)
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <article class="card-our-blogs" itemscope="" itemtype="http://schema.org/BlogPosting">
          <figure itemscope="" itemtype="http://schema.org/ImageObject">
            <img width="100" height="100" src="{{ $blog->after_header_image }}"
              onerror="this.onerror=null;this.src='/images/blog-01.jpg';" alt="Allomate Blog Image"
              title="{{ $blog->title }}" itemprop="image">
            <figcaption>
              <div class="row m-0">
                <div class="col">
                  @php
                  $date = new DateTime($blog->blog_date);
                  $formattedDate = $date->format('d F Y');
                  @endphp
                  <time datetime="{{ $blog->blog_date }}" itemprop="datePublished"><small>{{ $formattedDate
                      }}</small></time>
                  <strong itemprop="articleSection">{{ @$service_name??'General' }}</strong>
                </div>
                <div class="col-auto pl-0 mt-auto mb-auto">
                  <a href="/blogs/blog-details/{{ $blog->slug }}" class="card-our-blogs-link" itemprop="url"
                    title="Read Blog">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mil-arrow">
                      <path
                        d="M 14 5.3417969 C 13.744125 5.3417969 13.487969 5.4412187 13.292969 5.6367188 L 13.207031 5.7226562 C 12.816031 6.1136563 12.816031 6.7467188 13.207031 7.1367188 L 17.070312 11 L 4 11 C 3.448 11 3 11.448 3 12 C 3 12.552 3.448 13 4 13 L 17.070312 13 L 13.207031 16.863281 C 12.816031 17.254281 12.816031 17.887344 13.207031 18.277344 L 13.292969 18.363281 C 13.683969 18.754281 14.317031 18.754281 14.707031 18.363281 L 20.363281 12.707031 C 20.754281 12.316031 20.754281 11.682969 20.363281 11.292969 L 14.707031 5.6367188 C 14.511531 5.4412187 14.255875 5.3417969 14 5.3417969 z">
                      </path>
                    </svg>
                  </a>
                </div>
              </div>
            </figcaption>
          </figure>
          <h3 itemprop="headline">{{ $blog->title }}</h3>
          <meta itemprop="author" content="Author Name">
          <meta itemprop="dateModified" content="{{ $blog->updated_at }}">
          <meta itemprop="publisher" content="Publisher Name">
        </article>
      </div>
      @endforeach
    </div>
  </div>
</section>


@endsection
@push('js')
 
@endpush