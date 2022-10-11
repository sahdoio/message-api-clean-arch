<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\System\StatusController;
use App\Http\Controllers\User\FindUserController;
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

Route::get('/',  [StatusController::class, 'apiAlive']);

Route::post('/authenticate', [AuthenticationController::class, 'handle']);

Route::prefix('users')->group(function () {
    Route::post('/', [CreateUserController::class, 'handle']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{id}', [FindUserController::class, 'handle']);
    });    
});

