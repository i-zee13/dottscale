@extends('layouts.cms')
@section('content')
<section class="light-inner-header">
  <div class="light-header-content">
    <div class="container">
      <ul class="mil-breadcrumbs">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="javascript:void(0);">Privacy Policy</a></li>
      </ul>
      <div class="row">
        <div class="col-12">
          <h1>Privacy Policy</h1>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-blog-details">
  <div class="container">
    <div class="row">
      <div class="col-12 ck-editor-heading">
        {!! @$privacy ?? '' !!}
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')

@endpush