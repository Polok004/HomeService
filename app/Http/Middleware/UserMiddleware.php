<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   
     public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->type == 'user'){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect()->route('login');
            }
        }

        else{
                 Auth::logout();
                return redirect()->route('login');
        }
    }
}
