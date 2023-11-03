<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController
{
    public function __invoke(LoginRequest $request): UserResource
    {
        $data = $request->validated();

        if(! Auth::once($data)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        /** @var User $user */
        $user = Auth::user();

        return (new UserResource($user))->additional([
            'token' => $user->createToken('api')->plainTextToken
        ]);
    }
}
