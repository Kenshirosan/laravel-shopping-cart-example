<?php

namespace App\Http\Middleware;

use Closure;

class Employee
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
        if(! auth()->check() || ! auth()->user()->isEmployee() ){
            return redirect('/shop')->with('error_message', 'Page not found');
        }
        return $next($request);
    }
}
