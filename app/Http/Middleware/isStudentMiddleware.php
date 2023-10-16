<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isStudentMiddleware
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
        if(!auth()->check() || auth()->user()->is_admin == 1 || auth()->user()->is_teacher == 1 )
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
