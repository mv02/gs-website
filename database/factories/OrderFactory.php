<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cargo;
use App\Order;
use App\Storage;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $customer = User::all()->random();
    $cargo = Cargo::all()->random();
    $storage = Storage::all()->random();
    return [
        'customer_id' => $customer->id,
        'product_name' => $cargo->name,
        'amount' => rand($cargo->limit / 2, $cargo->limit),
        'price_each' => $cargo->price,
        'priority' => rand(0, 1),
        'storage_id' => $storage->id,
    ];
});
