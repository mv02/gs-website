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

Route::prefix('/users')->middleware('auth:sanctum')->group(function() {
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

Route::prefix('/orders')->middleware('auth:sanctum')->group(function() {
    Route::get('', 'OrderController@getOrders');
    Route::post('', 'OrderController@addOrder');
    Route::get('/active', 'OrderController@getActiveOrders');
    Route::get('/queued', 'OrderController@getQueuedOrders');
    Route::get('/in-progress', 'OrderController@getInProgressOrders');
    Route::get('/completed', 'OrderController@getCompletedOrders');
    Route::get('/delivered', 'OrderController@getDeliveredOrders');
    Route::prefix('/{order_id}')->group(function() {
        Route::get('', 'OrderController@getOrders');
        Route::patch('/grinder/{grinder_discord_id}', 'OrderController@setOrderGrinder');
        Route::patch('/progress/{progress}', 'OrderController@setOrderProgress');
        Route::patch('/status', 'OrderController@nextOrderStatus');
        Route::patch('/edit', 'OrderController@editOrderData');
        Route::patch('/cancel', 'OrderController@cancelOrder');
        Route::patch('/reset', 'OrderController@resetOrder');
    });
});

Route::prefix('/cargoes')->middleware('auth:sanctum')->group(function() {
    Route::get('', 'CargoController@getCargoes');
    Route::post('', 'CargoController@addCargo');
    Route::prefix('/{cargo_identifier}')->group(function() {
        Route::get('', 'CargoController@getCargoes');
        Route::patch('/edit', 'CargoController@editCargo');
        Route::delete('', 'CargoController@deleteCargo');
    });
});
