<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.refreshtoken');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware(['jwt.api'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('/stores')->group(function(){
    Route::get('/{id}', [StoreController::class, 'show']);//everyone
    Route::get('/', [StoreController::class, 'index'])->middleware(['jwt.api', 'role:storeowner']);
    Route::post('/', [StoreController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [StoreController::class, 'update'])->middleware(['jwt.api', 'role:storeowner,superadmin']);
    Route::delete('/{id}', [StoreController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner,superadmin']);
});