@extends('layouts.app')
@section('content')
<style>
    .cnicCardimg {
        width: 500px;
        height: auto;
        display: block;
        margin: 15px auto;
    }
</style>
<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content top-border" style="border-radius: 0;border-top: solid 3px #01213b;">

            <div class="modal-header statusMH">
                <h5 class="modal-title" id="exampleModalLabel">Message : <span class="modal_lead_name"> </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-20">
                <div class="row">
                    <div class="col-12 font14">
                        <p class="massege mb-0"></p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-cancel" data-dismiss="modal" aria-label="Close">Close</button>
            </div>

        </div>
    </div>
    <button hidden data-toggle="modal" data-target="#message" id="hidden_btn_to_open_modal_for_message"></button>
</div>
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
  <button hidden data-toggle="modal" data-target="#ViewDocumentImg" id="hidden_btn_to_open_modal_for_preview"></button>

</div>
    <div class="row mt-2 mb-3">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">Applications <span>Mangement</span></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);"><span>Applications </span></a></li>
                <li><span>List</span></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    {{-- <button type="button" class="btn add_button add_faqs"><i class="fa fa-plus"></i> <span>Add
                            FAQ</span></button> --}}
                    <h2>Applications <span>List</span></h2>
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
    <script src="{{ asset('js/custom/applications.js') }}"></script>
@endpush
