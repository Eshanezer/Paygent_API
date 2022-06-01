<?php

use App\Http\Controllers\API\OpenIdController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Route::prefix('/auth')->controller(AuthController::class)->group(function () {
//     Route::post('userinfo', 'userinfo');
// });

//remove this after meeting
Route::post('/retrieve/access/token', function(Request $request) {
    // return $request;
    $res = Http::withHeaders([
        'Authorization' => 'Bearer '. $request->access_token
    ])
    ->get('https://login2.jleague.jp/userinfo');
    return $res;
});
//end remove this after meeting

Route::prefix('auth')->group(function() {
    Route::prefix('open-id')->controller(OpenIdController::class)->group(function() {
        Route::post('get-code', 'getOpenIdCode');
    });
});
