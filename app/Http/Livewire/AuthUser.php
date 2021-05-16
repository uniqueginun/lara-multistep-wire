<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AuthUser extends Component
{
    public $state;

    public $authenticated = false;

    public function mount($state)
    {
        if (!isset($state['auth'])) {
            $state['auth'] = 'signup';
        }

        $user = auth()->user();

        $this->state = array_merge($state, auth()->check() ?  ['name' => $user->name, 'personal_id' => $user->personal_id]
            : $state);
    }

    protected function rules()
    {
        return [
            'state.personal_id' => 'required|digits:10',
            'state.name' => $this->state['auth'] !== 'signup' || auth()->check() ? 'nullable' : 'required',
            'state.password' => auth()->check() ? 'nullable' : 'required'
        ];
    }

    protected $messages = [
        'state.personal_id.required' => 'Personal ID is required',
        'state.personal_id.digits' => 'Personal ID must be max of 10 digits',
        'state.name.required' => 'Name is required',
        'state.password.required' => 'Password is required'
    ];

    public function submit()
    {
        $this->validate();

        $this->emitUp('mergeState', $this->state);

        $this->emitUp('goToStep', 3);
    }

    public function render()
    {
        return view('livewire.auth-user');
    }
}
