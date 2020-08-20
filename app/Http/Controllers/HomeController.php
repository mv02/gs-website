<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\Order;
use App\Storage;
use App\Cargo;

class HomeController extends Controller
{
    public function show()
    {
        return view('home', [
            'employeeCount' => Employee::count(),
            'orderCount' => Order::where('status', 'Completed')->count(),
            'customerCount' => Customer::count(),
            'storages' => Storage::where('faction', 0)->get(),
            'cargoes' => Cargo::all()
        ]);
    }
}
