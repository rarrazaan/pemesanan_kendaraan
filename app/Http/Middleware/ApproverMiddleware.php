<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('user')){
            if(session()->get('user')->role_id == 3 or session()->get('user')->role_id == 4){
                return $next($request);
            }
        }
        return redirect('/user/login')->with('error', 'Need Access Permission');
    }
}