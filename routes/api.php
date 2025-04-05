<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\CategoryController;

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

Route::prefix('/categories')->group(function(){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});