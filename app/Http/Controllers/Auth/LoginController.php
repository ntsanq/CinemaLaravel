<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        return view('auth.login.index', [
            'search' => $search
        ]);
    }

    public function check(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'user not found or password is wrong',
                'request' => $request->email
            ], 400);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        session(['token' => $token]);

        return redirect('/');
    }
}
