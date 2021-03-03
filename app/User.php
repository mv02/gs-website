<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
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
