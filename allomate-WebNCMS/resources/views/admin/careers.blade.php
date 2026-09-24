@extends('layouts.app')
@section('content')
<style>
  .pt-7 {
    padding-top: 7px !important
  }

  .mb-4 {
    margin-bottom: 4px !important
  }

  .font11 {
    font-size: 11px !important
  }

  .headingDB {
    padding: 15px 20px !important;
    margin-left: -5px
  }

  .tablelist {
    font-size: 12px;
  }

  .tablelist th {
    background-color: #f6f6f6;
    font-size: 13px;
  }

  .tablelist th,
  .tablelist td {
    padding: 5px;
  }

  .tablelist td {
    border-bottom: solid 1px #f0f0f0
  }

  .addcareer {
    width: 100%;
    border-radius: 0;
    letter-spacing: 1px;
    line-height: 1;
  }

  .addcareer:hover,
  .addcareer:focus {
    background: linear-gradient(90deg, #2f4a70 0%, #2f4a70 100%);
    color: #fff
  }

  .subheading {
    font-size: 16px;
    padding-bottom: 5px;
    margin-bottom: 5px;
    margin-top: 15px;
    border-bottom: solid 1px #e7e7e7
  }

  .closebtn {
    padding: 10px;
    outline: none;
    font-size: 30px;
    float: right;
    margin-top: -5px;
  }

  .closebtn:focus {
    outline: none !important
  }
</style>
{{ $errors->first('fb_link') }}
<div id="product-cl-sec">
  <a href="javascript:void(0);" id="pl-close" class="close-btn-pl"></a>
  <div class="pro-header-text">New <span>Career</span></div>
  <div class="pc-cartlist">
    <div class="overflow-plist">
      <div class="plist-content">
        <div class="_left-filter">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div id="floating-label" class="card p-20 top_border mb-3">
                  <h2 class="_head03">Career <span>Detail</span></h2>
                  <div class="form-wrap p-0">
                    <input type="hidden" id="hidden_career_country" name="hidden_country_id">
                    <input type="hidden" id="hidden_career_state" name="hidden_state_id">
                    <input type="hidden" id="hidden_career_city" name="hidden_city_id">
                    <form id="career_form">
                      @csrf
                      <input type="hidden" value="" name="career_id" id="career_id">

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label mb-10">Title *</label>
                            <input type="text" id="" class="form-control required_field" placeholder="" name="title">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label mb-10">Phone No *</label>
                            <input type="text" id="phone_no" class="form-control required_field" placeholder="" name="phone_no">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label mb-10">Email *</label>
                            <input type="text" id="career_email" class="form-control required_field" placeholder="" name="career_email">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label mb-10">Address *</label>
                            <input type="text" id="" class="form-control required_field" placeholder="" name="career_address">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label mb-10">Latitude *</label>
                            <input type="text" id="latitude" class="form-control required_field" placeholder="" name="latitude">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label mb-10">Longitude *</label>
                            <input type="text" id="longitude" class="form-control required_field" placeholder="" name="longitude">
                          </div>
                        </div>
                        <div class="col-md-6 mb-10">
                          <div class="form-s2">
                            <label class="font11 mb-0">Country *</label>
                            <select class="form-control countries_2 required_field formselect " placeholder="Select Residency Status" id="countries_2" name="country_id">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-6 mb-10">
                          <div class="form-s2">
                            <label class="font11 mb-0">State/Province *</label>

                            <select class="form-control formselect states required_field" placeholder="Select Province/State" id="states_2" name="state_id">

                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 mb-10">
                          <label class="font11 mb-0">City *</label>
                          <div class="form-s2">
                            <select class="form-control formselect cities required_field " placeholder="" id="cities_2" name="career_city_id">

                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pt-7">
                          <div class="form-group">
                            <label class="control-label mb-10">Postal Code *</label>
                            <input type="text" id="" class="form-control required_field" placeholder="" placeholder="" maxlength="6" minlength="6" name="career_postal_code_id">
                          </div>
                        </div>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="_cl-bottom">
    <button type="submit" class="btn btn-primary mr-2" id="savecareerBtn">Save</button>
    <button id="pl-close" type="submit" class="btn btn-cancel mr-2">Cancel</button>
  </div>
</div>
<div id="blureEffct" class="container-fluid">
  <div class="overlay-blure"></div>
  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <button type="button" id="productlist01" class="btn add_button openSideBarForAddingcareer"><i class="fa fa-plus"></i> <span>Add
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
</div>
@endsection
@push('js')
<script src="{{asset('js/custom/applications.js')}}">
</script>

@endpush