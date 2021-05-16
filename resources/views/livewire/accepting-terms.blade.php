<div x-data="{ enabled: @entangle('state.acceptingTerms') }">
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="terms">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum accusamus aspernatur exercitationem inventore nemo, minima repellendus amet animi atque incidunt eius, ab, nostrum vero officia asperiores dolorem! Praesentium, inventore ex.</label>
            <input type="checkbox" id="terms" class="form-check" wire:model="state.acceptingTerms">
            @error('state.acceptingTerms')
            <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button :disabled="!enabled" class="btn btn-primary">Next</button>
    </form>
</div>