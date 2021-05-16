<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponse;

class LoginResponse implements RegisterResponse
{
    public function toResponse($request)
    {
        return $request->user()->role === 2
            ? redirect('tenant-dashboard')
            : redirect()->intended(config('fortify.home'));
    }
}
