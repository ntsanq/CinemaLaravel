<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\FilmController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/films/{id}', [FilmController::class, 'index']);

Route::get('/signIn', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/signIn', [LoginController::class, 'check'])->name('signIn.check');

Route::get('/signUp', [RegisterController::class, 'index']);
Route::post('/signUp', [RegisterController::class, 'store']);

Route::post('/signOut', [LogoutController::class, 'logout']);

Route::prefix('/ticket')->group(function () {
    Route::get('/date', [TicketController::class, 'date']);
    Route::post('/date', [TicketController::class, 'dateList']);

    Route::get('/seat', [TicketController::class, 'seat']);
    Route::post('/seat', [TicketController::class, 'seat']);
});
