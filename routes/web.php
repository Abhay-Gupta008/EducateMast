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


Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('dashboard', 'Admin\DashboardController@show')->name('dashboard.show');
    Route::get('telescope', function() {
        return response()->redirectTo('/telescope');
    })->name('telescope.show');

    Route::post('add/author/{user:username}', 'Admin\AdminController@store')->name('new-author.store');
});

Route::resource('categories', 'CategoryController', ['except' => ['show', 'edit', 'update', 'destroy']]);

Route::post('categories/{id}', 'CategoryController@restore')->name('categories.restore');

Route::get('categories/destroyed', 'CategoryController@destroyed')->name('categories.destroyed');

Route::delete('categories/{category:slug}', 'CategoryController@destroy')->name('categories.destroy');

Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

Route::get('categories/{category:slug}/edit', 'CategoryController@edit')->name('categories.edit');

Route::patch('categories/{category:slug}', 'CategoryController@update')->name('categories.update');

Route::resource('posts', 'PostController', ['except' => ['show', 'index', 'edit', 'update', 'destroy']]);

Route::get('/', 'PostController@index')->name('posts.index');

Route::get('posts/{category:slug}/{post:slug}', 'PostController@show')->name('posts.show');

Route::get('posts/{category:slug}/{post:slug}/edit', 'PostController@edit')->name('posts.edit');

Route::patch('posts/{category:slug}/{post:slug}', 'PostController@update')->name('posts.update');

Route::delete('posts/{category:slug}/{post:slug}', 'PostController@destroy')->name('posts.destroy');

Route::get('posts/destroyed', 'PostController@destroyed')->name('posts.destroyed');

Route::post('posts/{id}', 'PostController@restore')->name('posts.restore');

Route::get('profiles/{user:username}', 'ProfileController@show')->name('profiles.show');

Route::get('profiles/{user:username}/edit', 'ProfileController@edit')->name('profiles.edit');

Route::patch('profiles/{user:username}', 'ProfileController@update')->name('profiles.update');

Route::get('author-apply', "Misc\AuthorFormController@show")->name('author-form.show');
Route::get('author-apply/requirements', 'Misc\AuthorFormController@index')->name('author-form.index');
Route::post('author-apply', "Misc\AuthorFormController@store")->name('author-form.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test/{user}', 'Api\UserSearchController@search');

//Route::get('/users/search/{user}', 'Api\UserSearchController@search');
