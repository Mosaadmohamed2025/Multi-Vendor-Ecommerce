<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Vendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role === 'vendor' && auth()->user()->status == 'active')
        {
            return $next($request);
        }else{
            return  redirect()->route(auth()->user()->role)->with("error" , "you dont have access");
        }
    }
}
