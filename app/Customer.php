<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    public $fillable = [
        'discord_name',
        'discord_id',
        'tycoon_name',
        'tycoon_id'
    ];
}
