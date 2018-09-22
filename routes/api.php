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

// API Token management
Route::post('login', 'API\PassportController@login');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('get-details', 'API\PassportController@getDetails');
});

// Custom API routes
Route::get('/system-resources', 'Api\SystemResourceController@show');

// Extensions
Route::get('/extension/{appName}/{extensionName}', 'Api\ExtensionController@extensionView');
Route::get('/extension/{appName}/{extensionName}/settings', 'Api\ExtensionController@extensionSettings');

// Posts
Route::get('/posts', 'PostController@index')->name('post/index');
