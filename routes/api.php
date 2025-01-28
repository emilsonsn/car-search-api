<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LinkController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('group')->group(function () {
    Route::get('/',[GroupController::class, 'index']);
    Route::post('/',[GroupController::class, 'store']);
    Route::patch('{id}',[GroupController::class, 'update']);
    Route::delete('{id}',[GroupController::class, 'destroy']);
});

Route::prefix('links')->group(function () {
    Route::get('/',[LinkController::class, 'index']);
    Route::post('/',[LinkController::class, 'store']);
    Route::patch('{id}',[LinkController::class, 'update']);
    Route::delete('{id}',[LinkController::class, 'destroy']);
});
