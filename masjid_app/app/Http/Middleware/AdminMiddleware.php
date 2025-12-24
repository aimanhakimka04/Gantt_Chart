<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated as a committee member (admin)
        if (auth()->guard('committee')->check()) {
            $committee = auth()->guard('committee')->user();
            // All committee members are admins, so just check if they're authenticated
            return $next($request);
        }
        
        abort(403, 'Unauthorized. Committee/Admin access required.');
    }
}