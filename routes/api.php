<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;

Route::post('v1/register', [RegisterController::class, 'register']);
Route::post('v1/login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::resource('v1/sproducts', ProductController::class);
});
