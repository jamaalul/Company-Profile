<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /** @var \App\Models\User $user */
                $user = Auth::guard($guard)->user();
                
                // Redirect based on user role
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                }
                
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}