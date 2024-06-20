<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->role->name, $roles)) {
            return redirect('/');
        }

        return $next($request);
    }
}
