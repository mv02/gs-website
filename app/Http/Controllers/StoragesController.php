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
}