<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('user_id') && Session::get('user_type') == 'user') {
            return $next($request);
        }

        Session::flush();
        return redirect()->route('login');
    }
}
