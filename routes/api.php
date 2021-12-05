<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\v1\PostalCodeController;

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

Route::prefix('v1')->group(function() {

    /**
     * Zip (postal) code URLs
     */
    Route::prefix('postal-codes')->group(function() {
        Route::get('/', [PostalCodeController::class, 'list']);
        Route::get('/{postalCodeId}', [PostalCodeController::class, 'retrieve']);
    });

});
