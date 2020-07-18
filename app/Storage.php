<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    public $timestamps = false;
    public $fillable = [
        'name',
        'fee',
        'faction'
    ];
}
