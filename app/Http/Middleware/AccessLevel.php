<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
        $user = auth()->user();

        // Check if the user is authenticated and their role is in the allowed roles
        if (auth()->check() && in_array($user->level, $allowedRoles)) {
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to access this page.'], 403);

    }
}
