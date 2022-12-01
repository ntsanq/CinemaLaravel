<?php

use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Auth\Logout\LogoutController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Film\FilmController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Ticket\TicketController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/films/{id}', [FilmController::class, 'index']);

Route::get('/signIn', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/signIn', [LoginController::class, 'check'])->name('signIn.check');

Route::get('/signUp', [RegisterController::class, 'index']);
Route::post('/signUp', [RegisterController::class, 'store']);

Route::post('/signOut', [LogoutController::class, 'logout']);

Route::prefix('/ticket')->group(function (){
    Route::get('/date', [TicketController::class, 'date']);
    Route::get('/seat', [TicketController::class, 'seat']);
});
