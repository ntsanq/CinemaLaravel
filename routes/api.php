<?php

use App\Http\Controllers\API\AuthController;
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
    Route::get('/user', function (){
        return "USER's page";
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logoutAll', [AuthController::class, 'logoutAll']);
});

Route::get('/', function (Request $request) {
    return 'Cinema APIs';
});

Route::get('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
