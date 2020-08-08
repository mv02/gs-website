<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\Order;
use App\Storage;
use App\Cargo;

class ApiTestController extends Controller
{
    public function show()
    {
        return view('home', [
            'employees' => Employee::all(),
            'customers' => Customer::all(),
            'orders' => Order::all(),
            'storages' => Storage::all(),
            'cargoes' => Cargo::all()
        ]);
    }

    public function purgeEmployees()
    {
        Employee::truncate();
        return redirect('/');
    }
    public function purgeCustomers()
    {
        Customer::truncate();
        return redirect('/');
    }
    public function purgeOrders()
    {
        Order::truncate();
        return redirect('/');
    }
    public function purgeStorages()
    {
        Storage::truncate();
        return redirect('/');
    }
    public function purgeCargoes()
    {
        Cargo::truncate();
        return redirect('/');
    }
}
