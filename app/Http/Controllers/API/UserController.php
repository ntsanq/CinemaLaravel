<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return $this->success([Auth::user()->toArray()]);
    }
}
