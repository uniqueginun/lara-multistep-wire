<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AcceptingTerms extends Component
{
    public $state = [
        'acceptingTerms' => false
    ];

    public function updatedState()
    {
        $this->emitUp('mergeState', $this->state);
    }

    public function submit()
    {
        $this->emitUp('goToStep', 2);
    }

    public function render()
    {
        return view('livewire.accepting-terms');
    }
}
