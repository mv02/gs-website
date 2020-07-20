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
    Route::get('', 'DbViewController@customers');
});

Route::prefix('orders')->group(function() {
    Route::get('', 'DbViewController@orders');
    Route::post('new', 'OrdersController@new')->middleware('exists:customer', 'valid:amount', 'exists:storage');

    Route::group(['prefix' => '{order_id}', 'middleware' => 'exists:order'], function() {
        Route::get('', 'OrdersController@get');
        Route::patch('assign', 'OrdersController@assign')->middleware('exists:employee');
        Route::patch('progress', 'OrdersController@progress')->middleware('valid:progress');
        Route::patch('collection', 'OrdersController@collection');
        Route::patch('complete', 'OrdersController@complete');
        Route::prefix('edit')->group(function() {
            Route::patch('priority', 'OrdersController@editPriority');
            Route::patch('amount', 'OrdersController@editAmount')->middleware('valid:amount');
            Route::patch('discount', 'OrdersController@editDiscount');
            Route::patch('storage', 'OrdersController@editStorage')->middleware('exists:storage');
        });
        Route::patch('cancel', 'OrdersController@cancel');
    });
});

Route::prefix('storages')->group(function() {
    Route::get('', 'DbViewController@storages');
});