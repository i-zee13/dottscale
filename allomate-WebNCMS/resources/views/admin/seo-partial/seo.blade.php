@php
    $isDefault = false;
    if (Route::currentRouteName() == 'admin.organization') {
        $isDefault = true;
    }
@endphp

<div class="col-12 mb-30">
    <div class="header">
        <h2>Add <span>{{$isDefault ? 'Default ' :''}}Meta Details</span></h2>
    </div>
    <div class="body">
        <div id="floating-label">
            <div class="form-wrap p-0">
                <div class="row">
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="control-label mb-10">Page Title</label>
                            <input type="text" name="seo_page_title" class="form-control" value="{{@$page_title}}"  >
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                        <label class="control-label mb-10">Meta Content (Author)</label>
                        <input type="text" name="meta_content_author" class="form-control" value="{{@$meta_content_author}}"  >
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="control-label mb-10">Meta Tag Name</label>
                            <input type="text" name="seo_meta_tag_name" class="form-control" value="{{@$meta_tag_name}}"  >
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="control-label mb-10">Meta Keywords <small>(Separate by commas)</small></label>
                            <textarea class="form-control " name="seo_meta_keywords">{{@$meta_keywords}}</textarea>
                        </div>
                    </div>


                  <div class="col-md-8 mt-5">
                    <div class="form-group">
                        <label class="control-label mb-10">Meta Description</label>
                        <textarea class="form-control " name="seo_meta_description">{{@$meta_description}}</textarea>
                    </div>
                </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="control-label mb-10">OG Title</label>
                            <input type="text" name="meta_og_title" class="form-control" value="{{@$meta_og_title}}"  >
                        </div>
                    </div>
                    <div class="col-md-8 mt-5">
                        <div class="form-group">
                            <label class="control-label mb-10">OG Description</label>
                            <textarea class="form-control " name="meta_og_description">{{@$meta_og_description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 PT-5">
                        <label class="font12 mb-5"> OG Image</label>
                        <div class="form-wrap p-0">
                              <input type="hidden"
                                    value="{{@$meta_og_image}}"
                                    name="hidden_meta_og_image" id="hidden_meta_og_image">
                            <input type="file" name="meta_og_image" accept="image/*"  data-old_input="hidden_meta_og_image" id="meta_og_image" class="dropify"
                            data-default-file="{{ @$meta_og_image != '' ? Storage::url(@$meta_og_image) : '' }}" />
                        </div>
                    </div>
                    <div class="col-3" style="padding-top: 4px;">
                      <label class="font12">Is Followable</label>
                      <div class="form-group d-flex">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="followable_yes" name="is_followable"
                                  value="1" class="custom-control-input" {{@@$is_followable == 1 ? 'checked' : ''}}>
                              <label class="custom-control-label" for="followable_yes">Yes</label>
                          </div>
                          <div class="custom-control custom-radio ml-3">
                              <input type="radio" id="followable_no" name="is_followable"
                                  value="0" class="custom-control-input" {{@@$is_followable == 0 ? 'checked' : ''}}>
                              <label class="custom-control-label" for="followable_no">No</label>
                          </div>
                      </div>
                  </div>

                  <div class="col-3" style="padding-top: 4px;">
                      <label class="font12">Is Indexable</label>
                      <div class="form-group d-flex">
                          <div class="custom-control custom-radio">
                              <input type="radio" id="indexable_yes" name="is_indexable"
                                  value="1" class="custom-control-input" {{@@$is_indexable == 1 ? 'checked' : ''}}>
                              <label class="custom-control-label" for="indexable_yes">Yes</label>
                          </div>
                          <div class="custom-control custom-radio ml-3">
                              <input type="radio" id="indexable_no" name="is_indexable"
                                  value="0" class="custom-control-input" {{@@$is_indexable == 0 ? 'checked' : ''}}>
                              <label class="custom-control-label" for="indexable_no">No</label>
                          </div>
                      </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
