<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" wire:model.defer="state.title" class="form-control" id="title">
            @error('state.title')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Body</label>
            <textarea wire:model.defer="state.body" class="form-control" id="body"></textarea>
            @error('state.body')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <a href="#" wire:click.prevent="$emitUp('goToStep', 2)">Back</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>