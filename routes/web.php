<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/films/{id}', [FilmController::class, 'index']);

Route::get('/signIn', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/signIn', [LoginController::class, 'check'])->name('signIn.check');

Route::get('/signUp', [RegisterController::class, 'index']);
Route::post('/signUp', [RegisterController::class, 'store']);

Route::post('/signOut', [LogoutController::class, 'logout']);

Route::prefix('/ticket')->group(function () {
    Route::get('/select', [TicketController::class, 'select']);
    Route::get('/receipt', [TicketController::class, 'showReceipt']);
});
