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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('employees')->group(function() {
    Route::get('', 'DbViewController@employees');
});

Route::prefix('customers')->group(function() {
    Route::get('', 'CustomersController@all');
    Route::post('new', 'CustomersController@new');
    Route::get('{discord_id}', 'CustomersController@get');
});

Route::prefix('orders')->group(function() {
    Route::get('', 'OrdersController@all');
    Route::get('queued', 'OrdersController@queued');
    Route::get('pending', 'OrdersController@pending');
    Route::get('completed', 'OrdersController@completed');
    Route::post('new', 'OrdersController@new')->middleware('exists:customer', 'valid:amount', 'exists:storage');

    Route::group(['prefix' => '{order_id}', 'middleware' => 'exists:order'], function() {
        Route::get('', 'OrdersController@get');
        Route::patch('assign', 'OrdersController@assign')->middleware('exists:employee');
        Route::patch('progress', 'OrdersController@progress')->middleware('valid:progress');
        Route::patch('collection', 'OrdersController@collection');
        Route::patch('complete', 'OrdersController@complete');
        Route::patch('edit', 'OrdersController@edit')->middleware('valid:amount', 'exists:storage');
        Route::patch('cancel', 'OrdersController@cancel');
    });
});

Route::prefix('storages')->group(function() {
    Route::get('', 'StoragesController@all');
});