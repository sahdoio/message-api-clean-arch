<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Message\CreateMessageController;
use App\Http\Controllers\Message\ListMessagesController;
use App\Http\Controllers\Message\UpdateMessageController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\System\StatusController;
use App\Http\Controllers\Thread\CreateThreadController;
use App\Http\Controllers\Thread\ListThreadsController;
use App\Http\Controllers\User\FindUserController;
use App\Http\Controllers\User\SearchUserMessagesController;
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
        Route::get('/{id}/messages', [SearchUserMessagesController::class, 'handle']);
    });    
    Route::prefix('threads')->group(function () {
        Route::post('', [CreateThreadController::class, 'handle']);
        Route::get('/{userId}', [ListThreadsController::class, 'handle']);
    });    
    Route::prefix('messages')->group(function () {
        Route::post('', [CreateMessageController::class, 'handle']);
        Route::get('/{threadId}', [ListMessagesController::class, 'handle']);
        Route::patch('/{messageId}', [UpdateMessageController::class, 'handle']);        
    });    
});

