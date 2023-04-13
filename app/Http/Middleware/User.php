<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class User
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if(Auth::check()==true && Auth::user()->role_id== 1 )
        {
            return $next($request);

        }
        return redirect('login')->with('error',"Only admin can access!");
    }
    
}
