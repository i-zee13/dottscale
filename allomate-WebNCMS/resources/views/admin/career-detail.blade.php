@extends('layouts.Frontend.app')
@section('content')
<section class="section job-page js-section padding-set" data-section="help-section" data-name="help-section">
    <div class="container white_hide">

        <div class="row">

            <div class="col-lg-12 col-md-12 p-t-50">
                <h5 class="SM_HB uppercases wow fadeInUp" data-wow-delay="0.2s">Vacancy</h5>
                <h1 class="m-b-30 uppercases wow fadeInUp" data-wow-delay="0.4s">{{$career->title}}</h1>
                <h4 class="text-center wow fadeInUp" data-wow-delay="0.6s">{{$career->location}}</h4>
                <div class="line-bar m-t-30 m-b-30 wow fadeInUp" data-wow-delay="0.8s"> </div>

                <div class="wow fadeInUp" data-wow-delay="1s">
                    {!! $career->description !!}
                </div>
            </div>

            <div class="col-lg-12 col-md-12 mt-30" style="padding-top: 50px;">
                <h5 class="SM_HB wow fadeInUp">APPLY</h5>
                <h1 class="wow fadeInUp">FOR THIS POSITION</h1>
                <div class="line-bar mt-20 mb-20 wow fadeInUp"> </div>
                @include('application-form', ['application_for' => $career->id]) 
            </div>

        </div>


    </div>
</section>
@endsection
@push('js')
<script src="{{mix('js/custom/forms.js')}}"></script>
@endpush