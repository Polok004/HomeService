<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAcces
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }*/

    public function handle(Request $request, Closure $next, $accessLevel)
    {
        // Logic to check user's access level based on the $accessLevel parameter
        
        if (!$request->user()->hasAccess($accessLevel)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
