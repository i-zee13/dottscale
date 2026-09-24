@extends('layouts.cms')
@section('content')
<section class="light-inner-header">
  <div class="light-header-content">
    <div class="container">
      <ul class="mil-breadcrumbs">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="javascript:void(0);">Terms of use</a></li>
      </ul>
      <div class="row">
        <div class="col-12">
          <h1>Terms of Use</h1>
        </div>
      </div>
    </div>
  </div>
</section>


 
<section class="section-blog-details">  
  <div class="container">
    <div class="row">
      <div class="col-12 ck-editor-heading">
        {!! @$terms_of_use ?? '' !!}
      </div>
    </div>
  </div>
</section>
  
@endsection
@push('js')

@endpush