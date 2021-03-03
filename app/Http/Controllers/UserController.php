<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function addUser(Request $request) {
        addUser($request->name, $request->discord_id, $request->tycoon_id);
        return response('Success');
    }

    function getUsers(Request $request) {
        // specific user
        if ($request->user_identifier) {
            $user = User::where('id', $request->user_identifier)->orWhere('discord_id', $request->user_identifier)->first();
            if (!$user) abort(404, 'User not found');
            return $user;
        }
        // all users
        else {
            return User::all();
        }
    }

    function getCustomerOrders(Request $request) {
        $user = User::where('id', $request->user_identifier)->orWhere('discord_id', $request->user_identifier)->first();
        if (!$user) abort(404, 'User not found');
        return $user->customerOrders;
    }

    function getGrinderOrders(Request $request) {
        $user = User::where('id', $request->user_identifier)->orWhere('discord_id', $request->user_identifier)->first();
        if (!$user) abort(404, 'User not found');
        return $user->grinderOrders;
    }

    function getAllEmployees() {
        return User::where('employee', true)->get();
    }

    function getActiveEmployees() {
        return User::where(['employee' => true, 'active' => true])->get();
    }

    function getInactiveEmployees() {
        return User::where(['employee' => true, 'active' => false])->get();
    }

    function hireUser(Request $request) {
        hireUser($request->user_identifier);
        return response('Success');
    }

    function fireUser(Request $request) {
        fireUser($request->user_identifier);
        return response('Success');
    }

    function promoteUser(Request $request) {
        promoteUser($request->user_identifier);
        return response('Success');
    }

    function demoteUser(Request $request) {
        demoteUser($request->user_identifier);
        return response('Success');
    }
}
