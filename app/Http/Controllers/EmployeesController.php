<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeesController extends Controller
{
    public function all()
    {
        return Employee::all();
    }

    public function get(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();

        return $employee ? $employee : null;
    }

    public function new(Request $request)
    {
        $employee = new Employee($request->all());
        $success = $employee->save();

        return $success ? $employee : null;
    }

    public function promote(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();
        $employee->rank++;
        $success = $employee->save();

        return $success ? $employee : null;
    }

    public function trainee(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();
        $employee->trainee = false;
        $success = $employee->save();

        return $success ? $employee : null;
    }

    public function status(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();
        $employee->active ? $employee->active = false : $employee->active = true;
        $success = $employee->save();

        return $success ? $employee : null;
    }

    public function trailer(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();
        $employee->trailer = $request->trailer;
        $success = $employee->save();

        return $success ? $employee : null;
    }

    public function faction(Request $request)
    {
        $employee = Employee::where('discord_id', $request->discord_id)->first();
        $employee->faction = $request->faction;
        $success = $employee->save();

        return $success ? $employee : null;
    }
}