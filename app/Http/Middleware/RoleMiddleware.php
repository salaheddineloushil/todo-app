<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, $roles)) {
            return redirect()->back()->with('error', 'Access denied');
        }

        return $next($request);
    }
}
