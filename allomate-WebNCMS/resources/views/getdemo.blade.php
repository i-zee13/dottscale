@extends('layouts.cms')
@section('content')

<div class="DemoHeader d-flex justify-content-center">
  <div class="align-self-center">
    <h1 class="wow fadeInUp" data-wow-delay="0.1s"><span>Schedule</span> a Demo</h1>
    <h2 class="wow fadeInUp" data-wow-delay="0.2s">of our Sales Application</h2>
    <div class="LSpace m-auto mt-20 wow fadeInUp" data-wow-delay="0.3s"></div>
    <small class="subText wow fadeInUp" data-wow-delay="0.4s">Try it before you buy it! Fill out this form for a free demo.</small>
  </div>
</div>

<div class="section-DF">
  <div class="container">
    <div class="row">


      <div class="col-lg-6 col-md-12 order-lg-1 order-2 DemoRight">

        <h2 class="wow fadeInUp" data-wow-delay="0.5s">Why Allomate Solutions</h2>
        <p class="topText wow fadeInUp" data-wow-delay="0.6s">Save your time by managing all your sales and marketing activities at ease with Allomate Solutions. Switch to Smart Sales and see your revenue reach higher numbers.</p>

        <ul>
          <li class="wow fadeInUp" data-wow-delay="0.7s">Smart Suggestion Tools</li>
          <li class="wow fadeInUp" data-wow-delay="0.8s">Advanced AI-Powered Features</li>
          <li class="wow fadeInUp" data-wow-delay="0.9s">Generate Reports in no time</li>
          <li class="wow fadeInUp" data-wow-delay="1s">Real-time updates on Sales Activities</li>
          <li class="wow fadeInUp" data-wow-delay="1.1s">Easy to Plan. Easy to Execute. Easy to Use</li>
          <li class="wow fadeInUp" data-wow-delay="1.2s">Meets the Needs of any Industries</li>
          <li class="wow fadeInUp" data-wow-delay="1.3s">Easy to Plan. Easy to Execute. Easy to Use</li>
          <li class="wow fadeInUp" data-wow-delay="1.4s">Meets the Needs of any Industries</li>
        </ul>
      </div>

      <div class="col-lg-6 col-md-12 order-lg-2 order-1">
        <div class="contact-form DemoForm">
          <form id="demo-form">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <h3 class="wow fadeInUp" data-wow-delay="0.6s">I need a demo right now</h3>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="0.7s">
                <div class="form-group">
                  <input type="text" name="name" id="name" class="form-control only_alphabets" placeholder="Name" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="0.8s">
                <div class="form-group">
                  <input type="text" name="phone" id="Phone" class="form-control required only_numerics" placeholder="Phone *" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="0.9s">
                <div class="form-group">
                  <input type="text" name="email" id="email" class="form-control required" placeholder="Email *" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1s">
                <div class="form-group">
                  <input type="text" name="company_name" id="CompanyName" class="form-control required" placeholder="Company Name *" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1.1s">
                <div class="form-group">
                  <input type="text" name="industry" id="Industry" class="form-control required" placeholder="Industry *" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1.2s">
                <div class="form-group">
                  <input type="text" name="sales_personnel" id="SalesNo" class="form-control required" placeholder="No. of on-field sales personnel *" style="font-size: 13px">
                </div>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1.3s">
                <div class="form-group">
                  <input type="text" name="city" id="City" class="form-control required" placeholder="City *" style="font-size: 13px">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1.4s">
                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" style="font-size: 13px"></textarea>
              </div>
              <div class="col-md-12 wow fadeInUp" data-wow-delay="1.5s">
                <button type="button" class="send-btn" id="btn-demo-form">BOOK A FREE DEMO</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="Co_logos wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4>TRUSTED BY</h4>
        <div class="row">
          <div class="col-12">
            <div class="owl-carousel owl-theme">
              <div class="item"><img alt="" src="{{asset('images/danpak.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/skincare.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/spencer.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/finewater.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/orichem.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/printek.png')}}"></div>
              <div class="item"><img alt="" src="{{asset('images/mtek.png')}}"></div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="{{mix('js/custom/forms.js')}}"></script>
@endpush
