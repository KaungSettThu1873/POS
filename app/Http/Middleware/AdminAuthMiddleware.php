<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!empty(Auth::user())) {
            if(URL::current() == route('Register#Page') || URL::current() == route('Login#Page')) {
                return back();
            }

            if(Auth::user()->role == "User") {
                return back();
               }

               return $next($request);
        }

        return $next($request);
    }
}
