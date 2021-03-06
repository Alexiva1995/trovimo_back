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
    Route::post('login-with-register', 'AuthController@login_with_register');
    Route::post('register', 'AuthController@register');
    Route::post('email-verify', 'AuthController@verify_email');
    Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });


    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('update-coin', 'ConfigController@update_coin');
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('recommendation', 'Api\UserController@recommendation');

        Route::group(['prefix' => 'user'], function () {
            Route::post('update', 'Api\UserController@update');
            Route::post('show-user-listings', 'Api\UserController@show_user_listings');
            Route::post('show-user-activity', 'Api\UserController@show_user_activity');
        });

        Route::group(['prefix' => 'services'], function () {
            Route::post('favorite', 'Api\UserController@favorite');
            Route::post('contact', 'Api\UserController@contact');

            Route::get('options', 'Api\ProductController@options');
            Route::get('optional-options', 'Api\ProductController@optional_options');
            Route::post('new-product', 'Api\ProductController@create_product');
            Route::post('add-photo-product', 'Api\ProductController@add_photo_product');
            Route::post('add-video-product', 'Api\ProductController@add_video_product');
            Route::post('update-video-product', 'Api\ProductController@update_video_product');
            Route::post('optional-product', 'Api\ProductController@create_optional');
            Route::post('search-product', 'Api\ProductController@search');
            Route::post('show-product', 'Api\ProductController@show');

            Route::get('optional-options-ss', 'Api\Shared_SpacesController@show_optional_options');
            Route::post('new-shared-space', 'Api\Shared_SpacesController@create_shared_space');
            Route::post('add-photo-shared-space', 'Api\Shared_SpacesController@add_photo_shared_space');
            Route::post('add-video-shared-space', 'Api\Shared_SpacesController@add_video_shared_space');
            Route::post('optional-shared-space', 'Api\Shared_SpacesController@create_optional');
            Route::post('show-shared-space', 'Api\Shared_SpacesController@show');

            Route::get('optional-options-p', 'Api\ProjectController@show_project_detail');
            Route::post('new-project', 'Api\ProjectController@create_project');
            Route::post('add-photo-project', 'Api\ProjectController@add_photo_project');
            Route::post('add-video-project', 'Api\ProjectController@add_video_project');
            Route::post('optional-project', 'Api\ProjectController@create_optional_project');
            Route::post('add-property', 'Api\ProjectController@add_property_project');
            Route::post('add-professional-group', 'Api\ProjectController@add_professional_group');
            Route::post('search-project', 'Api\ProjectController@search');
            Route::post('show-project', 'Api\ProjectController@show');

            Route::post('search-expert', 'Api\ExpertController@search');
            Route::post('create-expert-profile', 'Api\ExpertController@create_expert_profile');
            Route::post('add-photo-expert-profile', 'Api\ExpertController@add_photo_expert_profile');

        });
    });
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

*/


});


/*
Para las busquedas no se usaran URL amigables
· Titulo ?title=Modern+Artic
· Tipos ?types=kitchen,living
· Estilos ?styles=modern,rustic
· Colores ?colors=red,blue,green
· Etiquetas ?tags=room,bathroom
*/
Route::resource('blogs', 'Admin\BlogController');
Route::resource('users_experiences', 'Api\UsersExperienceController');
