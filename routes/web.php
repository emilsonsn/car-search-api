<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/groups', [HomeController::class, 'groups'])->name('groups');
Route::get('/links', [HomeController::class, 'links'])->name('links');

Route::prefix('group')->group(function () {
    Route::get('',[GroupController::class, 'index']);
    Route::post('',[GroupController::class, 'store']);
    Route::patch('{id}',[GroupController::class, 'update']);
    Route::delete('{id}',[GroupController::class, 'destroy']);
});

Route::prefix('link')->group(function () {
    Route::get('',[LinkController::class, 'index']);
    Route::post('',[LinkController::class, 'store']);
    Route::patch('{id}',[LinkController::class, 'update']);
    Route::delete('{id}',[LinkController::class, 'destroy']);
});