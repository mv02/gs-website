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
                $employee = Employee::where('discord_id', $request->discord_id)->first();
                
                if (! $employee)
                    return response("Employee with Discord ID {$request->discord_id} does not exist.");
            break;
            case 'customer':
                $customer = Customer::where('discord_id', $request->discord_id)->first();

                if (! $customer)
                    return response("Customer with Discord ID {$request->discord_id} does not exist.");
            break;
            case 'order':
                $order = Order::where('id', $request->order_id)->first();
        
                if (! $order)
                    return response("Order GS-{$request->order_id} does not exist.");
            break;
            case 'storage':
                if (isset($request->storage_id)) {
                    $storage = Storage::where('id', $request->storage_id)->first();

                    if (! $storage)
                        return response("Storage with ID {$request->storage_id} does not exist.");
                }
            break;
            default:
                return response('[EnsureRowExists] Middleware check failure');
        }

        return $next($request);
    }
}