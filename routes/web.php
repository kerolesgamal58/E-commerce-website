<?php

use App\Http\Controllers\Customer\CustomerAuth;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#####################################################

define('PAGINATION_COUNT', 12);
define('PAGINATION_NOTIFICATION', 6);
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function () {

        Route::get('/', function () {
            return view('frontend.index');
        })->name('homepage');

        Route::get('login', [CustomerAuth::class, 'getLoginPage'])->name('customer.login');
        Route::post('login', [CustomerAuth::class, 'doLogin']);
        Route::get('signin', [CustomerAuth::class, 'getSignInPage'])->name('customer.signin');
        Route::post('signin', [CustomerAuth::class, 'doSignIn']);
        Route::get('verify/{token}/{email}', [CustomerAuth::class, 'verify_email'])->name('customer.verify');
        Route::get('verification_message', [CustomerAuth::class, 'verification_message'])->name('customer.verification_message');

        Route::group(['middleware' => 'auth:customer'], function (){
            Route::get('logout', [CustomerAuth::class, 'logout'])->name('customer.logout');

            Route::group(['prefix' => 'shop'], function(){
                Route::get('/', [CustomerController::class, 'getShopPage'])->name('customer.shop_page');
                Route::get('product/{id}', [CustomerController::class, 'getProductPage'])->name('customer.product.page');
                Route::post('add_to_cart/product/{id}', [CustomerController::class, 'addToCart'])->name('customer.add_to_cart');
                Route::get('cart', [CustomerController::class, 'getCart'])->name('customer.get_cart');
                Route::get('product/delete/{id}', [CustomerController::class, 'deleteProductFromCart'])->name('customer.delete_product');
                Route::post('product/update', [CustomerController::class, 'updateCart'])->name('customer.update_cart');
                Route::get('checkout', [CustomerController::class, 'getCheckout'])->name('customer.get_checkout');
                Route::post('get_cities', [CustomerController::class, 'getCities'])->name('customer.get_cities');
                Route::post('get_shipping_companies', [CustomerController::class, 'getShippingCompanies'])->name('customer.get_shipping_companies');

                Route::post('order', [OrderController::class, 'order'])->name('customer.order');
                Route::get('orders', [OrderController::class, 'getOrders'])->name('customer.get_orders');
                Route::get('order/delete/{id}', [OrderController::class, 'deleteOrder'])->name('customer.order.delete');
            });


        });
    });
