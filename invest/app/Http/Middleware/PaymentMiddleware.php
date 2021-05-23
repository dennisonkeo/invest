<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $user = Auth::user();

    if ($user && $user->status == "inactive") 
    {

        return redirect('payment');
    }

        return $next($request);
    }
}
