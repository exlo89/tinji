<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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
    Route::get('profile', [UserController::class, 'getProfile'])->name('profile.show');
    Route::get('setting', [UserController::class, 'getSetting'])->name('setting.show');
    Route::get('match', [MatchController::class, 'getMatches'])->name('match.show');
    Route::post('match', [MatchController::class, 'createMatch'])->name('match.create');
    Route::delete('match', [MatchController::class, 'deleteMatch'])->name('match.delete');
    Route::get('users', [MatchController::class, 'getUsers'])->name('users.show');
    Route::get('match/{match}/message', [MessageController::class, 'getMessages'])->name('matches.messages');
});
