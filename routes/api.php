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
        });

        Route::group(['prefix' => 'services'], function () {
            Route::get('options', 'Api\ProductController@options');
            Route::get('optional-options', 'Api\ProductController@optional_options');
            Route::post('new-product', 'Api\ProductController@create_product');
            Route::post('add-photo-product', 'Api\ProductController@add_photo_product');
            Route::post('add-video-product', 'Api\ProductController@add_video_product');
            Route::post('optional-product', 'Api\ProductController@create_optional');
            Route::post('search-product', 'Api\ProductController@search');

            Route::get('optional-options-ss', 'Api\Shared_SpacesController@show_optional_options');
            Route::post('new-shared-space', 'Api\Shared_SpacesController@create_shared_space');
            Route::post('add-photo-shared-space', 'Api\Shared_SpacesController@add_photo_shared_space');
            Route::post('add-video-shared-space', 'Api\Shared_SpacesController@add_video_shared_space');
            Route::post('optional-shared-space', 'Api\Shared_SpacesController@create_optional');

            Route::get('optional-options-p', 'Api\ProjectController@show_project_detail');
            Route::post('new-project', 'Api\ProjectController@create_project');
            Route::post('add-photo-project', 'Api\ProjectController@add_photo_project');
            Route::post('add-video-project', 'Api\ProjectController@add_video_project');
            Route::post('optional-project', 'Api\ProjectController@create_optional_project');
            Route::post('add-property', 'Api\ProjectController@add_property_project');
            Route::post('add-professional-group', 'Api\ProjectController@add_professional_group');
            Route::post('search-project', 'Api\ProjectController@search');

        });
    });
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
   
*/


});



Route::any('blog', function(Request $request){
    $Blog = \App\Models\Blog::find($request->input('id'));
    $prev = $Blog?$Blog->toArray():null;
    $status = 'ok';
    // Verificamos si hay una sesión iniciada y guardamos al usuario en la variable
    // Verificamos también que la solicitud se este realizando por POST
    if($user=auth()->user() && $request->isMethod('post')){
        // Comprobamos los permisos del usuario para el CRUD
        if($user->role===0){
            // Revisamos si nos solicitan la eliminación del Blog
            if($Blog && $request->input('delete'))
                // Enviamos una respuesta con el resultado de la operación
                return [ 'status'=>$Blog->delete()?$status:'failed', ];
            // En caso de no solicitar el delete sino de actualizar entonces actualizamos
            else if($Blog) $Blog->update($request->input());
            // Si el blog no existe, intentamos validar el formulario y crear un nuevo blog
            else if(!$Blog){
                $request->validate([
                    'title' => 'required|string',
                    'picture' => 'required|url',
                    'body' => 'required',
                    'autor' => 'exists:user,id|integer',
                ]);
                // Guardamos el nuevo Blog en una variable
                $Blog =  \App\Models\Blog::create($request->input());
            }
        }
    }
    // Regresamos una respuesta con los resultados de la operación anterior
    return [
        'status'=>$status, //Estatus de la operación
        'prev'=>$prev, // Valor anterior del blog (NULL en caso de ser nuevo)
        'data'=>$Blog, // El contenido actualizado o creado del blog
    ];
})->middleware('auth:api'); //Aplicamos el middleware de auth:api para validar la sesión