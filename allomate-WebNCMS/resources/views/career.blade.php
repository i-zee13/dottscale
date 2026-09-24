@extends('layouts.cms')
@section('content')
<div class="career d-flex justify-content-center ">
	<div class="align-self-center text-left subHeadText w-100">

		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="text-center">
						<div class="mobsm">
							<h1 class="wow fadeInUp" data-wow-delay="0.1s">At <span>Sell 360</span></h1>
							<p class="wow fadeInUp" data-wow-delay="0.2s">the world’s most talented engineers, designers, and thought leaders are shaping the future of online publishing. </p>
							<div class="LSpace m-auto mt-20 wow fadeInUp" data-wow-delay="0.3s"></div>
							<h2 class="wow fadeInUp" data-wow-delay="0.4s">Open Positions</h2>
						</div>

						@if(count($careers) > 0)
						<div class="row">
							@foreach($careers as $key=>$career)
							<div class="col-lg-3 col-md-6 col-6 wow fadeInUp" data-wow-delay="0.5s">
								<a href="{{route('career-detail',$career->slug)}}" class="post-list">
									<span class="BigNo">{{$key+1}}</span>
									<h4>{{$career->title}}</h4>
									<div class="LSpace"></div>
									{{$career->location}}
								</a>
							</div>
							@endforeach 
						</div>
						@else
						<p style="color:black;text-align:center">No Career available yet</p>
						@endif

					</div>


				</div>

			</div>

		</div>



	</div>



</div>
@endsection