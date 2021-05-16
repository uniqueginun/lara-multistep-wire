<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Str;

class BaseRequest extends Component
{
    public $step = 1;

    public $state = [];

    protected $listeners = [
        'mergeState',
        'goToStep',
        'store'
    ];

    public function mergeState($state)
    {
        $this->state = array_merge($this->state, $state);
    }

    public function goToStep($step)
    {
        $this->step = $step;
    }

    public function store()
    {
        if (!$user = $this->handleAuth($this->state)) {
            $this->step = 2;
            throw ValidationException::withMessages([
                'state.personal_id' => [
                    'couldn\'t ' . $this->state['auth'] . ' this user'
                ]
            ]);
        }

        DB::beginTransaction();

        try {
            $post = $user->posts()->create([
                'title' => $this->state['title'],
                'body' => $this->state['body'],
            ]);

            $post->image()->create([
                'path' => $this->uploadFromPath($this->state['image'])
            ]);

            DB::commit();

            $this->state = [];
            $this->step = 1;
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.base-request');
    }

    private function handleAuth(array $data)
    {
        try {


            if ($user = auth()->user()) {
                $user->fill([
                    'name' => $data['name'],
                    'personal_id' => $data['personal_id']
                ])->save();
                return $user;
            }

            if ($data['auth'] === 'signin') {
                $user = User::where('personal_id', $data['personal_id'])->first();
                if (!($user && Hash::check($data['password'], $user->password))) {
                    return false;
                }
            } else {
                $user = User::create([
                    'personal_id' => $data['personal_id'],
                    'name' => $data['name'],
                    'password' => bcrypt($data['password']),
                    'entity_id' => 1,
                    'role' => 2
                ]);
            }

            Auth::loginUsingId($user->id);
            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

    private function uploadFromPath($path)
    {
        $name = Str::after($path, 'livewire-tmp/');
        File::copy($path, public_path('images/posts/' . $name));
        return $name;
    }
}
