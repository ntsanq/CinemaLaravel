<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function index(Request $request)
    {
        return view('auth.login.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return view('auth.login.index')->withErrors(['failed_auth' => 'Your email or password is not correct!'])->with($request->input());
        }
        $token = $user->createToken('authToken')->plainTextToken;
        session(['token' => $token]);

        if ($request->failedFilm) {
            return redirect("ticket/select?filmId=$request->failedFilm");
        }  else {
            return redirect('/');
        }
    }
}
