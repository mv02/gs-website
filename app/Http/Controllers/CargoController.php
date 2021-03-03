<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{
    function addCargo(Request $request) {
        addProduct($request->name, $request->price, $request->limit);
        return response('Success');
    }

    function getCargoes(Request $request) {
        // specific cargo
        if ($request->cargo_identifier) {
            $cargo = Cargo::where('id', $request->cargo_identifier)->orWhere('name', $request->cargo_identifier)->first();
            if (!$cargo) abort(404, 'Product not found');
            return $cargo;
        }
        // all cargoes
        else {
            return Cargo::all();
        }
    }

    function editCargo(Request $request) {
        if ($request->price) changeProductPrice($request->cargo_identifier, $request->price);
        if ($request->limit) changeProductPrice($request->cargo_identifier, $request->limit);
        return response('Success');
    }

    function deleteCargo(Request $request) {
        $cargo = Cargo::where('id', $request->cargo_identifier)->orWhere('name', $request->cargo_identifier)->first();
        if (!$cargo) abort(404, 'Product not found');
        $cargo->delete();
        return response('Success');
    }
}
