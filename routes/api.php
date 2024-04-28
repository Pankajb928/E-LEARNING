<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/dhiraj', function (Request $request) {
   return $request;
});

Route::post('/users', [UserController::class, 'createUser']);
Route::post('/users/update', [UserController::class, 'updateUser']);

Route::prefix('/v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
});