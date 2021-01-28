<?php

use App\Http\Controllers\Api\ApiAdminAuth;
use App\Http\Controllers\Api\ProductApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api', 'check_api_password']], function (){

    Route::post('admin/login', [ApiAdminAuth::class, 'login'])->name('api.login');

    Route::group(['middleware' => 'auth:admin_api'], function (){
        Route::post('admin/logout', [ApiAdminAuth::class, 'logout']);
        Route::post('products', [ProductApi::class, 'index']);

    });
});
