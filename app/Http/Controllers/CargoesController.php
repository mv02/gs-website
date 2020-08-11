<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoesController extends Controller
{
    public function all()
    {
        return Cargo::all();
    }

    public function get(Request $request)
    {
        if (intval($request->identifier) != 0) {
            $cargo = Cargo::find($request->identifier);
        }
        else {
            $cargo = Cargo::whereRaw("lower(replace(name, ' ', '')) like '%{$request->identifier}%'")->first();
        }
        return $cargo ? $cargo : null;
    }
}