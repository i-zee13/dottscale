@extends('layouts.cms')
@section('content')
<div class="career d-flex justify-content-center CVacancy">
  <div class="align-self-center text-left subHeadText">
    <div class="container job-page">
      <div class="row">
        <div class="col-lg-12 col-md-12 pt-50">
          <h5 class="SM_HB wow fadeInUp" data-wow-delay="0.1s">Vacancy</h5>
          <h1 class="mb-20 wow fadeInUp" data-wow-delay="0.2s">FIELD TRAINER OFFICER</h1>
          <h4 class="text-center wow fadeInUp" data-wow-delay="0.3s">Lahore, PK.</h4>
          <div class="line-bar mt-30 mb-30 wow fadeInUp"> </div>
          <h2 class="wow fadeInUp">We are looking for someone…</h2>
          <p class="text-left w-100">Who is qualified and experienced in technical training
            Who is Excellent in written communication and documentation skills
            Who has the Experience in the preparation and delivery of applications training, preferably in Sales
            Who has the Ability to design, develop and deliver tailored training techniques
          </p>
          <h2 class="wow fadeInUp">What you'll be doing:</h2>
          <ul>
            <li class="wow fadeInUp">Develop and implement training programs for field staff.</li>
            <li class="wow fadeInUp">Plan and schedule trainings on regular basis.</li>
            <li class="wow fadeInUp">Inform about the training events in advance to field staffs.</li>
            <li class="wow fadeInUp">teaching a series of best practices for our software that significantly increases client organization’s productivity</li>
            <li class="wow fadeInUp">Identifying the training needs, coordinating, and delivering the sales training according to the business needs and ensures that all gaps in knowledge, skills, and competency have been filled out completely to ensure that the training is compliant with the practical techniques that need to be used on field.</li>
            <li class="wow fadeInUp">Evaluate training programs and recommend improvements.</li>
          </ul>

          <h2 class="wow fadeInUp">The Skills you will bring</h2>
          <ul>
            <li class="wow fadeInUp">Proactive and energetic approach</li>
            <li class="wow fadeInUp">Self-motivation and initiative </li>
            <li class="wow fadeInUp">Proactive change management skills </li>
            <li class="wow fadeInUp">Ability to relate to people at all role levels</li>
            <li class="wow fadeInUp">Ability to work autonomously </li>
            <li class="wow fadeInUp">Excellent interpersonal and communication skills </li>
            <li class="wow fadeInUp">Ability to understand the complexities of a large organization </li>
            <li class="wow fadeInUp">Ability to develop and maintain effective relationships in a team </li>
            <li class="wow fadeInUp">Excellent organisational skills</li>
            <li class="wow fadeInUp">Strong customer service ethic</li>
          </ul>

        </div>
        <div class="col-lg-12 col-md-12 pt-50 mt-30">
          <h5 class="SM_HB wow fadeInUp">APPLY</h5>
          <h1 class="wow fadeInUp">FOR THIS POSITION</h1>
          <div class="line-bar mt-20 mb-20 wow fadeInUp"> </div>
          @include('application-form',['application_for' => '4'])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="{{mix('js/custom/forms.js')}}"></script>
@endpush