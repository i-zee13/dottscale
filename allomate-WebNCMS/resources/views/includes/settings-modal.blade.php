<div class="modal fade newSubModModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sub Module Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body PT-0">
                <div id="floating-label">
                    <form id="newParentModForm" enctype="multipart/form-data">
                        @csrf
                        <input name="parent_op" hidden />
                        <div class="form-wrap _w90 pt-0 PB-10" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Parent Module Name*</label>
                                        <input type="text" name="parent_module_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Show in sidebar*</label>
                                        <select class="form-control" name="show_in_sidebar">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Parent Module For*</label>
                                        <select class="form-control" name="parent_module_for">
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Investor</option>
                                            <option value="3">Both</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="PB-10">
                                        <label class="font12">Parent Icon*</label>
                                        <div class="upload-pic"></div>
                                        <input type="file" name="parent_icon" id="icon" class="dropify"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Sub Module Name*</label>
                                        <input type="text" name="module_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Route*</label>
                                        <input type="text" name="route" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Made Up Name*</label>
                                        <input type="text" name="made_up_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Show in sub-menu*</label>
                                        <select class="form-control" name="show_in_sub_menu">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Sub Module For*</label>
                                        <select class="form-control" name="sub_module_for">
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Investor</option>
                                            <option value="3">Both</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label class="font12">Icon*</label>
                                        <div class="upload-pic"></div>
                                        <input type="file" name="icon" id="icon" class="dropify"
                                            accept="image/*" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form id="newSubModForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-wrap _w90 pt-0 PB-10" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Module Name*</label>
                                        <input type="text" name="module_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Route*</label>
                                        <input type="text" name="route" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Made Up Name*</label>
                                        <input type="text" name="made_up_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Show in sub-menu*</label>
                                        <select class="form-control" name="show_in_sub_menu">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Sub Module For*</label>
                                        <select class="form-control" name="sub_module_for">
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Investor</option>
                                            <option value="3">Both</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pt-19">
                                        <label class="font12">Icon*</label>
                                        <div class="upload-pic"></div>
                                        <input type="file" name="icon" id="icon" class="dropify"
                                            accept="image/*" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="font-size: 12px; font-weight: normal"
                    data-dismiss="modal">Close</button>
                <button type="button" id="saveNewSubMod" class="btn btn-primary"
                    style="font-size: 12px; font-weight: normal">Save</button>
                <button type="button" id="saveParentMod" class="btn btn-primary"
                    style="font-size: 12px; font-weight: normal">Save</button>
            </div>
        </div>
    </div>
</div>
<button style="display:none" class="openSubModModal" data-toggle="modal" data-target=".newSubModModal"></button>
<button style="display:none" class="open_confirmation_modal" data-toggle="modal"
    data-target=".db-confirmation-modal"></button>
