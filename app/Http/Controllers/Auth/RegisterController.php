<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): UserResource
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::create($data);

        return (new UserResource($user))->additional([
            'token' => $user->createToken('api')->plainTextToken,
        ]);
    }
}
