<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;

class StorageController extends Controller
{
    function getStorages(Request $request) {
        // specific storage
        if ($request->storage_identifier) {
            $storage = Storage::where('id', $request->storage_identifier)->orWhere('name', $request->storage_identifier)->first();
            if (!$storage) abort(404, 'Storage not found');
            return $storage;
        }
        // all storages
        else {
            return Storage::all();
        }
    }
}
