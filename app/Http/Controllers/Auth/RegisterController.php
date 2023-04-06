<?php

namespace App\Http\Controllers\Auth;


use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function index()
    {
        return view('auth.register.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::Customer,
        ]);

        if (!empty($user)) {
            $token = $user->createToken('authToken')->plainTextToken;
            session(['token' => $token]);

            if ($request->failedFilm) {
                return redirect("ticket/select?filmId=$request->failedFilm");
            } else {
                return redirect('/');
            }
        }


        return view('auth.register.index')->with($request->input());
    }
}
