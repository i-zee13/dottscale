@extends('layouts.cms')
@section('content')
    
<div class="row mt-2 mb-3">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <h2 class="_head01">About <span> Us Management</span></h2>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <ol class="breadcrumb">
              <li><a href="javascript:void(0);"><span>Add </span></a></li>
              <li><span>Content </span></li>
            </ol>
          </div>
        </div>

        <div class="row">
          

          <div class="col-12 mb-30">
            <div class="card">
              <div class="header">
                <h2>Add <span>Header Content</span></h2>
              </div>

              <div class="body">

                <div id="floating-label">
                  <div class="form-wrap p-0">

                    <div class="row">

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Heading 1</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Heading 2</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-wrap p-0">
                          <label class="font13 mb-5">Add Desktop Image (1920px X 800px)</label>
                          <div class="upload-pic"></div>
                          <input type="file" id="input-file-now" class="dropify" />
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-wrap p-0">
                          <label class="font13 mb-5">Add Tab Image (1024px X 428px)</label>
                          <div class="upload-pic"></div>
                          <input type="file" id="input-file-now" class="dropify" />
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-wrap p-0">
                          <label class="font13 mb-5">Add Mobile Image (480px X 853px)</label>
                          <div class="upload-pic"></div>
                          <input type="file" id="input-file-now" class="dropify" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="col-12 mb-30">
            <div class="card">
              <div class="header">
                <h2>Section <span>2</span></h2>
              </div>

              <div class="body">

                <div id="floating-label">
                  <div class="form-wrap p-0">

                    <div class="row">

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Small Heading</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Large Heading</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                      <div class="col-12">
                        <label class="font12">Paragraph bold</label>
                        <textarea class="proTextarea" rows="6"></textarea>
                      </div>

                      <div class="col-12">
                        <label class="font12">Paragraph</label>
                        <textarea class="proTextarea" rows="6"></textarea>
                      </div>

                      <div class="col-6">
                        <div class="form-wrap p-0">
                          <label class="font13 mb-5">Right Side Image (600px X 450px)</label>
                          <div class="upload-pic"></div>
                          <input type="file" id="input-file-now" class="dropify" />
                        </div>
                      </div>

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Large text under image</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="col-12 mb-30">
            <div class="card">
              <div class="header">
                <h2>Our <span>Staff</span></h2>
              </div>
              <div class="body">
                <div id="floating-label">
                  <div class="form-wrap p-0">

                    <div class="row">

                      <div class="col-md-6 PB-10">
                        <div class="form-group">
                          <label class="control-label mb-10">Heading</label>
                          <input type="text" id="" class="form-control" placeholder="">
                        </div>
                      </div>

                      <div class="col-12">
                        <label class="font12">Paragraph bold</label>
                        <textarea class="proTextarea" rows="4"></textarea>
                      </div>

                      <div class="header w-100">
                        <h2>Staff <span>List</span></h2>
                        <button id="productlist01" class="btn add_button"><i class="fa fa-plus"></i>
                          <span>Add Staff</span></button>
                      </div>

                      <div class="col-12 PT-10">

                        <table class="table table-hover dt-responsive nowrap" id="example" style="width:100%">
                          <thead>
                            <tr>

                              <th>Name</th>
                              <th>Designation</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><img style="width:auto; height:35px; margin-right:10px;" src="images/Faraz-Khan.png"
                                  alt="">
                                Shahid M. Khan
                              </td>
                              <td>Partner</td>
                              <td><button class="btn btn-default btn-line m-b">Edit</button>
                                <button class="btn btn-default red-bg m-b">Delete</button>
                              </td>
                            </tr>

                            <tr>
                              <td><img style="width:auto; height:35px; margin-right:10px;" src="images/Faraz-Khan.png"
                                  alt="">
                                Shahid M. Khan
                              </td>
                              <td>Partner</td>
                              <td><button class="btn btn-default btn-line m-b">Edit</button>
                                <button class="btn btn-default red-bg m-b">Delete</button>
                              </td>
                            </tr>

                            <tr>
                              <td><img style="width:auto; height:35px; margin-right:10px;" src="images/Faraz-Khan.png"
                                  alt="">
                                Shahid M. Khan
                              </td>
                              <td>Partner</td>
                              <td><button class="btn btn-default btn-line m-b">Edit</button>
                                <button class="btn btn-default red-bg m-b">Delete</button>
                              </td>
                            </tr>

                            <tr>
                              <td><img style="width:auto; height:35px; margin-right:10px;" src="images/Faraz-Khan.png"
                                  alt="">
                                Shahid M. Khan
                              </td>
                              <td>Partner</td>
                              <td><button class="btn btn-default btn-line m-b">Edit</button>
                                <button class="btn btn-default red-bg m-b">Delete</button>
                              </td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="col-md-12 text-center PT-15">
            <button id="productlist01" type="submit" class="btn btn-primary mr-2">Save</button>
            <button type="submit" class="btn btn-cancel">Cancel</button>
          </div>

        </div>
@endsection
