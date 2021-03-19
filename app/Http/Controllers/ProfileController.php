<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class ProfileController extends Controller
{
    function showProfile() {
        return view('profile.index', [
            'customerOrders' => Order::where([
                'customer_id' => auth()->user()->id,
                ['status', '!=', 'Delivered'],
                ['status', '!=', 'Cancelled'],
            ])->latest()->get(),
            'grinderOrders' => Order::where([
                'grinder_id' => auth()->user()->id,
                ['status', '!=', 'Delivered'],
                ['status', '!=', 'Cancelled'],
            ])->latest()->get(),
        ]);
    }
}
