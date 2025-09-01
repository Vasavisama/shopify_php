<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();
        if (!$user) {
            Log::warning('No authenticated user found in RoleMiddleware');
            return redirect()->route('login');
        }

        if ($user->role !== $role) {
            Log::info('Role mismatch, redirecting:', ['user_role' => $user->role, 'required_role' => $role]);
            return redirect()->route('dashboard.' . $user->role);
        }

        return $next($request);
    }
}
