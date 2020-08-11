<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;

class StoragesController extends Controller
{
    public function all()
    {
        return Storage::all();
    }

    public function get(Request $request)
    {
        if (intval($request->identifier) != 0) {
            $storage = Storage::find($request->identifier);
        }
        else {
            $storage = Storage::whereRaw("lower(replace(name, ' ', '')) like '%{$request->identifier}%'")->first();
        }
        return $storage ? $storage : null;
    }
}