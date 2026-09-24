{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content top-borderRed">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <p class="delete-modal-body-text">Are you sure you want to delete?</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary confirm_delete">Yes</button>
                <button type="button" class="btn btn-cancel cancel_delete_modal" data-dismiss="modal"
                    aria-label="Close">No</button>
            </div>
        </div>
    </div>
    <button hidden data-toggle="modal" data-target="#deleteModal" id="hidden_btn_to_open_modal"></button>
</div>