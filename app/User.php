<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    public $fillable = [
        'name',
        'discord_id',
        'tycoon_id',
        'employee',
        'trainee',
        'management',
        'active',
        'joined_at'
    ];

    function customerOrders() {
        return $this->hasMany('App\Order', 'customer_id');
    }

    function grinderOrders() {
        return $this->hasMany('App\Order', 'grinder_id');
    }
}
