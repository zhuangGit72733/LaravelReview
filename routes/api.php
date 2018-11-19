<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('articles/list', 'Api\ArticlesController@index');

Route::get('articles/{id}', 'Api\ArticlesController@show');

Route::post('articles/store', 'Api\ArticlesController@store');

Route::post('articles/update', 'Api\ArticlesController@update');

Route::post('articles/delete', 'Api\ArticlesController@delete');