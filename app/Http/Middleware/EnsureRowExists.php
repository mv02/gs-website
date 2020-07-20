<?php

namespace App\Http\Middleware;

use Closure;
use App\Employee;
use App\Customer;
use App\Order;
use App\Storage;

class EnsureRowExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        switch ($model) {
            case 'employee':
                $employee = Employee::where('discord_id', $request->employee_identifier)
                                    ->orWhere('tycoon_id', $request->employee_identifier)
                                    ->orWhere('id', $request->employee_identifier)->first();
                
                if (! $employee)
                    return response("Employee with identifier {$request->employee_identifier} does not exist.");
            break;
            case 'customer':
                $customer = Customer::where('discord_id', $request->customer_identifier)
                                    ->orWhere('tycoon_id', $request->customer_identifier)
                                    ->orWhere('id', $request->customer_identifier)->first();

                if (! $customer)
                    return response("Customer with identifier {$request->customer_identifier} does not exist.");
            break;
            case 'order':
                $order = Order::where('id', $request->order_id)->first();
        
                if (! $order)
                    return response("Order GS-{$request->order_id} does not exist.");
            break;
            case 'storage':
                $storage = Storage::where('id', $request->storage_id)->first();

                if (! $storage)
                    return response("Storage with ID {$request->storage_id} does not exist.");
            break;
            default:
                return response('[EnsureRowExists] Middleware check failure');
        }

        return $next($request);
    }
}