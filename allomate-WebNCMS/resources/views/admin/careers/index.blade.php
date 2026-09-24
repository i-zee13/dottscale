@extends('layouts.app')
@section('content')
<style>

.fa.active-st {
        color: #06C420;
        font-size: 10px;
        margin-top: 0;
    }
    .fa.inactive-st {
        color: #8e8e8e;
        font-size: 10px;
        margin-top: 0;
    }
</style>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Jobs <span> Managment</span></h2>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Jobs</span></a></li>
            <li><span>list</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="header">
                <a href="{{route('admin.create-career')}}" class="btn add_button "><i class="fa fa-plus"></i> <span>Add
                        Jobs</span></a>
                <h2>Jobs <span>List</span></h2>

            </div>
            <div style="min-height: 400px" id="tblLoader">
                <img src="/images/loader.gif" width="30px" height="auto"
                    style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body" style="display: none">
                <table class="table table-hover dt-responsive nowrap email_table" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($careers as $key=>$career)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> {{$career->title}}</td>
                            <td class="change-status" data-id="{{$career->id}}" data-value="{{$career->status}}" style="cursor:pointer"><i class="fa fa-circle {{$career->status == 1 ? 'active-st' : 'inactive-st'}}"></i> {{$career->status == 1 ? 'Active' : 'In-Active'}}</td>
                            <td>
                                <a href="{{route('admin.edit-career',$career->id)}}"   class="btn btn-default" >Edit </a>
                                <a href="javascript:void(0);" id="{{@$career->id}} " class="btn btn-default red-bg career_delete" >Delete </a>
                            </td>
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
<script src="{{asset('js/custom/careers.js')}}">
  </script>
@endpush
