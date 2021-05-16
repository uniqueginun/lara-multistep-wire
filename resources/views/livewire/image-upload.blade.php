<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="image">Post image</label>
            <input type="file" wire:model.defer="state.image" class="form-control" id="image">
            @error('state.image')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <a href="#" wire:click.prevent="$emitUp('goToStep', 3)">Back</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>