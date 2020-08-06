<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoesController extends Controller
{
    public function all() {
        return Cargo::all();
    }
}