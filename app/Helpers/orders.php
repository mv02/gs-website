<?php

use App\Cargo;
use App\Order;
use App\Storage;
use App\User;

if (!function_exists('placeOrder')) {
    function placeOrder($customerIdentifier, $productIdentifier, $amount, $priority, $discount, $storageIdentifier) {
        $customer = User::where('id', $customerIdentifier)->orWhere('discord_id', $customerIdentifier)->first();
        if (!$customer) abort(404, 'Customer not found');
        $product = Cargo::where('id', $productIdentifier)->orWhere('name', $productIdentifier)->first();
        if (!$product) abort(404, 'Product not found');
        $storage = Storage::where('id', $storageIdentifier)->orWhere('name', $storageIdentifier)->first();
        if (!$storage) abort(404, 'Storage not found');
        if ($amount > $product->limit || $amount <= 0) abort(400, 'Invalid amount');
        $order = new Order([
            'customer_id' => $customer->id,
            'product_name' => $product->name,
            'amount' => $amount,
            'price_each' => $product->price,
            'priority' => $priority,
            'discount' => $discount,
            'storage_id' => $storage->id
        ]);
        $order->save();
        orderPlaced($order->id);
    }
}

if (!function_exists('setGrinder')) {
    function setGrinder($orderID, $grinderDiscordID) {
        $order = Order::findOrFail($orderID);
        $grinderID = User::where('discord_id', $grinderDiscordID)->value('id');
        $order->grinder_id = $grinderID;
        $order->status = 'In Progress';
        $order->save();
        orderAssigned($orderID);
    }
}

if (!function_exists('setProgress')) {
    function setProgress($orderID, $progress) {
        $order = Order::findOrFail($orderID);
        $order->progress = $progress;
        $order->save();
        orderUpdated($orderID);
    }
}

if (!function_exists('completeOrder')) {
    function completeOrder($orderID) {
        $order = Order::findOrFail($orderID);
        $order->status = 'Completed';
        $order->progress = $order->amount;
        $order->completed_at = now();
        $order->save();
        orderCompleted($orderID);
    }
}

if (!function_exists('deliverOrder')) {
    function deliverOrder($orderID) {
        $order = Order::findOrFail($orderID);
        $order->status = 'Delivered';
        $order->delivered_at = now();
        $order->save();
        orderDelivered($orderID);
    }
}

if (!function_exists('resetOrder')) {
    function resetOrder($orderID) {
        $order = Order::findOrFail($orderID);
        $order->status = 'Queued';
        $order->progress = 0;
        $order->grinder_id = $order->completed_at = $order->delivered_at = null;
        $order->save();
        orderDelivered($orderID);
        orderPlaced($orderID);
    }
}

if (!function_exists('editOrderData')) {
    function editOrderData($orderID, $data) {
        $order = Order::findOrFail($orderID);
        foreach ($data as $key => $value) {
            $order[$key] = $value;
        }
        $order->save();
    }
}