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
}
