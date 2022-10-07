<?php

use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/example', function () {
    return view('example');
});

######################
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/customer', function () {
    return view('customer.index');
});

Route::get('/clerk', function () {
    return view('clerk.index');
});
