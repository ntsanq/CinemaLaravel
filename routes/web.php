<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/films/{id}', [FilmController::class, 'index']);

Route::get('/signIn', [LoginController::class, 'index'])->name('signIn.index');
Route::post('/signIn', [LoginController::class, 'check'])->name('signIn.check');

Route::get('/signUp', [RegisterController::class, 'index']);
Route::post('/signUp', [RegisterController::class, 'store']);

Route::prefix('/ticket')->group(function () {
    Route::get('/select', [TicketController::class, 'select']);
});

Route::middleware('auth.web')->group(function () {
    Route::post('/signOut', [LogoutController::class, 'logout']);
    Route::get('/stripe/success', [TicketController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [TicketController::class, 'cancel'])->name('stripe.cancel');
    Route::get('/stripe/repay', [TicketController::class, 'repay'])->name('stripe.repay');
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::put('/profile/update', [UserController::class, 'update']);
    Route::get('/myTickets', [UserController::class, 'showUserTickets']);
});

Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/logout', [AdminController::class, 'logout']);
});

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'loginCheck']);
