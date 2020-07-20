<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Employee;
use App\Customer;

class OrdersController extends Controller
{
    public function get(Request $request)
    {
        return Order::where('id', $request->order_id)->first();
    }

    public function new(Request $request)
    {
        $customer = Customer::where('discord_id', $request->customer_identifier)
                            ->orWhere('tycoon_id', $request->customer_identifier);
        $data = $request->all();
        $data['customer_id'] = $customer->id;
        $order = new Order($data);
        $success = $order->save();

        if (! $success)
            return response('Failed to place a new order.');
        return response("Succesfully placed order GS-{$order->id} ({$order->amount} x {$order->product_name}).");
    }

    public function assign(Request $request)
    {
        $worker = Employee::where('discord_id', $request->employee_identifier)
                          ->orWhere('tycoon_id', $request->employee_identifier)->first();
        $order = Order::where('id', $request->order_id)->first();
        $order->worker_id = $worker->id;
        $order->status = 'In progress';
        $success = $order->save();

        if (! $success)
            return response("Failed to assign employee {$worker->name} to order GS-{$order->id}.");
        return response("Succesfully assigned employee {$worker->name} to order GS-{$order->id}.");
    }

    public function progress(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->progress = $request->progress;
        $success = $order->save();

        if (! $success)
            return response("Failed to update progress of order GS-{$order->id} to {$request->progress}.");
        return response("Succesfully updated progress of order GS-{$order->id} to {$order->progress}.");
    }

    public function collection(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->progress = $order->amount;
        $order->status = 'Pending collection';
        $success = $order->save();

        if (! $success)
            return response("Failed to mark order GS-{$order->id} for collection.");
        return response("Succesfully marked order GS-{$order->id} for collection.");
    }

    public function complete(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->status = 'Completed';
        $success = $order->save();

        if (! $success)
            return response("Failed to mark order GS-{$order->id} as completed.");
        return response("Succesfully marked order GS-{$order->id} as completed.");
    }

    public function editPriority(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->priority = $request->priority;
        $success = $order->save();

        if (! $success)
            return response("Failed to edit priority for order GS-{$order->id}.");
        return response("Succesfully edited priority for order GS-{$order->id}, the new value is {$order->priority}.");
    }

    public function editAmount(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->amount = $request->amount;
        $success = $order->save();

        if (! $success)
            return response("Failed to edit amount for order GS-{$order->id}.");
        return response("Succesfully edited amount for order GS-{$order->id}, the new value is {$order->amount}.");
    }

    public function editDiscount(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        if ($request->discount == 0)
            $order->discount = null;
        else
            $order->discount = $request->discount;
        $success = $order->save();

        if (! $success)
            return response("Failed to edit discount for order GS-{$order->id}.");
        return response("Succesfully edited discount for order GS-{$order->id}, the new value is {$order->discount}.");
    }

    public function editStorage(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->storage_id = $request->storage_id;
        $success = $order->save();

        if (! $success)
            return response("Failed to edit storage for order GS-{$order->id}.");
        return response("Succesfully edited storage for order GS-{$order->id}, the new value is {$order->storage_id}.");

    }

    public function cancel(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->status = 'Cancelled';
        $order->progress = 0;
        $order->worker_id = null;
        $success = $order->save();

        if (! $success)
            return response("Failed to cancel order GS-{$order->id}.");
        return response("Succesfully cancelled order GS-{$order->id}.");
    }
}