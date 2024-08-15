<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/health', function (Request $request) {
    return "UP";
});
Route::prefix('/v1/users')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
    Route::post('/registration', [UserController::class, 'createUser']);
    Route::post('/update', [UserController::class, 'updateUser']);
});
