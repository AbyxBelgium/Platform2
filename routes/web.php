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
$FRONTEND_ROOT = "";
$APP_ROOT = "";

// Authentication
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// --- START OF BACKEND ROUTES ---

// Custom backend pages
Route::get($BACKEND_ROOT, 'Backend\DesktopController@show')->name('backend/index');

// Images
Route::get($BACKEND_ROOT . '/image/create', 'ImageController@create')->name('backend/image/create');
Route::post($BACKEND_ROOT . '/image', 'ImageController@store')->name('backend/image/store');
Route::get($BACKEND_ROOT . '/images', 'ImageController@index')->name('backend/image/index');
Route::get($BACKEND_ROOT . '/image/edit/{id}', 'ImageController@edit')->name('backend/image/edit');
Route::put($BACKEND_ROOT . '/image/{id}', 'ImageController@update')->name('backend/image/update');
Route::delete($BACKEND_ROOT . '/image/{id}', 'ImageController@destroy')->name('backend/image/destroy');

// Posts
Route::get($BACKEND_ROOT . '/post/create', 'PostController@create')->name('backend/post/create');
Route::post($BACKEND_ROOT . '/post', 'PostController@store')->name('backend/post/store');
Route::get($BACKEND_ROOT . '/posts', 'PostController@index')->name('backend/post/index');
Route::get($BACKEND_ROOT . '/post/edit/{id}', 'PostController@edit')->name('backend/post/edit');
Route::put($BACKEND_ROOT . '/post/{id}', 'PostController@update')->name('backend/post/update');
Route::delete($BACKEND_ROOT . '/post/{id}', 'PostController@destroy')->name('backend/post/destroy');

// Categories
Route::get($BACKEND_ROOT . '/category/create', 'CategoryController@create')->name('backend/category/create');
Route::post($BACKEND_ROOT . '/category', 'CategoryController@store')->name('backend/category/store');
Route::get($BACKEND_ROOT . '/categories', 'CategoryController@index')->name('backend/category/index');
Route::get($BACKEND_ROOT . '/category/edit/{id}', 'CategoryController@edit')->name('backend/category/edit');
Route::put($BACKEND_ROOT . '/category/{id}', 'CategoryController@update')->name('backend/category/update');
Route::delete($BACKEND_ROOT . '/category/{id}', 'CategoryController@destroy')->name('backend/category/destroy');

// Pages
Route::get($BACKEND_ROOT . '/page/create', 'PageController@create')->name('backend/page/create');
Route::post($BACKEND_ROOT . '/page/store', 'PageController@store')->name('backend/page/store');
Route::get($BACKEND_ROOT . '/pages', 'PageController@index')->name('backend/page/index');
Route::delete($BACKEND_ROOT . '/page/{id}', 'PageController@destroy')->name('backend/page/destroy');
Route::get($BACKEND_ROOT . '/page/edit/{id}', 'PageController@edit')->name('backend/page/edit');

// --- END OF BACKEND ROUTES ---

// --- START OF FRONTEND ROUTES ---

Route::get($FRONTEND_ROOT, 'Frontend\HomeController@show')->name('frontend/index');
Route::get($FRONTEND_ROOT . '/post/{id}', 'PostController@show')->name('post/show');
Route::get($FRONTEND_ROOT . '/category/{id}', 'CategoryController@show')->name('category/show');
Route::get($FRONTEND_ROOT . '/image/{id}', 'ImageController@show')->name('image/show');
Route::get($FRONTEND_ROOT . '/page/{id}', 'PageController@show')->name('page/show');

// --- END OF FRONTEND ROUTES ---

// --- START OF APP/EXTENSION ROUTING ---

Route::get($APP_ROOT . '/app/{app}/{route}', 'AppController@resolveRoute')->name('app/get');
Route::post($APP_ROOT . '/app/{app}/{route}', 'AppController@resolveRoute')->name('app/post');
Route::put($APP_ROOT . '/app/{app}/{route}', 'AppController@resolveRoute')->name('app/put');
Route::delete($APP_ROOT . '/app/{app}/{route}', 'AppController@resolveRoute')->name('app/delete');

// --- ENF OF APP ROUTING ---
