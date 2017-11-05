<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmailNotConfirmed
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
        if(! $request->user()->confirmed ) {
            return back()->with('warning_message', 'You must first confirm your email address, please chek your emails.');
        }
        return $next($request);
    }
}
