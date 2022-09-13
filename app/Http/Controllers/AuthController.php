<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return $request->all();
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $data = $this->validate($request,[
            'email'=>'email'
        ]);
        return 2;
    }
}
