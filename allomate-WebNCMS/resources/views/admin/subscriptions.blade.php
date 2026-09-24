@extends('layouts.app')
@section('content')
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Subscribe <span>Emails</span></h2>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Subscriptions </span></a></li>
            <li><span>list</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Subscriptions Emails <span>List</span></h2>
            </div>
            <div class="body">
                <table class="table table-hover dt-responsive nowrap email_table" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Email</th>
                            <th>Subscribe At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($data as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> {{$data->email}}</td>
                            <td> {{date('d-M-Y',strtotime($data->created_at))}}</td>
                            <td><a href="javascript:void(0);" id="{{$data->id}} " class="btn btn-default red-bg email_delete" >Delete </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('js/custom/subscription-email.js')}}">
</script>
@endpush
