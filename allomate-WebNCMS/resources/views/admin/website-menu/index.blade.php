@extends('layouts.app')
@section('content')
<style>
    .badge .indicator {
        width: 5px;
        height: 5px;
    }

    .indicator {
        display: inline-block;
        margin-right: 0.5em;
        border-radius: 50%;
        background-color: currentColor;
    }

    .badge {
        background-color: transparent;
    }

    .badge-soft-pending {
        color: #040725;
        border: 1px solid #040725;
    }

    .badge-soft-progress {
        color: #e8b00b;
        border: 1px solid #e8b00b;
    }

    .badge-soft-completed {
        color: green;
        border: 1px solid green;
    }

    .dataTable .badge:hover {
        background-color: transparent;
    }

    .dataTable .badge {
        font-size: 11px;
        font-weight: 400;
        border-radius: 3px;
        padding: 4px 7px;
        position: relative;
        right: auto !important;
        top: auto !important;
        width: 85px !important;
        text-align: left !important;
        height: auto;
        font-family: 'Barlow Semi Condensed', sans-serif !important;
        letter-spacing: 1px;
        font-weight: 500;
        border-radius: 0px !important;
    }
</style>
<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Website Menu <span>List</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="#"><span>Website Menu </span></a></li>
            <li><span>Add</span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <a href="{{route('admin.create-menu')}}" class="btn add_button add_faqs"><i class="fa fa-plus"></i> <span>Add
                        Menu</span></a>
                <h2>Website Menu <span>List</span></h2>
            </div>
            <div style="min-height: 400px" class="loader">
                <img src="/images/loader.gif" width="30px" height="auto" style="position: absolute; left: 50%; top: 45%;">
            </div>
            <div class="body d-none">
                <table class="table table-hover dt-responsive nowrap brands-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $key => $menu)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$menu->header_type_name}}</td>
                            <td>{{$menu->top_header_name}}</td>
                            <td>{{ Str::limit($menu->top_header_slug, 30)  ?? 'N/A'}}</td>
                            <td><span class="badge {{ $menu->status ==0 ? 'badge-soft-pending' : 'badge-soft-completed'}} "> <span class="indicator"></span>{{ $menu->status ==0 ? 'In Active' : 'Active'}}</span></td>
                            <td>
                                <a class=" btn btn-default btn-line confirm_delete" data-btn="status" id="{{$menu->id}}" data-status="{{$menu->status}}">{{$menu->status == 0 ? 'Active' : 'in Active'}}</a>
                                <a href="{{route('admin.create-menu',[$menu->id])}}" class=" btn btn-default btn-line">Edit</a>
                                <button data-id="{{$menu->id}}" class="btn btn-default red-bg delete-menu">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteHomeSection" tabindex="-1" role="dialog" aria-labelledby="deleteHomeSectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content top-borderRed">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteHomeSectionLabel">Delete <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <input type="hidden" id="promotion-delete-id">
                    <p>Do you want to delete this Menu?</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary confirm_delete" data-btn="delete">Yes</button>
                <button type="button" class="btn btn-cancel cancel_delete_modal" data-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
    <button hidden data-toggle="modal" data-target="#deleteHomeSection" id="hidden_btn_to_open_section_modal"></button>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('.brands-table').DataTable();
        $('.loader').hide();
        $('.tbl-list-div').fadeIn();
        $('.body').removeClass('d-none');
    })
    $(document).on('click', '.delete-menu', function() {
        $('#hidden_btn_to_open_section_modal').click();
        var id = $(this).attr('data-id');
        $('.confirm_delete').attr('id', id);
        deleteRef = $(this);
    });
    $(document).on('click', '.confirm_delete', function() {
        var id = $(this).attr('id');
        var btn_Status = $(this).attr('data-btn');
        var current_status = $(this).attr('data-status');
        if (btn_Status == 'status') {
            var url = "/admin/update-menu-status";
        } else {
            var url = "/admin/delete-menu";
        }
        var CurrentRef = $(this);
        CurrentRef.attr('disabled', 'disabled');
        CurrentRef.text('Processing...');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                id: id,
                status: current_status ? current_status : ''
            },
            success: function(e) {
                CurrentRef.attr('disabled', false);
                CurrentRef.text(e.text ?? 'Yes');
                if (e.status == "success") {
                    $('#notifDiv').fadeIn().css('background', 'green').text(e.msg);
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                        $('.cancel_delete_modal').click();
                        window.location = "/admin/site-menu";
                    }, 1500);
                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Unable to delete at the moment!');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                }
            }
        })
    });
</script>
@endpush