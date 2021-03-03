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

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('/users')->group(function() {
        Route::get('', 'UserController@getUsers');
        Route::post('', 'UserController@addUser');
        Route::prefix('/employees')->group(function() {
            Route::get('', 'UserController@getAllEmployees');
            Route::get('/active', 'UserController@getActiveEmployees');
            Route::get('/inactive', 'UserController@getInactiveEmployees');
        });
        Route::prefix('/{user_identifier}')->group(function() {
            Route::get('', 'UserController@getUsers');
            Route::get('/hire', 'UserController@hireUser');
            Route::get('/fire', 'UserController@fireUser');
            Route::get('/promote', 'UserController@promoteUser');
            Route::get('/demote', 'UserController@demoteUser');
        });
    });
});
