<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewRequest extends Component
{
    public $state;

    public function store()
    {
        $this->emitUp('store');
    }

    public function render()
    {
        return view('livewire.review-request');
    }
}
