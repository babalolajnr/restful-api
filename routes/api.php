<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
//Authentication routes
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

//Authenticated routes
Route::middleware('auth:sanctum')->name('user.')->group(function () {
    Route::patch('/update', [UserController::class, 'update'])->name('update');
    Route::get('/show', [UserController::class, 'show'])->name('show');
    Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
});
