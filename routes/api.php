<?php

use App\Http\Controllers\API\OpenIdController;
use App\Http\Controllers\API\SFDCController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::prefix('open-id')->controller(OpenIdController::class)->group(function() {
        Route::post('get-code', 'getOpenIdCode');
    });
});

Route::get('test',[SFDCController::class,'getSFDCUserData']);
