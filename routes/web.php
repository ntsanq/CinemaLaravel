<?php

use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Logout\LogoutController;
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

Route::get('/signIn', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/signIn', [LoginController::class, 'check'])->name('signIn.check');

Route::get('/signUp', [RegisterController::class, 'index']);
Route::post('/signUp', [RegisterController::class, 'store']);

Route::post('/signOut', [LogoutController::class, 'logout']);


Route::group([
    'middleware' => 'admin'
], function (){
    Route::get('/admin', [AdminController::class, 'index']);
});

######################
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);

