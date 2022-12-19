<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->failed('user not found or password is wrong');
        }
        $token = $user->createToken('authToken')->plainTextToken;

        return $this->success([
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success([]);
    }

    public function logoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->success([]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        if ($this)

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::Customer,
        ]);

        if (!empty($user)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return $this->success([
                'token' => $token
            ]);
        }

        return $this->failed('Something was wrong');
    }
}
