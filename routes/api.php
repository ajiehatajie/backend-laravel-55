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

Route::prefix('v1')->namespace('api\v1')->group(function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    });

    Route::get('post',['uses'=>'BLogController@index']);
    Route::get('post/{slug}',['uses'=>'BLogController@show'])->where('slug','[0-9A-Za-z\-]+');
    Route::get('article/{slug}',['uses'=>'BLogController@show'])->where('slug','[0-9A-Za-z\-]+');

    //Route::get('post/',['uses'=>'BLogController@search'])->where('slug','[0-9A-Za-z\-]+');


    Route::get('category',['uses'=>'CategoryController@index']);

});
