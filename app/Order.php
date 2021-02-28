<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    public $fillable = [
        'status',
        'progress',
        'customer_id',
        'grinder_id',
        'product_name',
        'amount',
        'price_each',
        'priority',
        'discount',
        'storage_id',
        'created_at',
        'completed_at',
        'delivered_at'
    ];

    function customer() {
        return $this->belongsTo('App\User', 'customer_id');
    }

    function grinder() {
        return $this->belongsTo('App\User', 'grinder_id');
    }

    function storage() {
        return $this->belongsTo('App\Storage');
    }

    function getTotalPriceAttribute() {
        $totalPrice = $this->amount * ($this->price_each + $this->storage->fee);
        if ($this->priority) $totalPrice *= 1.15;
        if ($this->discount) $totalPrice -= $totalPrice * $this->discount / 100;
        return $totalPrice;
    }

    function getAmountStringAttribute() {
        return number_format($this->amount, 0, '.', ',');
    }

    function getPriceEachStringAttribute() {
        return '$' . number_format($this->price_each, 0, '.', ',');
    }

    function getTotalPriceStringAttribute() {
        return '$' . number_format($this->total_price, 0, '.', ',');
    }

    function getDiscountStringAttribute() {
        return "-{$this->discount}%";
    }

    function getProgressStringAttribute() {
        return number_format($this->progress, 0, '.', ',');
    }

    function getProgressPercentageAttribute() {
        return floor($this->progress / $this->amount * 100);
    }
}
