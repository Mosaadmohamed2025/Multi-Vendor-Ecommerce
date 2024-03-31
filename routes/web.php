<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\ShippingController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;


//user auth
Route::get('/user/auth',[IndexController::class , 'userAuth'])->name('user.auth');
Route::post('user/login',[IndexController::class , 'loginSubmit'])->name('login.submit');
Route::post('user/register',[IndexController::class , 'registerSubmit'])->name('register.submit');
Route::get('user/logout',[IndexController::class , 'userLogout'])->name('user.logout');




//home
Route::get('/',[IndexController::class , 'index'])->name('home');

//product
Route::get('/product-category/{slug}',[IndexController::class , 'ProductCategory'])->name('product.category');
Route::get('/product-detail/{slug}/' , [IndexController::class , 'productDetail'])->name('product.detail');
Route::post('product-review/{slug}' , [\App\Http\Controllers\Frontend\ProductReviewController::class , 'productReview'])->name('product.review');


//cart
Route::get('cart' , [CartController::class , 'cart'])->name('cart');
Route::post('cart/store', [CartController::class , 'cartStore'])->name('cart.store');
Route::post('cart/delete', [CartController::class , 'cartDelete'])->name('cart.delete');
Route::post('coupon/add', [CartController::class , 'couponAdd'])->name('coupon.add');

//wishlist
Route::get('wishlist',[WishlistController::class , 'wishlist'])->name('wishlist');
Route::post('wishlist/store', [WishlistController::class , 'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart', [WishlistController::class , 'moveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete', [WishlistController::class , 'wishlistDelete'])->name('wishlist.delete');


//compare
Route::get('compare',[\App\Http\Controllers\Frontend\CompareController::class , 'compare'])->name('compare');
Route::post('compare/store', [\App\Http\Controllers\Frontend\CompareController::class , 'compareStore'])->name('compare.store');
Route::post('compare/move-to-cart', [\App\Http\Controllers\Frontend\CompareController::class , 'moveToCart'])->name('compare.move.cart');
Route::post('compare/delete', [\App\Http\Controllers\Frontend\CompareController::class , 'compareDelete'])->name('compare.delete');



//checkout
Route::get('checkout1' , [CheckoutController::class , 'checkout1'])->middleware('user') ->name('checkout1');
Route::post('checkout-first' , [CheckoutController::class , 'checkout1Store'])->middleware('user')->name('checkout1.store');
Route::post('checkout-two' , [CheckoutController::class , 'checkout2Store'])->middleware('user')->name('checkout2.store');
Route::post('checkout-three' , [CheckoutController::class , 'checkout3Store'])->middleware('user')->name('checkout3.store');
Route::get('checkout-store' , [CheckoutController::class , 'checkoutStore'])->middleware('user') ->name('checkout.store');



//complete order
Route::get('complete-stripe/{order}' , [CheckoutController::class , 'completeStripe'])->name('complete.stripe');
Route::get('complete-cash/{order}' , [CheckoutController::class , 'completeCashOnDelivery'])->name('complete.cash');


//shop
Route::get('shop' , [IndexController::class , 'shop'])->name('shop');
Route::post('shop-filter' , [IndexController::class , 'shopFilter'])->name('shop.filter');

//search
Route::get('autosearch' , [IndexController::class , 'autosearch'])->name('autosearch');
Route::get('search' , [IndexController::class , 'search' ])->name('search');


//about & contact
Route::get('about-us' , [IndexController::class , 'AboutUs'])->name('aboutus');
Route::get('contact-us' , [IndexController::class , 'Contactus'])->name('contactus');
Route::post('contact-us-message' , [IndexController::class , 'ContactUsForm'])->name('contactus.message');



//currency
Route::post('currency_load',[\App\Http\Controllers\Dashboard\CurrencyController::class , 'currencyLoad'])->name('currency.load');


Route::fallback(function () {
    return redirect()->route('not.found.page');
});


Route::get('/not-found', function () {
    return view('404');
})->name('not.found.page');

Route::get('otp' , function (){
    session()->flash('success', 'OTP code was sent successfully');
    return view('WebSite.auth.OtpValidation', ['success' => session('success')]);
});

Route::post('/email-verification-submit' , [IndexController::class , 'email_verification'])->name('email.verification');
Route::post('/resend-otp' , [IndexController::class , 'resend_otp'])->name('resend.otp');


//customer
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/',[IndexController::class , 'index'])->name('customer');
    Route::get('/dashboard',[IndexController::class , 'userDashboard'])->name('user.dashboard');
    Route::get('/order',[IndexController::class , 'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class , 'userAddress'])->name('user.address');
    Route::get('/account-details',[IndexController::class , 'userAccount'])->name('user.account');
    Route::post('/billing/address/{id}',[IndexController::class , 'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}',[IndexController::class , 'shippingAddress'])->name('shipping.address');
    Route::patch('/update/account/',[IndexController::class , 'updateAccount'])->name('update.account');
});


//admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class , 'index'])->name('admin');
    Route::get('/notifications/mark-all-read', [\App\Http\Controllers\Dashboard\DashboardController::class, 'markAllAsRead'])->name('notifications.markAllRead');

    Route::resource('Banners', BannerController::class);
    Route::resource('Categories', CategoryController::class);
    Route::resource('Brands', BrandController::class);
    Route::resource('Products', ProductController::class);
    Route::post('product-attribute/{id}' , [ProductController::class , 'addProductAttribute'])->name('product.attribute');
    Route::delete('product-attribute-delete/{id}' , [ProductController::class , 'deleteProductAttribute'])->name('product.attribute.delete');
    Route::post('category/{id}/child', [CategoryController::class , 'getChildByParentID']);
    Route::resource('Users', UserController::class);
    Route::resource('Coupons', CouponController::class);
    Route::resource('Shippings', ShippingController::class);
    Route::resource('Orders' , \App\Http\Controllers\Dashboard\OrderController::class );
    Route::post('order-status/{id}' , [\App\Http\Controllers\Dashboard\OrderController::class , 'orderStatus'])->name('order.status');
    Route::resource('Currency' , \App\Http\Controllers\Dashboard\CurrencyController::class);
    Route::resource('Settings' , \App\Http\Controllers\Dashboard\SettingsController::class);
    Route::get('smtp' , [\App\Http\Controllers\Dashboard\SettingsController::class , 'smtp'])->name('smtp');
    Route::post('smtp-update' , [\App\Http\Controllers\Dashboard\SettingsController::class , 'smtpUpdate'])->name('smtp.update');
    Route::resource('About' , \App\Http\Controllers\Dashboard\AboutController::class);
});



//vendor
Route::middleware(['auth', 'vendor'])->prefix('vendor')->group(function () {
    Route::get('/', [\App\Http\Controllers\Seller\ProductController::class , 'index'])->name('vendor');
    Route::resource('SellersProducts', \App\Http\Controllers\Seller\ProductController::class);
    Route::post('product-attribute/{id}' , [\App\Http\Controllers\Seller\ProductController::class , 'addProductAttribute'])->name('seller.product.attribute');
    Route::delete('product-attribute-delete/{id}' , [\App\Http\Controllers\Seller\ProductController::class , 'deleteProductAttribute'])->name('seller.product.attribute.delete');
    Route::resource('SellersOrders' , \App\Http\Controllers\Seller\OrderController::class );
    Route::post('order-status/{id}' , [\App\Http\Controllers\Seller\OrderController::class , 'orderStatus'])->name('seller.order.status');
});





require __DIR__.'/auth.php';
