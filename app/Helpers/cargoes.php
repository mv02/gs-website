<?php

use App\Cargo;

if (!function_exists('addProduct')) {
    function addProduct($name, $price, $limit) {
        $product = Cargo::where('name', $name)->first();
        if ($product) abort(400, 'Product already exists');
        $product = new Cargo([
            'name' => $name,
            'price' => $price,
            'limit' => $limit
        ]);
        $product->save();
    }
}

if (!function_exists('changeProductPrice')) {
    function changeProductPrice($productIdentifier, $price) {
        $product = Cargo::where('id', $productIdentifier)->orWhere('name', $productIdentifier)->first();
        if (!$product) abort(404, 'Product not found');
        $product->price = $price;
        $product->save();
    }
}

if (!function_exists('changeProductLimit')) {
    function changeProductLimit($productIdentifier, $limit) {
        $product = Cargo::where('id', $productIdentifier)->orWhere('name', $productIdentifier)->first();
        if (!$product) abort(404, 'Product not found');
        $product->limit = $limit;
        $product->save();
    }
}