<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MatchController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::get('test', function () {
    return response()->json(['test' => 'joo dat funkt']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('profile', [UserController::class, 'getProfile']);
    Route::get('setting', [UserController::class, 'getSetting']);
    Route::get('match', [MatchController::class, 'getMatches']);
    Route::post('match', [MatchController::class, 'createMatch']);
    Route::delete('match', [MatchController::class, 'deleteMatch']);
    Route::get('users', [MatchController::class, 'getUsers']);
    Route::get('match/{match}/message', [MessageController::class, 'fetchMessages']);
    Route::post('match/{match}/message', [MessageController::class, 'sendMessage']);
});
