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

// User Routes
Route::post('login', 'UserController@login');

Route::post('/products/{product}/attach/{user}', 'ProductController@attach');
Route::post('/products/{product}/detach/{user}', 'ProductController@detach');
Route::get('/user/{user}/products', 'ProductController@viewAssigned');

// Product Routes
Route::apiResource('products', 'ProductController')->middleware('auth:api');
Route::post('products/{product}/upload', 'ProductPhotoController@store')->middleware('auth:api');
