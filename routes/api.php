<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ColorController;

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
    Route::post('/', [CategoryController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [CategoryController::class, 'update'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('/subcategories')->group(function(){
    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('/{id}', [SubcategoryController::class, 'show']);
    Route::post('/', [SubcategoryController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [SubcategoryController::class, 'update'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [SubcategoryController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('/products')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [ProductController::class, 'update'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner,superadmin']);
});

Route::prefix('/productdetails')->group(function(){
    Route::post('/', [ProductDetailsController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [ProductDetailsController::class, 'update'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [ProductDetailsController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('/colors')->group(function(){
    Route::post('/', [ColorController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::get('/{id}', [ColorController::class, 'show'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [ColorController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});