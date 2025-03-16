<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\PipelineController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Contacts api routes
    Route::put('contacts/bulk-update', [ContactController::class, 'bulkUpdate']);
    Route::delete('contacts/bulk-delete', [ContactController::class, 'bulkDelete']);
    Route::apiResource('contacts', ContactController::class);

    Route::apiResource('opportunities', OpportunityController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('pipelines', PipelineController::class);
    Route::apiResource('users', UserController::class);
});
