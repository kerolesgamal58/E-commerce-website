<?php

use App\Http\Controllers\Company\CompanyAuthController;
use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#####################################################

//define('PAGINATION_COUNT', 12);
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function () {




        Route::group(['prefix' => 'company'], function (){
            Route::get('login', [CompanyAuthController::class, 'getLoginPage'])->name('company.login')->middleware('guest:web');
            Route::post('login', [CompanyAuthController::class, 'doLogin'])->name('company.dologin')->middleware('guest:web');
            Route::get('signin', [CompanyAuthController::class, 'getSignInPage'])->name('company.signin');
            Route::post('signin', [CompanyAuthController::class, 'doSignIn']);
            Route::get('forgot_password', [CompanyAuthController::class, 'getForgotPasswordPage'])->name('company.forgot_password');
            Route::post('forgot_password', [CompanyAuthController::class, 'doForgotPassword']);

            Route::group(['middleware' => ['auth:web', 'verified']], function (){
                Route::get('/', [CompanyController::class, 'index'])->name('company.dashboard');
                Route::get('verify/{id}/{hash}', [CompanyAuthController::class, 'verify_email'])->name('verification.verify')->middleware('signed');
                Route::get('verification_message', [CompanyAuthController::class, 'verification_message'])->name('verification.notice');
                Route::get('verification_message_resend', [CompanyAuthController::class, 'verification_message_resend'])->name('verification.send')->middleware('throttle:6,1');
                Route::get('logout', [CompanyAuthController::class, 'logout'])->name('company.logout');
                Route::post('notification/read', [CompanyController::class, 'markAsRead'])->name('company.mark_notification_as_read');
                Route::post('notification/check', [CompanyController::class, 'checkNotification'])->name('company.notification.check');

            });
        });


    });
