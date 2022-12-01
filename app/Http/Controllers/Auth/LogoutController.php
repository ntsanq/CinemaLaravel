<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LogoutController
{
    public function logout(Request $request)
    {
        $request->session()->forget('token');

        return redirect('/');
    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return redirect('/');
    }
}
