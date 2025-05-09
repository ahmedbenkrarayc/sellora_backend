<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\ProductVariantImageController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductDetailsController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SubscriptionHistoryController;
use App\Events\TestBroadcastEvent;

Route::get('/broadcast-test', function () {
    broadcast(new TestBroadcastEvent('Hello from Laravel Reverb!'));
    return ['status' => 'Broadcast sent'];
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('jwt.refreshtoken');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/storeowners', [AuthController::class, 'storeOwnersList'])->middleware(['jwt.api', 'role:superadmin']);
Route::get('/admin/statistics', [StatisticsController::class, 'adminStatistics']);
Route::get('/storeowner/statistics/{storeId}', [StatisticsController::class, 'storeOwnerStatistics']);

Route::middleware(['jwt.api'])->group(function(){
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('/stores')->group(function(){
    Route::get('/{id}', [StoreController::class, 'show']);//everyone
    Route::get('/subdomain/{subdomain}', [StoreController::class, 'showbysubdomain']);//everyone
    Route::get('/', [StoreController::class, 'index'])->middleware(['jwt.api', 'role:superadmin']);
    Route::post('/', [StoreController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [StoreController::class, 'update'])->middleware(['jwt.api', 'role:storeowner,superadmin']);
    Route::delete('/{id}', [StoreController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner,superadmin']);
    Route::put('/status/{id}', [StoreController::class, 'updateStatus'])->middleware(['jwt.api', 'role:superadmin']);
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
    Route::get('/store/{store_id}', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::get('/curratedpicks/{store_id}', [ProductController::class, 'curratedPicks']);
    Route::get('/latest/{store_id}', [ProductController::class, 'getLatestProducts']);
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

Route::prefix('/sizes')->group(function(){
    Route::post('/', [SizeController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::get('/{id}', [SizeController::class, 'show'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [SizeController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('productvariants')->group(function(){
    Route::get('/', [ProductVariantController::class, 'index']);
    Route::get('/{id}', [ProductVariantController::class, 'show']);
    Route::post('/', [ProductVariantController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::put('/{id}', [ProductVariantController::class, 'update'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('/{id}', [ProductVariantController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('productvariantimages')->group(function(){
    Route::post('/', [ProductVariantImageController::class, 'create'])->middleware(['jwt.api', 'role:storeowner']);
    Route::delete('{id}', [ProductVariantImageController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('wishlist')->group(function(){
    Route::get('/{id}', [WishListController::class, 'index'])->middleware(['jwt.api', 'role:customer']);
    Route::post('/', [WishListController::class, 'store'])->middleware(['jwt.api', 'role:customer']);
    Route::delete('/{id}', [WishListController::class, 'destroy'])->middleware(['jwt.api', 'role:customer']);
});

Route::prefix('orders')->group(function(){
    Route::get('/store/{store_id}', [OrderController::class, 'index'])->middleware(['jwt.api', 'role:storeowner']);
    Route::get('/customer/{customer_id}', [OrderController::class, 'customerOrders'])->middleware(['jwt.api', 'role:storeowner,customer']);
    Route::post('/', [OrderController::class, 'store'])->middleware(['jwt.api', 'role:customer']);
    Route::get('/{id}', [OrderController::class, 'show'])->middleware(['jwt.api', 'role:storeowner,customer']);
    Route::put('/{id}', [OrderController::class, 'updateStatus'])->middleware(['jwt.api', 'role:storeowner,customer']);
    Route::delete('/{id}', [OrderController::class, 'destroy'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::prefix('orderpayment')->group(function(){
    Route::post('/', [PaymentController::class, 'store'])->middleware(['jwt.api', 'role:storeowner']);
    Route::get('/', [PaymentController::class, 'getAllPayments'])->middleware(['jwt.api', 'role:storeowner']);
});

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->middleware(['jwt.api']);
Route::post('/cancel', [SubscriptionController::class, 'cancel'])->middleware(['jwt.api']);
Route::post('/stripe/webhook', [SubscriptionController::class, 'webhook']);

Route::get('/subscription/history', [SubscriptionHistoryController::class, 'index'])->middleware(['jwt.api', 'role:superadmin']);