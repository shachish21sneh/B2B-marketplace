<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to access this area.');
        }

        $user = Auth::user();

        if ($user->status === 'banned') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account has been suspended. Please contact support.');
        }

        if (!in_array($user->role, $roles)) {
            // Redirect to appropriate dashboard based on actual role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isSupplier()) {
                return redirect()->route('supplier.dashboard');
            } else {
                return redirect()->route('buyer.dashboard');
            }
        }

        return $next($request);
    }
}
