<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResourcesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::prefix('/resources')->controller(ResourcesController::class)->group(function () {
//     Route::get('/prefectures/{language}/{output}', 'prefectures');
// });

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});
