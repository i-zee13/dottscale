@extends('layouts.cms')

@section('content')

<div class="contactPage d-flex justify-content-center ">
	<div class="align-self-center text-left subHeadText">



		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<h2 class="title_text wow fadeInUp" data-wow-delay="0.1s">Contact</h2>
					<h1 class="title_large wow fadeInUp" data-wow-delay="0.2s">Let's <span>Get in Touch!</span></h1>

					<p class="text-sub wow fadeInUp" data-wow-delay="0.3s">We’ve talked the talk,<br>Time to walk the walk!
						<br>Hit us up! We promise our solutions are better than our rhymes.
					</p>

				</div>


				<div class="col-lg-6 col-md-12">
					<form id="contact-form">
						@csrf
					<div class="contact-form">
						<div class="row">
							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.4s">
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control required only_alphabets" placeholder="Name *">
								</div>
							</div>

							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.5s">
								<div class="form-group">
									<input type="text" name="email" id="email" class="form-control required" placeholder="Email *">
								</div>
							</div>

							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
								<div class="form-group">
									<input type="text" name="phone" id="Phone" class="form-control required only_numerics" placeholder="Phone *">
								</div>
							</div>
							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.7s">
								<div class="form-group">
									<input type="text" name="subject" id="Subject" class="form-control required" placeholder="Subject *">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.8s">
								<textarea class="form-control" name="message" id="message" rows="5" placeholder="Message *"></textarea>

							</div>

							<div class="col-md-12 wow fadeInUp" data-wow-delay="0.9s">
								<button type="button" class="send-btn" id="btn-contact-form" >SEND</button>
							</div>

						</div>
					</div>
					</form>
				</div>


				<div class="col-lg-6 col-md-12">
					<div class="offices">
						<div class="offc-info">

							<h4 class="wow fadeInUp" data-wow-delay="1s">Lahore, PK</h4>
							<p class="mb-30 wow fadeInUp" data-wow-delay="1.1s">Address: Plot# 875, Khayaban-e-Firdousi,<br>Block R-1</p>

							<h4 class="wow fadeInUp" data-wow-delay="1.2s">RAWALPINDI, PK</h4>
							<p class="wow fadeInUp" data-wow-delay="1.3s">Office#7B, 3rd Floor. Gulshan Plaza,<br>Sixth Road</p>
						</div>

						<div class="offc-info PS">
							<p class="phone wow fadeInUp" data-wow-delay="1.4s">+92 318 1664007<br>+92 345 8224007</p>
							<a class="wow fadeInUp" data-wow-delay="1.5s" href="mailto:connect@sell360.app">connect@sell360.app</a>
						</div>
						<a class="join-btn wow fadeInUp" data-wow-delay="1.6s" href="{{route('career')}}">Join Our Team</a>

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