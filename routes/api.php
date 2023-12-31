<?php

use App\Http\Controllers\Products\ApiProductController;
use App\Http\Controllers\Week_details\ApiWeekDetailController;
use App\Http\Controllers\Weeks\ApiWeekController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CreditsDetail\ApiCreditDetailController;
use App\Http\Controllers\CreditsPeople\ApiCreditPeopleController;
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
    Route::resource('week-detail', ApiWeekDetailController::class);
    Route::resource('credit-people', ApiCreditPeopleController::class);
    Route::resource('credit-detail', ApiCreditDetailController::class);
});
