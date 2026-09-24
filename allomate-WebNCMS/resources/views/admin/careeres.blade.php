@extends('layouts.app')
@section('content')
<div class="modal fade preview" id="ViewDocumentImg" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content top_border">
      <div class="modal-header">
        <h5 class="modal-title" id="DetailModalLabel">Document <span> Preview</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

        </div>
      </div>
      <div class="modal-footer border-0 p-10">
        <a href="" class="btn btn-primary btn_modal_download" download>Download</a>
        <button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Careers <span>Mangement</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Careers </span></a></li>
                <li><span>List</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <button type="button" class="btn add_button add_carrer"><i class="fa fa-plus"></i> <span>Add
                            Career</span></button>  
                    <h2>Careers <span>List</span></h2>
                </div>
                <div style="min-height: 400px" class="loader">
                    <img src="images/loading.gif" width="30px" height="auto"
                        style="position: absolute; left: 50%; top: 45%;">
                </div>
                <div class="body applications_list">

                </div>
            </div>
        </div>
    </div>
   
@endsection
@push('js')
    <script src="{{ mix('js/custom/career_application.js') }}"></script>
@endpush
