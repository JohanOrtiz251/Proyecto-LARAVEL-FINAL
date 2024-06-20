<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        
        if (!$user || !in_array($user->role->name, $roles)) {
            return redirect('/');
        }

        return $next($request);
    }
}
