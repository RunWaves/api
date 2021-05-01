<?php

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

Route::group([
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::group([
        'prefix' => 'users',
        'middleware' => ['web']
    ], function () {
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::get('login/{provider}', 'UserController@redirect');
        Route::get('login/{provider}/callback','UserController@callBack');
    });
});
