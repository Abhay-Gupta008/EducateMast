<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth', 'staff'], 'prefix' => 'admin'], function() {
    Route::get('dashboard', function() {
    });
});

Route::resource('categories', 'CategoryController', ['except' => ['show', 'edit', 'update', 'destroy']]);

Route::post('categories/{id}', 'CategoryController@restore')->name('categories.restore');

Route::get('categories/destroyed', 'CategoryController@destroyed')->name('categories.destroyed');

Route::delete('categories/{category:slug}', 'CategoryController@destroy')->name('categories.destroy');

Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

Route::get('categories/{category:slug}/edit', 'CategoryController@edit')->name('categories.edit');

Route::patch('categories/{category:slug}', 'CategoryController@update')->name('categories.update');

Route::resource('posts', 'PostController', ['except' => ['show', 'index', 'edit', 'update']]);

Route::get('/', 'PostController@index')->name('posts.index');

Route::get('posts/{category:slug}/{post:slug}', 'PostController@show')->name('posts.show');

Route::get('posts/{category:slug}/{post:slug}/edit', 'PostController@edit')->name('posts.edit');

Route::patch('posts/{category:slug}/{post:slug}', 'PostController@update')->name('posts.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

