<?php

use Illuminate\Support\Facades\Route;
use App\Employee;
use App\Customer;
use App\Order;
use App\Storage;

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

Route::get('/employees', function() {
    $employees = Employee::select()->get();

    return view('database', [
        'tableName' => 'employees',
        'keys' => [
            'id',
            'name',
            'discord_id',
            'tycoon_id',
            'rank',
            'trainee',
            'joined_at',
            'active',
            'trailer',
            'faction',
            'email',
            'management_rank'
        ],
        'data' => $employees
    ]);
});

Route::get('customers', function() {
    $customers = Customer::all();

    return view('database', [
        'tableName' => 'customers',
        'keys' => ['id', 'discord_name', 'discord_id', 'tycoon_name', 'tycoon_id'],
        'data' => $customers
    ]);
});

Route::get('orders', function() {
    $orders = Order::select()->get();

    return view('database', [
        'tableName' => 'orders',
        'keys' => [
            'id',
            'timestamp',
            'priority',
            'status',
            'progress',
            'customer_id',
            'worker_id',
            'product_name',
            'price_each',
            'amount',
            'discount',
            'storage_id'
        ],
        'data' => $orders
    ]);
});

Route::get('storages', function() {
    $storages = Storage::select()->get();

    return view('database', [
        'tableName' => 'storages',
        'keys' => ['id', 'name', 'fee', 'faction'],
        'data' => $storages
    ]);
});

