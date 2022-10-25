<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\Request;

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
}
