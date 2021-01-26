<?php

use App\Http\Controllers\Admin\AdminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\MallController;
use App\Http\Controllers\Admin\ManufactureController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TradeMarkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\WeightController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function (){

    Route::group(['prefix' => 'admin'], function (){
        Route::get('/login', [AdminAuth::class, 'login'])->name('admin.login');
        Route::post('/login', [AdminAuth::class, 'dologin']);
        Route::get('/forgot_password', [AdminAuth::class, 'forgot_password'])->name('admin.forgot_password');
        Route::post('/forgot_password', [AdminAuth::class, 'forgot_password_post']);
        Route::get('/reset_password/{token}', [AdminAuth::class, 'reset_password'])->name('admin.reset_password');
        Route::post('/reset_password/{token}', [AdminAuth::class, 'reset_password_post']);
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function (){
        Route::get('/', [AdminAuth::class, 'index'])->name('admin.dashboard');
        Route::get('/settings', [SettingController::class, 'index_settings'])->name('admin.settings');
        Route::post('/settings', [SettingController::class, 'post_settings']);
        Route::any('logout', [AdminAuth::class, 'logout'])->name('admin.logout');

        Route::group(['prefix' => 'admins'], function(){
            Route::get('/', [AdminController::class, 'index'])->name('admin.showadmins');
            Route::get('create', [AdminController::class, 'create'])->name('admin.create');
            Route::post('store', [AdminController::class, 'store'])->name('admin.store');
            Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
            Route::post('delete', [AdminController::class, 'deleteselected'])->name('admin.delete.post');
        });

        Route::group(['prefix' => 'users'], function(){
            Route::get('/', [UserController::class, 'index'])->name('user.showusers');
            Route::get('/user', [UserController::class, 'index_user'])->name('user.showlevel.user');
            Route::get('/company', [UserController::class, 'index_company'])->name('user.showlevel.company');
            Route::get('/vendor', [UserController::class, 'index_vendor'])->name('user.showlevel.vendor');
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::post('store', [UserController::class, 'store'])->name('user.store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
            Route::post('delete', [UserController::class, 'deleteselected'])->name('user.delete.post');
        });

        Route::group(['prefix' => 'countries'], function(){
            Route::get('/', [CountriesController::class, 'index'])->name('country.showcountries');
            Route::get('create', [CountriesController::class, 'create'])->name('country.create');
            Route::post('store', [CountriesController::class, 'store'])->name('country.store');
            Route::get('edit/{id}', [CountriesController::class, 'edit'])->name('country.edit');
            Route::post('update/{id}', [CountriesController::class, 'update'])->name('country.update');
            Route::get('delete/{id}', [CountriesController::class, 'delete'])->name('country.delete');
            Route::post('delete', [CountriesController::class, 'deleteselected'])->name('country.delete.post');
        });

        Route::group(['prefix' => 'cities'], function(){
            Route::get('/', [CityController::class, 'index'])->name('city.showcities');
            Route::get('create', [CityController::class, 'create'])->name('city.create');
            Route::post('store', [CityController::class, 'store'])->name('city.store');
            Route::get('edit/{id}', [CityController::class, 'edit'])->name('city.edit');
            Route::post('update/{id}', [CityController::class, 'update'])->name('city.update');
            Route::get('delete/{id}', [CityController::class, 'delete'])->name('city.delete');
            Route::post('delete', [CityController::class, 'deleteselected'])->name('city.delete.post');
        });

        Route::group(['prefix' => 'states'], function(){
            Route::get('/', [StateController::class, 'index'])->name('state.showstates');
            Route::get('create', [StateController::class, 'create'])->name('state.create');
            Route::post('store', [StateController::class, 'store'])->name('state.store');
            Route::get('edit/{id}', [StateController::class, 'edit'])->name('state.edit');
            Route::post('get_cities', [StateController::class, 'get_cities'])->name('state.get_cities');
            Route::post('update/{id}', [StateController::class, 'update'])->name('state.update');
            Route::get('delete/{id}', [StateController::class, 'delete'])->name('state.delete');
            Route::post('delete', [StateController::class, 'deleteselected'])->name('state.delete.post');
        });

        Route::group(['prefix' => 'departments'], function(){
            Route::get('/', [DepartmentController::class, 'index'])->name('department.showdepartments');
            Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
            Route::post('store', [DepartmentController::class, 'store'])->name('department.store');
            Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
            Route::post('update/{id}', [DepartmentController::class, 'update'])->name('department.update');
            Route::get('delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
        });

        Route::group(['prefix' => 'trademarks'], function(){
            Route::get('/', [TradeMarkController::class, 'index'])->name('trademark.showtrademarks');
            Route::get('create', [TradeMarkController::class, 'create'])->name('trademark.create');
            Route::post('store', [TradeMarkController::class, 'store'])->name('trademark.store');
            Route::get('edit/{id}', [TradeMarkController::class, 'edit'])->name('trademark.edit');
            Route::post('get_cities', [TradeMarkController::class, 'get_cities'])->name('trademark.get_cities');
            Route::post('update/{id}', [TradeMarkController::class, 'update'])->name('trademark.update');
            Route::get('delete/{id}', [TradeMarkController::class, 'delete'])->name('trademark.delete');
            Route::post('delete', [TradeMarkController::class, 'deleteselected'])->name('trademark.delete.post');
        });

        Route::group(['prefix' => 'manufactures'], function(){
            Route::get('/', [ManufactureController::class, 'index'])->name('manufacture.showmanufactures');
            Route::get('create', [ManufactureController::class, 'create'])->name('manufacture.create');
            Route::post('store', [ManufactureController::class, 'store'])->name('manufacture.store');
            Route::get('edit/{id}', [ManufactureController::class, 'edit'])->name('manufacture.edit');
            Route::post('update/{id}', [ManufactureController::class, 'update'])->name('manufacture.update');
            Route::get('delete/{id}', [ManufactureController::class, 'delete'])->name('manufacture.delete');
            Route::post('delete', [ManufactureController::class, 'deleteselected'])->name('manufacture.delete.post');
        });

        Route::group(['prefix' => 'shippings'], function(){
            Route::get('/', [ShippingController::class, 'index'])->name('shipping.showshippings');
            Route::get('create', [ShippingController::class, 'create'])->name('shipping.create');
            Route::post('store', [ShippingController::class, 'store'])->name('shipping.store');
            Route::get('edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
            Route::post('update/{id}', [ShippingController::class, 'update'])->name('shipping.update');
            Route::get('delete/{id}', [ShippingController::class, 'delete'])->name('shipping.delete');
            Route::post('delete', [ShippingController::class, 'deleteselected'])->name('shipping.delete.post');
        });

        Route::group(['prefix' => 'malls'], function(){
            Route::get('/', [MallController::class, 'index'])->name('mall.showmalls');
            Route::get('create', [MallController::class, 'create'])->name('mall.create');
            Route::post('store', [MallController::class, 'store'])->name('mall.store');
            Route::get('edit/{id}', [MallController::class, 'edit'])->name('mall.edit');
            Route::post('update/{id}', [MallController::class, 'update'])->name('mall.update');
            Route::get('delete/{id}', [MallController::class, 'delete'])->name('mall.delete');
            Route::post('delete', [MallController::class, 'deleteselected'])->name('mall.delete.post');
        });

        Route::group(['prefix' => 'colors'], function(){
            Route::get('/', [ColorController::class, 'index'])->name('color.showcolors');
            Route::get('create', [ColorController::class, 'create'])->name('color.create');
            Route::post('store', [ColorController::class, 'store'])->name('color.store');
            Route::get('edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
            Route::post('update/{id}', [ColorController::class, 'update'])->name('color.update');
            Route::get('delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
            Route::post('delete', [ColorController::class, 'deleteselected'])->name('color.delete.post');
        });

        Route::group(['prefix' => 'sizes'], function(){
            Route::get('/', [SizeController::class, 'index'])->name('size.showsizes');
            Route::get('create', [SizeController::class, 'create'])->name('size.create');
            Route::post('store', [SizeController::class, 'store'])->name('size.store');
            Route::get('edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
            Route::post('update/{id}', [SizeController::class, 'update'])->name('size.update');
            Route::get('delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
            Route::post('delete', [SizeController::class, 'deleteselected'])->name('size.delete.post');
        });

        Route::group(['prefix' => 'weights'], function(){
            Route::get('/', [WeightController::class, 'index'])->name('weight.showweights');
            Route::get('create', [WeightController::class, 'create'])->name('weight.create');
            Route::post('store', [WeightController::class, 'store'])->name('weight.store');
            Route::get('edit/{id}', [WeightController::class, 'edit'])->name('weight.edit');
            Route::post('update/{id}', [WeightController::class, 'update'])->name('weight.update');
            Route::get('delete/{id}', [WeightController::class, 'delete'])->name('weight.delete');
            Route::post('delete', [WeightController::class, 'deleteselected'])->name('weight.delete.post');
        });

        Route::group(['prefix' => 'products'], function(){
            Route::get('/', [ProductController::class, 'index'])->name('product.showproducts');
            Route::get('create', [ProductController::class, 'create'])->name('product.create');
            Route::post('store', [ProductController::class, 'store'])->name('product.store');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
            Route::post('delete', [ProductController::class, 'deleteselected'])->name('product.delete.post');

            Route::post('load_size_weight', [ProductController::class, 'load_size_weight'])->name('load.size.weight');
            Route::post('copy/{id}', [ProductController::class, 'copy'])->name('product.copy');
            Route::post('save_and_continue/{id}', [ProductController::class, 'saveAndContinue'])->name('product.save_and_continue');
            Route::post('edit_main_image/{id}', [ProductController::class, 'editMainImage'])->name('product.edit_main_image');
            Route::post('edit_sub_images/{id}', [ProductController::class, 'editSubImages'])->name('product.edit_sub_images');
            Route::post('delete_sub_images', [ProductController::class, 'deleteSubImages'])->name('product.delete_sub_image');

        });

    });
});

