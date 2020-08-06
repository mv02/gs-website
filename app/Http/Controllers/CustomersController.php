<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
    public function all()
    {
        return Customer::all();
    }

    public function get(Request $request)
    {
        $customer = Customer::where('discord_id', $request->discord_id)->first();

        return $customer ? $customer : null;
    }

    public function new(Request $request)
    {
        $customer = new Customer($request->all());
        $success = $customer->save();

        return $success ? $customer : null;
    }
}