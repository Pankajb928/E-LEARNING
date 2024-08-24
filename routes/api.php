<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckJwtToken;

Route::get('/health', function (Request $request) {
    return "UP";
});

Route::middleware([CheckJwtToken::class])->group(function () {
    Route::post('/users', [UserController::class, 'createUser']);
    Route::post('/users/update', [UserController::class, 'updateUser']);
    Route::get('/users/list_user', [UserController::class, 'listUser']); 
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
   
});

Route::prefix('/v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    
});
