<?php

namespace App\Providers;

use App\InterFaces\Frontend\CompareRepositoryInterface;
use App\Repository\Frontend\CompareRepository;
use Illuminate\Support\ServiceProvider;
use App\InterFaces\Banner\BannerRepositoryInterface;
use App\Repository\Banner\BannerRepository;
use App\InterFaces\Category\CategoryRepositoryInterface;
use App\Repository\Category\CategoryRepository;
use App\InterFaces\Brand\BrandRepositoryInterface;
use App\Repository\Brand\BrandRepository;
use App\InterFaces\Product\ProductRepositoryInterface;
use App\Repository\Product\ProductRepository;

use App\InterFaces\User\UserRepositoryInterface;
use App\Repository\User\UserRepository;
use App\InterFaces\Coupon\CouponRepositoryInterface;
use App\Repository\Coupon\CouponRepository;
use App\InterFaces\Frontend\FrontendRepositoryInterface;
use App\Repository\Frontend\FrontendRepository;
use App\InterFaces\Frontend\CartRepositoryInterface;
use App\Repository\Frontend\CartRepository;
use App\Repository\Frontend\WishlistRepository;
use App\InterFaces\Frontend\WishlistRepositoryInterface;
use App\Repository\Frontend\CheckoutRepository;
use App\InterFaces\Frontend\CheckoutRepositoryInterface;
use App\Repository\Shipping\ShippingRepository;
use App\InterFaces\Shipping\ShippingRepositoryInterface;
use App\Repository\Frontend\ProductReviewRepository;
use App\Interfaces\Frontend\ProductReviewRepositoryInterface;
use App\Repository\Order\OrderRepository;
use App\InterFaces\Order\OrderRepositoryInterface;
use App\Repository\Currency\CurrencyRepository;
use App\InterFaces\Currency\CurrencyRepositoryInterface;
use App\InterFaces\Settings\SettingsRepositoryInterface;
use App\Repository\Settings\SettingsRepository;
use App\InterFaces\About\AboutRepositoryInterface;
use App\Repository\About\AboutRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(\App\InterFaces\Seller\Product\ProductRepositoryInterface::class, \App\Repository\Seller\Product\ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FrontendRepositoryInterface::class, FrontendRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(CheckoutRepositoryInterface::class, CheckoutRepository::class);
        $this->app->bind(ShippingRepositoryInterface::class, ShippingRepository::class);
        $this->app->bind(ProductReviewRepositoryInterface::class, ProductReviewRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(\App\InterFaces\Seller\Order\OrderRepositoryInterface::class , \App\Repository\Seller\Order\OrderRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(CompareRepositoryInterface::class, CompareRepository::class);
        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
