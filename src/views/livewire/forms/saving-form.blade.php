<div>
    <div class="modal-body-image-wrapper">
        <img src="/images/system/modal-graphic-1.svg" class="mb-4">
        <h5 class="modal-title mb-2">
            Saving
        </h5>
    </div>
    <form wire:submit="submit">
        <div>
            <div class="form-row mb-3">
                <div class="form-check form-check-inline">
                    <div class="radio">
                        <input wire:model='form.type' id="deposit" name="" type="radio" value="deposit">
                        <label for="deposit" class="radio-label">Deposit</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="radio">
                        <input wire:model='form.type' id="withdrawal" type="radio" value="withdrawal">
                        <label for="withdrawal" class="radio-label">Witdrawal</label>
                    </div>
                </div>
            </div>
            @error('form.type')
                <span class="help-block text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="other-inputs">
            <div class="form-row is-full-width mb-3">
                <div class="form-group">
                    <label for="amount" class="is-marginless">Amount</label>
                    <div class="input-group">
                        <input wire:model='form.amount' class="form-control is-borderless" id="amount" name="amount"
                            type="number">
                    </div>
                    <span class="bar"></span>
                    @error('form.amount')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row is-full-width mb-3">
            <label>Date</label>
            <div class="input-group">
                <input wire:model='form.date' class="form-control is-borderless date" type="date" locale='en_Us'>
            </div>
            <span class="bar"></span>
            @error('form.date')
                <span class="help-block text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-row justify-content-center is-modal-foot">
            <input class="btn btn-primary" type="submit" value="Save">
            <a class="btn btn-light" @click.prevent="$dispatch(setShowPropertyTo(false))">Close</a>
        </div>
    </form>
</div>
