<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    public $fillable = [
        'name',
        'discord_id',
        'tycoon_id',
        'rank',
        'joined_at',
        'trailer',
        'faction'
    ];
}
