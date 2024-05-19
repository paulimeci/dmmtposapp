<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusPunonjes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType){
        if(auth()->check() && auth()->user()->status == $userType){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to access this page.'], 403);
    }
}
