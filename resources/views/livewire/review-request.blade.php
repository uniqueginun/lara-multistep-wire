<div>
    {{ json_encode($state) }}
    <a href="#" wire:click.prevent="$emitUp('goToStep', 4)">Back</a>
    <button wire:click.prevent="store" class="btn btn-primary">Store</button>
</div>