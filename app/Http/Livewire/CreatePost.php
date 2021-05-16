<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public $state = [
        'title' => '',
        'body' => '',
    ];

    protected $rules = [
        'state.title' => 'required',
        'state.body' => 'required',
    ];

    protected $messages = [
        'state.title.required' => 'Title is required',
        'state.body.required' => 'Body is required',
    ];

    public function updatedState()
    {
        $this->emitUp('mergeState', $this->state);
    }

    public function submit()
    {
        $this->validate();

        $this->emitUp('goToStep', 4);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
