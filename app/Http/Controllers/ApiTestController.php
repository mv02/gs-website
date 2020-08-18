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
        return view('db', [
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

    public function deleteEmployee(Request $request)
    {
        Employee::find($request->id)->delete();
        return redirect('/');
    }
    public function deleteCustomer(Request $request)
    {
        Customer::find($request->id)->delete();
        return redirect('/');
    }
    public function deleteOrder(Request $request)
    {
        Order::find($request->id)->delete();
        return redirect('/');
    }
    public function deleteStorage(Request $request)
    {
        Storage::find($request->id)->delete();
        return redirect('/');
    }
    public function deleteCargo(Request $request)
    {
        Cargo::find($request->id)->delete();
        return redirect('/');
    }
}
