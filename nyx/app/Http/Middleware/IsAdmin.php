<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // musí byť prihlásený a jeho role == 1
        if (! $request->user() || $request->user()->role !== 1) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
