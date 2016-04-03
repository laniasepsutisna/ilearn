<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole(explode('|', $role))) {
            abort(401);
        }

        return $next($request);
    }
}
