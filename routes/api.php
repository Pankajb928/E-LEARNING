<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassmasterController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\CheckJwtToken;

Route::get('/health', function (Request $request) {
    return "UP";
});

Route::middleware([CheckJwtToken::class])->group(function () {
    Route::prefix('v1/users')->group(function () {
    Route::post('/add', [UserController::class, 'createUser']);
    Route::post('/update', [UserController::class, 'updateUser']);
    Route::post('/delete', [UserController::class, 'deleteUser']);
    Route::get('/list_user', [UserController::class, 'listUser']); 
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
    });
    Route::prefix('v1/class')->group(function () {
    Route::post('/add', [ClassmasterController::class, 'createClass']);
    Route::put('/update/{classCode}/{section}', [ClassmasterController::class, 'updateClass']);
    Route::get('/list_class', [ClassmasterController::class, 'listClass']);
    Route::put('/delete_class', [ClassmasterController::class, 'deleteClass']);

    });
});

Route::prefix('/v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
});
Route::prefix('/reports')->group(function () {
    Route::get('/userReport', [ReportController::class, 'userReport']);
});



