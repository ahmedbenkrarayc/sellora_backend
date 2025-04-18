<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IAuthRepository;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\IStoreRepository;
use App\Repositories\StoreRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ISubcategoryRepository;
use App\Repositories\SubcategoryRepository;
use App\Repositories\Interfaces\IProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\Interfaces\IProductDetailsRepository;
use App\Repositories\ProductDetailsRepository;
use App\Repositories\Interfaces\IColorRepository;
use App\Repositories\ColorRepository;
use App\Repositories\Interfaces\ISizeRepository;
use App\Repositories\SizeRepository;
use App\Repositories\Interfaces\IProductVariantRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\Interfaces\IProductVariantImageRepository;
use App\Repositories\ProductVariantImageRepository;
use App\Repositories\Interfaces\IWishListRepository;
use App\Repositories\WishListRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\OrderRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\PaymentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(IStoreRepository::class, StoreRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ISubcategoryRepository::class, SubcategoryRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IProductDetailsRepository::class, ProductDetailsRepository::class);
        $this->app->bind(IColorRepository::class, ColorRepository::class);
        $this->app->bind(ISizeRepository::class, SizeRepository::class);
        $this->app->bind(IProductVariantRepository::class, ProductVariantRepository::class);
        $this->app->bind(IProductVariantImageRepository::class, ProductVariantImageRepository::class);
        $this->app->bind(IWishListRepository::class, WishListRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
