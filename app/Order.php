<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'priority',
        'status',
        'customer_id',
        'worker_id',
        'product_name',
        'price_each',
        'amount',
        'discount',
        'storage_id'
    ];
}
