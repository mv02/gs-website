<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class ProfileController extends Controller
{
    function showProfile() {
        return view('profile');
    }
}
