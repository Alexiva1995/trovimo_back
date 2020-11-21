<?php

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
Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('email-verify', 'AuthController@verify_email');
    Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });


    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('update-coin', 'ConfigController@update_coin');
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('recommendation', 'Api\UserController@recommendation');

        Route::group(['prefix' => 'services'], function () {
            Route::get('options', 'Api\ProductController@options');
            Route::post('new-product', 'Api\ProductController@create_product');
            Route::post('add-photo-product', 'Api\ProductController@Add_photo_product');
            Route::post('add-video-product', 'Api\ProductController@Add_video_product');
            Route::post('add-service-product', 'Api\ProductController@Add_service_product');
            Route::post('add-reference-point', 'Api\ProductController@Add_reference_point');
        });
    });
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
   
*/


});