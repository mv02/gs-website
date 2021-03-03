<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Storage;
use App\User;

class OrderController extends Controller
{
    // add customer, grinder and storage objects instead of IDs
    function addRelatedToOrder($order) {
        $storage = Storage::findOrFail($order->storage_id);
        $order->storage = $storage;
        $customer = User::findOrFail($order->customer_id);
        $order->customer = $customer;
        if ($order->grinder_id) {
            $grinder = User::findOrFail($order->grinder_id);
            $order->grinder = $grinder;
        }
        unset($order->customer_id, $order->grinder_id, $order->storage_id);
        return $order;
    }

    function addOrder(Request $request) {
        placeOrder(
            $request->customer_identifier,
            $request->product_identifier,
            $request->amount,
            $request->priority,
            $request->discount,
            $request->storage_identifier
        );
        return response('Success');
    }

    function getOrders(Request $request) {
        // specific order
        if ($request->order_id) {
            $order = Order::findOrFail($request->order_id);
            return $this->addRelatedToOrder($order);
        }
        // all orders
        else {
            $orders = Order::all();
            foreach ($orders as $order) {
                $order = $this->addRelatedToOrder($order);
            }
            return $orders;
        }
    }

    function getActiveOrders() {
        $orders = Order::where('status', 'Queued')->orWhere('status', 'In Progress')->orWhere('status', 'Completed')->get();
        foreach ($orders as $order) {
            $order = $this->addRelatedToOrder($order);
        }
        return $orders;
    }

    function getQueuedOrders() {
        $orders = Order::where('status', 'Queued')->get();
        foreach ($orders as $order) {
            $order = $this->addRelatedToOrder($order);
        }
        return $orders;
    }

    function getInProgressOrders() {
        $orders = Order::where('status', 'In Progress')->get();
        foreach ($orders as $order) {
            $order = $this->addRelatedToOrder($order);
        }
        return $orders;
    }

    function getCompletedOrders() {
        $orders = Order::where('status', 'Completed')->get();
        foreach ($orders as $order) {
            $order = $this->addRelatedToOrder($order);
        }
        return $orders;
    }

    function getDeliveredOrders() {
        $orders = Order::where('status', 'Delivered')->get();
        foreach ($orders as $order) {
            $order = $this->addRelatedToOrder($order);
        }
        return $orders;
    }

    function setOrderGrinder(Request $request) {
        setGrinder($request->order_id, $request->grinder_discord_id);
        return response('Success');
    }

    function setOrderProgress(Request $request) {
        setProgress($request->order_id, $request->progress);
        return response('Success');
    }

    function nextOrderStatus(Request $request) {
        $order = Order::findOrFail($request->order_id);
        if ($order->status == 'In Progress') completeOrder($order->id);
        else if ($order->status == 'Completed') deliverOrder($order->id);
        return response('Success');
    }

    function editOrderData(Request $request) {
        editOrderData($request->order_id, $request->all());
        return response('Success');
    }

    function resetOrder(Request $request) {
        resetOrder($request->order_id);
        return response('Success');
    }
}
