<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return view('admin.login')->withErrors(['failed_auth' => 'Your email or password is not correct!'])->with($request->input());
        }
        if ($user->role == UserRole::Clerk) {
            session(['role' => 'clerk']);
        }
        if ($user->role == UserRole::Admin) {
            session(['role' => 'admin']);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        session(['admin_token' => $token]);

        return redirect('/admin');
    }
}
