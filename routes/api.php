<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('paygent/pay', function (Request $request) {
       try {
        $split_count = 0; // 分期数
        $card_token = $request->card_token; // token
        $trading_id = '1111111'; // 订单号
        $payment_amount = 100; // 金额
        $result = app('paygent')->paySend($split_count, $card_token, $trading_id, $payment_amount);
       } catch (\Throwable $th) {
        dd($th);
       }
});
