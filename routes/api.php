<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\DiaryController;
use App\Http\Controllers\API\TransactionsController;

Route::post('v1/register', [RegisterController::class, 'register']);
Route::post('v1/login', [RegisterController::class, 'login'])->name('login');

// Route::middleware('auth:api')->group( function () {

    Route::get('v1/users', [UserController::class, 'index']);
    Route::get('v1/user/{id}', [UserController::class, 'show']);
    Route::delete('v1/user/{id}', [UserController::class, 'destroy']);


Route::middleware(['role', 'auth:api'])->group( function () {
    Route::get('v1/products', [ProductController::class, 'index']);
    Route::post('v1/product', [ProductController::class, 'store']);
    Route::get('v1/product/{id}', [ProductController::class, 'show']);
    Route::put('v1/product/{id}', [ProductController::class, 'update']);
    Route::delete('v1/product/{id}', [ProductController::class, 'destroy']);
});


    Route::get('v1/diaries', [DiaryController::class, 'index']);
    Route::post('v1/diary', [DiaryController::class, 'store']);
    Route::get('v1/diary/{id}', [DiaryController::class, 'show']);
    Route::get('v1/diary/{id}', [DiaryController::class, 'update']);
    Route::delete('v1/diary/{id}', [DiaryController::class, 'destroy']);

    Route::post('v1/credit', [TransactionsController::class, 'credit']);
    Route::post('v1/withdrawal', [TransactionsController::class, 'withdrawal']);
// });



// Route::middleware('auth:api')->group( function () {
//     Route::get('user/{user}', [RegisterController::class, 'show']);
//     Route::get('user/{user}/diaries', [RegisterController::class, 'show_diaries']);
//     Route::get('v1/user/', [RegisterController::class, 'index']);
//     Route::delete('v1/user/{user}', [RegisterController::class, 'destroy']);

//     Route::get('user/{user}', [RegisterController::class, 'show']);
//     Route::get('user/{user}/diaries', [RegisterController::class, 'show_diaries']);
//     Route::get('v1/diaries/', [DiaryController::class, 'index']);
//     Route::delete('v1/user/{user}', [RegisterController::class, 'destroy']);
// });

// Route::middleware('auth:api')->group( function () {
//     Route::resource('v1/product', ProductController::class);
//     Route::resource('v1/diary', ProductController::class);
// });


// Route::prefix(prefix: 'v1/user')->middleware('auth:api')->group( function () {
//     Route::get('v1/user/{id}', [RegisterController::class, 'show']);
//     Route::get('v1/user/', [RegisterController::class, 'index']);
//     Route::delete('v1/user/{id}', [RegisterController::class, 'destroy']);

//     Route::get('v1/diaries', [DiaryController::class, 'index']);
//     Route::post('v1/diary', [DiaryController::class, 'store']);
//     Route::get('v1/diary/{id}', [DiaryController::class, 'show']);
//     Route::get('v1/diary/{id}/diaries', [DiaryController::class, 'update']);
//     Route::delete('v1/diary/{id}', [DiaryController::class, 'destroy']);
// });


