<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\Order;
use App\Storage;

class DbViewController extends Controller
{
    public function employees()
    {
        $employees = Employee::select()->get();
        $keys = [
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
        ];

        return view('database', [
            'tableName' => 'employees',
            'keys' => $keys,
            'data' => $employees
        ]);
    }

    public function customers()
    {
        $customers = Customer::all();
        $keys = ['id', 'discord_name', 'discord_id', 'tycoon_name', 'tycoon_id'];

        return view('database', [
            'tableName' => 'customers',
            'keys' => $keys,
            'data' => $customers
        ]);
    }

    public function orders()
    {
        $orders = Order::select()->get();
        $keys = [
            'id',
            'created_at',
            'updated_at',
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
        ];

        return view('database', [
            'tableName' => 'orders',
            'keys' => $keys,
            'data' => $orders
        ]);
    }

    public function storages()
    {
        $storages = Storage::select()->get();
        $keys = ['id', 'name', 'fee', 'faction'];

        return view('database', [
            'tableName' => 'storages',
            'keys' => $keys,
            'data' => $storages
        ]);
    }
}