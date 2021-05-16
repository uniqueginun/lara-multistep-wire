<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $state = [
        'image' => null
    ];

    protected $rules = [
        'state.image' => 'required|image',
    ];

    public function submit()
    {
        $this->validate();

        $image = (object) $this->state['image'];

        $this->emitUp('mergeState', [
            'image' => $image->getRealPath()
        ]);

        $this->emitUp('goToStep', 5);
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
