<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Employee;
use App\Customer;

class OrdersController extends Controller
{
    public function all()
    {
        return Order::all();
    }

    public function queued()
    {
        return Order::where('status', 'Queued')->get();
    }

    public function pending()
    {
        return Order::where('status', 'In progress')->orWhere('status', 'Pending collection')->get();
    }

    public function completed()
    {
        return Order::where('status', 'Completed')->get();
    }

    public function get(Request $request)
    {
        return Order::find($request->order_id);
    }

    public function new(Request $request)
    {
        $customer = Customer::where('discord_id', $request->discord_id)->first();
        $data = $request->all();
        unset($data['customer_identifier']);
        $data['customer_id'] = $customer->id;
        $order = new Order($data);
        $success = $order->save();

        return $success ? $order : null;
    }

    public function assign(Request $request)
    {
        $worker = Employee::where('discord_id', $request->discord_id)->first();
        $order = Order::find($request->order_id);
        $order->worker_id = $worker->id;
        $order->status = 'In progress';
        $success = $order->save();

        return $success ? $order : null;
    }

    public function progress(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->progress = $request->progress;
        $success = $order->save();

        return $success ? $order : null;
    }

    public function collection(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->progress = $order->amount;
        $order->status = 'Pending collection';
        $success = $order->save();

        return $success ? $order : null;
    }

    public function complete(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'Completed';
        $success = $order->save();

        return $success ? $order : null;
    }

    public function edit(Request $request)
    {
        $order = Order::find($request->order_id);
        if (isset($request->priority))
            $order->priority = $request->priority;
        if (isset($request->amount))
            $order->amount = $request->amount;
        if (isset($request->discount))
            $request->discount == 0 ? $order->discount = null : $order->discount = $request->discount;
        if (isset($request->storage_id))
            $order->storage_id = $request->storage_id;
        $success = $order->save();

        return $success ? $order : null;
    }

    public function cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'Cancelled';
        $order->progress = 0;
        $order->worker_id = null;
        $success = $order->save();

        return $success ? $order : null;
    }
}