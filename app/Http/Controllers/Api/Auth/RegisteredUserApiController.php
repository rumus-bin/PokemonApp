<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Repositories\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegisteredUserApiController extends Controller
{
    public function store(RegisterUserRequest $request, UserService $userService): JsonResponse
    {
        $userDto = $userService->storeResource($request->makeResourceDto());

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => [
                'id' => $userDto->id,
                'name' => $userDto->name,
                'email' => $userDto->email,
                'token' => $userDto->authToken
            ]
        ], 201);
    }
}
