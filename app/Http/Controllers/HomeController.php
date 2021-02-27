<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Storage;
use App\Cargo;

class HomeController extends Controller
{
    public function show()
    {
        return view('home', [
            'employeeCount' => User::where('employee', true)->count(),
            'orderCount' => Order::where('status', 'Delivered')->count(),
            'customerCount' => User::count(),
            'storages' => Storage::where('faction', 0)->get(),
            'cargoes' => Cargo::all()
        ]);
    }
}
