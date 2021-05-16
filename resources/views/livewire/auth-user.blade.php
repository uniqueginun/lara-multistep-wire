<div>
    <form wire:submit.prevent="submit">
        @guest
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" wire:model="state.auth" id="sign-up" value="signup">
            <label class="form-check-label" for="sign-up">Sign up</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" wire:model="state.auth" id="sign-in" value="signin">
            <label class="form-check-label" for="sign-in">Sign In</label>
        </div>
        @endguest
        <div class="form-group">
            <label for="personal-id">Personal Id</label>
            <input type="text" wire:model.defer="state.personal_id" class="form-control" id="personal-id">
            @error('state.personal_id')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        @if($state['auth'] === 'signup')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" wire:model.defer="state.name" class="form-control" id="name">
            @error('state.name')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endif
        @guest
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" wire:model.defer="state.password">
            @error('state.password')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endguest
        <a href="#" wire:click.prevent="$emitUp('goToStep', 1)">Back</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>