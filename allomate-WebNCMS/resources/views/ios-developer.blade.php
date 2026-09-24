@extends('layouts.cms')
@section('content')
<div class="career d-flex justify-content-center CVacancy">
	<div class="align-self-center text-left subHeadText">



		<div class="container job-page">
			<div class="row">

				<div class="col-lg-12 col-md-12 pt-50">
					<h5 class="SM_HB wow fadeInUp" data-wow-delay="0.1s">Vacancy</h5>
					<h1 class="mb-20 wow fadeInUp" data-wow-delay="0.2s">iOS DEVELOPER</h1>
					<h4 class="text-center wow fadeInUp" data-wow-delay="0.3s">Islamabad, PK.</h4>
					<div class="line-bar mt-30 mb-30 wow fadeInUp"> </div>

					<h2 class="wow fadeInUp">We are looking for someone…</h2>

					<ul>
						<li class="wow fadeInUp">Who will be responsible for the development of iOS applications and their integration with back-end services.</li>
						<li class="wow fadeInUp">Who can work alongside other engineers and developers working on different layers of the infrastructure.</li>
						<li class="wow fadeInUp">Who can commit to collaborative problem solving, sophisticated design, and the creation of quality products.</li>
					</ul>

					<h2 class="wow fadeInUp">What you'll be doing:</h2>

					<ul>
						<li class="wow fadeInUp">Designing and building applications for the iOS platform</li>
						<li class="wow fadeInUp">Ensuring the performance, quality, and responsiveness of applications</li>
						<li class="wow fadeInUp">Collaborating with a team to define, design, and ship new features</li>
						<li class="wow fadeInUp">Identifying and correcting bottlenecks and fixing bugs</li>
						<li class="wow fadeInUp">Help maintaining code quality, organization, and automatization</li>
					</ul>



					<h2 class="wow fadeInUp">The skills you will bring ...</h2>
					<ul>
						<li class="wow fadeInUp">SQLite a must</li>
						<li class="wow fadeInUp">Proficient with Swift 4.0, Cocoa Touch and Json</li>
						<li class="wow fadeInUp">Experience with iOS frameworks such as Core Data</li>
						<li class="wow fadeInUp">Xamarin – mobile platform development experience a plus</li>
						<li class="wow fadeInUp">Experience with offline storage, threading, and performance tuning</li>
						<li class="wow fadeInUp">Familiarity with RESTful APIs to connect iOS applications to back-end services</li>
						<li class="wow fadeInUp">Understanding of Apple’s design principles and interface guidelines</li>
						<li class="wow fadeInUp">Knowledge of low-level C-based libraries is preferred</li>
						<li class="wow fadeInUp">GitHub</li>
						<li class="wow fadeInUp">XML</li>
					</ul>


					<h2 class="wow fadeInUp">You must posses..</h2>
					<ul>
						<li class="wow fadeInUp">Ability to work in an Agile environment through development, testing and delivery.</li>
						<li class="wow fadeInUp">Attention to detail & quality.</li>
						<li class="wow fadeInUp">Ability to organize and prioritize multiple tasks.</li>
						<li class="wow fadeInUp">Ability to collaborate with both co-workers and customers in a demanding environment.</li>
						<li class="wow fadeInUp">Ability to solve problems and think critically in order to develop creative solutions.</li>
						<li class="wow fadeInUp">Team player that fosters a highly collaborative, flexible, supportive, and open environment.</li>
						<li class="wow fadeInUp">Analytical skills to efficiently comprehend requirements and make recommendations for process improvements.</li>

						<h2 class="wow fadeInUp">You must have…</h2>
						<li class="wow fadeInUp">Bachelor’s Degree - Preferably in Computer Science with a focus on software development.</li>
						<li class="wow fadeInUp">3 years’ experience with Swift and iOS</li>

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