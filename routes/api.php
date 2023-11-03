<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function() {
    Route::post('auth/login', LoginController::class);
    Route::post('auth/register', RegisterController::class);

    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/task', [TaskController::class, 'create']);
        Route::get('/task', [TaskController::class, 'index']);
    });
});




