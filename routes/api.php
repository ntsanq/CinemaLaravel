<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\FilmCategoryController;
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\FilmRuleController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function () {
        return ['message' => 'Hello Sang!'];
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logoutAll', [AuthController::class, 'logoutAll']);
});

Route::get('/', function (Request $request) {
    return 'Cinema APIs';
});

Route::post('/auth', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/getSeats', [BookingController::class, 'getSeats']);
Route::post('/getTimes', [BookingController::class, 'getTimes']);
Route::get('/seats/{id}', [SeatController::class, 'info']);
Route::get('/films/{id}', [FilmController::class, 'info']);

//for ADMIN DASHBOARD usage
Route::prefix('/admin')->group(function () {
    Route::prefix('films')->controller(FilmController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'infoForAdmin');
        Route::put('/{id}', 'updateForAdmin');
    });

    Route::prefix('/filmCategories')->controller(FilmCategoryController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::prefix('/rooms')->controller(RoomController::class)->group(function () {
        Route::get('/', 'index');
    });
    Route::prefix('/filmRules')->controller(FilmRuleController::class)->group(function () {
        Route::get('/', 'index');
    });
});

Route::post('/confirmBooking', [BookingController::class, 'checkout']);
Route::post('/getTickets', [TicketController::class, 'getTickets']);

Route::get('/getWeeklyFilm', [FilmController::class, 'getWeekly']);

Route::post('/tickets/getTotal', [TicketController::class, 'getTotalBySessionId']);
