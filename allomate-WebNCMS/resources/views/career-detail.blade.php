@extends('layouts.cms')
@section('content')
<style>
    .section-position-detail {
        font-size: 16px;
        padding-top: 30px;
        padding-bottom: 30px;
        background-color: #fff;
        border-radius: var(--border-radius);
    }

    .section-position-detail h2 {
        margin-bottom: 0.5rem;
        font-size: var(--heading-04);
    }

    .section-position-detail ul {
        padding: 0;
        margin: 0 0 20px 0;
        list-style: none;
    }

    .section-position-detail li {
        margin-bottom: 8px;
        position: relative;
        padding-left: 35px;
    }

    .section-position-detail li::after {
        content: "";
        display: block;
        width: 18px;
        height: 1px;
        position: absolute;
        top: 12px;
        left: 0;
        background-color: var(--bs-secondary);
    }

    .section-position-detail .position-form-card {
        background-color: #fff;
        border-radius: var(--border-radius);
        padding: 30px;
    }

    .section-position-detail textarea.form-control,
    .section-position-detail textarea.form-control:focus {
        height: 230px !important;
        padding-top: 15px;
        margin-bottom: 5px;
    }

    .section-form-job {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .section-form-job h2 {
        font-size: var(--heading-03);
        text-align: center;
        color: var(--bs-primary);
    }

    .position-form-card {
        width: 65%;
        margin: auto;
    }

    .position-form-card .btn-primary {
        min-width: 150px;
        justify-content: space-between;
    }

    .position-form-card textarea.form-control,
    .position-form-card textarea.form-control:focus {
        height: 230px !important;
        padding-top: 15px;
        margin-bottom: 5px;
        background-color: white !important;
    }
    .position-form-card .form-control,
    .position-form-card .form-control:focus {
        background-color: white !important;
    }

    @media (max-width:991px) {
        .position-form-card {
            width: 85%;
        }
    }

    @media (max-width:767px) {
        .section-position-detail {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .position-form-card {
            width: 100%;
        }

        .section-position-detail,
        .section-position-detail p {
            font-size: 14px;
        }

        .section-position-detail li::after {
            top: 10px;
        }

        .section-position-detail li {
            padding-left: 30px;
        }

        .section-position-detail li::after {
            width: 16px;
        }
    }

    @media (max-width:425px) {
        .position-form-card .btn-primary {
            min-width: 100%;
        }
    }
    .submit-contact-btn{
        color: white!important;
    }
</style>
<section class="light-inner-header">
    <div class="light-header-content">
        <div class="container">
            <ul class="mil-breadcrumbs">
                <li><a href="/">Home</a></li>
                <li><a href="/career">Career</a></li>
            </ul>
            <div class="row">
                <div class="col-12">
                    <h1>{{@$career->title}}</h1>
                    <p>{{@$career->location}}</p>
                    <svg class="arrow-down" xmlns="http://www.w3.org/2000/svg" width="88.237" height="88.237"
                        viewBox="0 0 88.237 88.237">
                        <g id="Group_127" data-name="Group 127" transform="translate(2192.587 -264.18) rotate(135)">
                            <g id="Ellipse_7" data-name="Ellipse 7" transform="translate(1706 1270)" fill="none"
                                stroke="#001e35" stroke-width="2">
                                <circle cx="31.196" cy="31.196" r="31.196" stroke="none" />
                                <circle cx="31.196" cy="31.196" r="30.196" fill="none" />
                            </g>
                            <path id="arrow"
                                d="M13.546,23.927,12.574,23,22.932,12.644H0V11.282H22.981L12.622.924,13.546,0,25.51,11.963Z"
                                transform="translate(1720.076 1302.115) rotate(-45)" fill="#f12300" stroke="#f12300"
                                stroke-width="1" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-position-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $career->description ?? '' !!}
            </div>
        </div>
    </div>
</section>
<section class="section-form-job section-padding-set">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="position-form-card">
                    <h2>Apply for this Job</h2>

                    <div class="row">
                        <form autocomplete="off" id="application-form">
                            @csrf
                            <input type="hidden" name="application_for" id="application_for" value="{{@$career->id}}">
                            <input type="hidden" name="application_title" id="application_title" value="{{@$career->title}}">
                            <input type="hidden" name="formType" id="formType" value="career-form">
                            <div class="col-md-12 form-group">
                                <label for="firstName" class="form-label">First name*</label>
                                <input type="text" class="form-control required-career" id="firstName" name="firstName"
                                    autocomplete="off" placeholder="Enter first name" required>
                                <div class="invalid-feedback firstName-error">Please provide a valid first name.</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="lastName" class="form-label">Last name*</label>
                                <input type="text" class="form-control required-career" id="lastName" name="lastName" autocomplete="off"
                                    placeholder="Enter last name" required>
                                <div class="invalid-feedback lastName-error">Please provide a valid last name.</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="email" class="form-label">Email Address*</label>
                                <input type="email" class="form-control required-career" id="email" name="email" autocomplete="off"
                                    placeholder="example@gmail.com" required>
                                <div class="invalid-feedback email-error">Please provide a valid email address.</div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="phone" class="form-label">Phone number*</label>
                                <input type="tel" class="form-control required-career" id="phone" name="phone" autocomplete="off"
                                    placeholder="Enter phone number">
                                <div class="invalid-feedback phone-error">Please provide a valid phone number.</div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="linkedIn" class="form-label">LinkedIn URL *</label>
                                <input type="tel" class="form-control required-career" name="linkedIn" id="linkedIn" autocomplete="off"
                                    placeholder="Enter LinkedIn URL">
                                <div class="invalid-feedback linkedIn-error">Please provide linkedIn URL.</div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="cv" class="form-label">Upload a recent resume or CV *</label>
                                <div class="form-wrap up_h">
                                    <div class="upload-pic"></div>
                                    <input type="file" id="frontPictureUpload" name="cv" class="dropify" accept="application/pdf"
                                    data-allowed-file-extensions="pdf"
                                    />
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="description" class="form-label">Introduce Yourself *</label>
                                <textarea class="form-control required-career" name="description" id="description" autocomplete="off"
                                    placeholder="Enter message*" required></textarea>
                                <div class="invalid-feedback description-error">Introduce Yourself </div>
                            </div>
                        </form>
                        <div class="col-md-12 form-group pt-2 m-0 text-center">
                            <button type="button" class="btn-primary submit-contact-btn" id="btn-application-form"> Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-home-blogs section-padding-set">
    <div class="container">
        <div class="row pb-2">
            <div class="col heading-with-line-md pt-0">
                <h2><span>Our</span> Latest Articles</h2>
            </div>
            <div class="col-auto pl-0">
                <a href="/blogs" class="btn btn-primary btn-secondary">View All</a>
            </div>
        </div>
        <div class="row g-3">
            @foreach($latest_blogs as $key => $blog)
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <article class="card-our-blogs" itemscope="" itemtype="http://schema.org/BlogPosting">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img width="100" height="100" src="/storage/{{ $blog->image }}"
                            onerror="this.onerror=null;this.src='/images/blog-01.jpg';" alt="Allomate Blog Image"
                            title="{{ $blog->title }}" itemprop="image">
                        <figcaption>
                            <div class="row m-0">
                                <div class="col">
                                    @php
                                    $date = new DateTime($blog->blog_date);
                                    $formattedDate = $date->format('d F Y');
                                    @endphp
                                    <time datetime="{{ $blog->blog_date }}" itemprop="datePublished"><small>{{
                                            $formattedDate
                                            }}</small></time>
                                    <strong itemprop="articleSection">{{ @$service_name??'General' }}</strong>
                                </div>
                                <div class="col-auto pl-0 mt-auto mb-auto">
                                    <a href="/blogs/blog-details/{{ $blog->page_slug }}" class="card-our-blogs-link"
                                        itemprop="url" title="Read Blog">
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
<script>
    var pageTitle = @json($career->title);
  $(document).prop('title', pageTitle);
</script>

<script src="{{asset('js/dropify.min.js')}}"></script>
<script>
    $('#frontPictureUpload').dropify({
        messages: {
            'default': 'Upload/Drag and drop pdf file',
            'replace': 'Upload/Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Oops, something wrong happened.'
        }
    });
</script>
<script src="{{asset('js/custom/forms.js')}}"></script>
@endpush
