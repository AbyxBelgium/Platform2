<?php

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

$BACKEND_ROOT = "/backend";

// Authentication
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Custom backend pages
Route::get($BACKEND_ROOT, 'DesktopController@show')->name('backend/index');

// Images
// TODO modify to use correct backend and frontend path
Route::resource('image', 'ImageController');

// Posts
Route::get('/post/{id}', 'PostController@show')->name('post/show');
Route::get($BACKEND_ROOT . '/post/create', 'PostController@create')->name('backend/post/create');
Route::post($BACKEND_ROOT . '/post', 'PostController@store')->name('backend/post/store');
Route::get($BACKEND_ROOT . '/posts', 'PostController@index')->name('backend/post/index');
Route::get($BACKEND_ROOT . '/post/edit/{id}', 'PostController@edit')->name('backend/post/edit');

// Categories
Route::get('/category/{id}', 'CategoryController@show')->name('category/show');
Route::get($BACKEND_ROOT . '/category/create', 'CategoryController@create')->name('backend/category/create');
Route::post($BACKEND_ROOT . '/category', 'CategoryController@store')->name('backend/category/store');
Route::get($BACKEND_ROOT . '/categories', 'CategoryController@index')->name('backend/category/index');
Route::get($BACKEND_ROOT . '/category/edit/{id}', 'CategoryController@edit')->name('backend/category/edit');
