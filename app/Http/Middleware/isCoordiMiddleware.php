<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isCoordiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {        
        if(!auth()->check() || (!auth()->user()->is_admin && (auth()->user()->admin_type != 1 && auth()->user()->admin_type != 2  && auth()->user()->admin_type != 5)))
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
