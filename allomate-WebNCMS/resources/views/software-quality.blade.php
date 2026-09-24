@extends('layouts.cms')
@section('content')
<div class="career d-flex justify-content-center CVacancy">
  <div class="align-self-center text-left subHeadText">
    <div class="container job-page">
      <div class="row">
        <div class="col-lg-12 col-md-12 pt-50">
          <h5 class="SM_HB wow fadeInUp" data-wow-delay="0.1s">Vacancy</h5>
          <h1 class="mb-20 wow fadeInUp" data-wow-delay="0.2s">SOFTWARE QUALITY ASSURANCE</h1>
          <h4 class="text-center wow fadeInUp" data-wow-delay="0.3s">Lahore, PK.</h4>
          <div class="line-bar mt-30 mb-30 wow fadeInUp"> </div>
          <h2 class="wow fadeInUp">We are looking for someone…</h2>
          <p class="text-left w-100">The one who has ample amount of knowledge in the Process of Bug Tracking, Ticketing, and Testing.
            Who has Technical Knowledge Regarding Software Engineering
            You must have Analytical, Logical Thinking Along With Creativity
            You need to be pro in reading computer coding languages to identify potential problems and find ways to streamline software
          </p>
          <h2 class="wow fadeInUp">What you'll be doing:</h2>
          <ul>
            <li class="wow fadeInUp">Review requirements, specifications and technical design documents to provide timely and meaningful feedback</li>
            <li class="wow fadeInUp">Create detailed, comprehensive and well-structured test plans and test cases
            <li class="wow fadeInUp">Estimate, prioritize, plan and coordinate testing activities</li>
            <li class="wow fadeInUp">Design, develop and execute automation scripts using open source tools</li>
            <li class="wow fadeInUp">Identify, record, document thoroughly and track bugs</li>
            <li class="wow fadeInUp">Perform thorough regression testing when bugs are resolved</li>
            <li class="wow fadeInUp">Develop and apply testing processes for new and existing products to meet client needs</li>
            <li class="wow fadeInUp">Liaise with internal teams (e.g. developers and product managers) to identify system requirements</li>
            <li class="wow fadeInUp">Monitor debugging process results</li>
            <li class="wow fadeInUp">Investigate the causes of non-conforming software and train users to implement solutions</li>
            <li class="wow fadeInUp">Track quality assurance metrics, like defect densities and open defect counts</li>
            <li class="wow fadeInUp">Stay up-to-date with new testing tools and test strategies</li>

          </ul>

          <h2 class="wow fadeInUp">The Skills you will bring</h2>
          <ul>
            <li class="wow fadeInUp">Technical Knowledge</li>
            <li class="wow fadeInUp">Thoroughness and Communication skills</li>
            <li class="wow fadeInUp">Planning and Project Management</li>
            <li class="wow fadeInUp">Risk Assessment</li>
            <li class="wow fadeInUp">Analysis and Resource Management</li>
            <li class="wow fadeInUp">Product Testing</li>
            <li class="wow fadeInUp">Writing</li>
            <li class="wow fadeInUp">Scheduling</li>
            <li class="wow fadeInUp">Computer Literacy</li>
            <li class="wow fadeInUp">Troubleshooting and Compliance</li>
          </ul>

        </div>
        <div class="col-lg-12 col-md-12 pt-50 mt-30">
          <h5 class="SM_HB wow fadeInUp">APPLY</h5>
          <h1 class="wow fadeInUp">FOR THIS POSITION</h1>
          <div class="line-bar mt-20 mb-20 wow fadeInUp"> </div>
          @include('application-form',['application_for' => '3'])
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('js')
<script src="{{mix('js/custom/forms.js')}}"></script>
@endpush