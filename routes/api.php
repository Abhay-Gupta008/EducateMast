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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users/search/{user}', 'Api\UserSearchController@search')->middleware('auth:api');

Route::post('admin/add/author/{user:username}', 'Admin\AdminController@authorStore')->middleware('auth:api');

Route::post('admin/add/trusted/{user:username}', 'Admin\AdminController@trustedStore')->middleware('auth:api');

Route::post('admin/add/admin/{user:username}', 'Admin\AdminController@adminStore')->middleware('auth:api');
