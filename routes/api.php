<?php

use App\Http\Controllers\Products\ApiProductController;
use App\Http\Controllers\Weeks\ApiWeekController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::post('login', [LoginController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::resource('product', ApiProductController::class);
    Route::resource('week', ApiWeekController::class);




});
