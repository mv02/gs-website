<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $table = 'cargoes';
    public $fillable = [
        'name',
        'price',
        'limit'
    ];
}