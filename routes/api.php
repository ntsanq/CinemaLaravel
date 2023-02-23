<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\SeatController;
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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function() {
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
Route::post('/confirmBooking', [BookingController::class, 'confirmBooking']);
