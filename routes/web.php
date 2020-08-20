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

Route::get('db', 'ApiTestController@show');
Route::get('', 'HomeController@show');
Route::prefix('purge')->group(function() {
    Route::get('employees', 'ApiTestController@purgeEmployees');
    Route::get('customers', 'ApiTestController@purgeCustomers');
    Route::get('orders', 'ApiTestController@purgeOrders');
    Route::get('storages', 'ApiTestController@purgeStorages');
    Route::get('cargoes', 'ApiTestController@purgeCargoes');
});
Route::prefix('delete')->group(function() {
    Route::get('employee/{id}', 'ApiTestController@deleteEmployee');
    Route::get('customer/{id}', 'ApiTestController@deleteCustomer');
    Route::get('order/{id}', 'ApiTestController@deleteOrder');
    Route::get('storage/{id}', 'ApiTestController@deleteStorage');
    Route::get('cargo/{id}', 'ApiTestController@deleteCargo');
});

Route::prefix('employees')->group(function() {
    Route::get('', 'EmployeesController@all');
    Route::post('new', 'EmployeesController@new');
    Route::group(['prefix' => '{discord_id}', 'middleware' => 'exists:employee'], function() {
        Route::get('', 'EmployeesController@get');
        Route::patch('promote', 'EmployeesController@promote');
        Route::patch('trainee', 'EmployeesController@trainee');
        Route::patch('status', 'EmployeesController@status');
        Route::patch('trailer', 'EmployeesController@trailer');
        Route::patch('faction', 'EmployeesController@faction');
    });
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
    Route::get('in-progress', 'OrdersController@inProgress');
    Route::get('pending-collection', 'OrdersController@pendingCollection');
    Route::get('completed', 'OrdersController@completed');
    Route::post('new', 'OrdersController@new')->middleware('exists:customer', 'valid:amount', 'exists:storage');

    Route::group(['prefix' => '{order_id}', 'middleware' => 'exists:order'], function() {
        Route::get('', 'OrdersController@get');
        Route::patch('assign', 'OrdersController@assign')->middleware('exists:employee');
        Route::patch('unassign', 'OrdersController@unassign');
        Route::patch('progress', 'OrdersController@progress')->middleware('valid:progress');
        Route::patch('collection', 'OrdersController@collection');
        Route::patch('complete', 'OrdersController@complete');
        Route::patch('edit', 'OrdersController@edit')->middleware('valid:amount', 'exists:storage');
        Route::patch('cancel', 'OrdersController@cancel');
    });
});

Route::prefix('storages')->group(function() {
    Route::get('', 'StoragesController@all');
    Route::get('{identifier}', 'StoragesController@get');
});

Route::prefix('prices')->group(function() {
    Route::get('', 'CargoesController@all');
    Route::get('{identifier}', 'CargoesController@get');
});