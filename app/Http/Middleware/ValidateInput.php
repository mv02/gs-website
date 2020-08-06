<?php

namespace App\Http\Middleware;

use Closure;
use App\Order;

class ValidateInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $field)
    {
        $order = Order::where('id', $request->order_id)->first();

        switch ($field) {
            case 'progress':
                if ($request->progress < 0)
                    return response('Invalid input (progress cannot be a negative number).');
                else if ($request->progress > $order->amount)
                    return response('Invalid input (progress cannot exceed the ordered amount).');
            break;
            case 'amount':
                if (isset($request->amount)) {
                    if ($request->amount < 0)   // To do: check crossing the order limit
                        return response('Invalid input (amount cannot be a negative number).');
                }
            break;
            default:
                return response('[ValidateInput] Middleware check failure');
        }

        return $next($request);
    }
}
