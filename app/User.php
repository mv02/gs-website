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
}
