<div>
    <div class="modal-body-image-wrapper mb-5">
        <img src="/images/system/modal-graphic-1.svg" class="mb-4">
        <h5 class="modal-title">
            Are you sure?
        </h5>
    </div>

    <div class="modal-body" id="">
        <div class="form-row justify-content-center is-modal-foot">
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Proceed" wire:click="delete()">
            </div>

            <div class="form-group is-marginless">
                <a class="btn btn-light" @click.prevent="$dispatch(setShowPropertyTo(false))">Cancel</a>
            </div>
        </div>
    </div>
</div>
