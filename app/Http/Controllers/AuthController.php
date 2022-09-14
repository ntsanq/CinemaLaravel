<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'user not found or password is wrong'
            ]);
        }
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {

        $validator = $this->checkValidation($request);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday
        ]);

        return response()->json([
            "status" => 'success',
            "data" => [
                'id' => $user->id,
                'email' => $user->email
            ]
        ], 201);
    }

    private function checkValidation($request)
    {
        $rules = [
            'email' => 'email|required|unique:users',
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,50})'
            ],
            'name' => 'required',
            'birthday' => [
                'required',
                'date',
                'before:01/01/2020 00:00'
            ],
        ];
        $messages = [
            'password.regex' => 'Password must contain at least one number and both uppercase and lowercase letters.',
            'birthday.before' => 'Your age have not permission to use this website.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
