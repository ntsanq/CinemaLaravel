<?php

use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Film\FilmController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/films/{id}', [FilmController::class, 'index']);

Route::get('/customer', function () {
    return view('customer.index');
});
Route::get('/clerk', function () {
    return view('clerk.index');
});

Route::get('/sign-in', [LoginController::class, 'index']);
Route::post('/sign-in', [LoginController::class, 'signIn']);

Route::get('/sign-up', [RegisterController::class, 'index']);
Route::post('/sign-up', [RegisterController::class, 'signUp']);


######################
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);

