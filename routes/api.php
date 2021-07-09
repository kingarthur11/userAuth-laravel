<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;

Route::post('v1/register', [RegisterController::class, 'register']);
Route::post('v1/login', [RegisterController::class, 'login']);
Route::get('user/{user}', [RegisterController::class, 'show']);
Route::get('user/{user}/diaries', [RegisterController::class, 'show_diaries']);
Route::get('v1/user/', [RegisterController::class, 'index']);
Route::delete('v1/user/{user}', [RegisterController::class, 'destroy']);

Route::middleware('auth:api')->group( function () {
    Route::resource('v1/product', ProductController::class);
    Route::resource('v1/diary', ProductController::class);
});
