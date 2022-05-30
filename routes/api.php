<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Route::prefix('/resources')->controller(ResourcesController::class)->group(function () {
//     Route::get('/prefectures/{language}/{output}', 'prefectures');
// });

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/userinfo', 'userinfo');
});

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

Route::get('/check',[TestController::class,'check']);
