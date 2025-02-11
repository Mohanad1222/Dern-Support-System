<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedAnyRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $technician = Auth::guard('technician')->user();
        $userOrAdmin = Auth::guard('web')->user();

        if ($technician || $userOrAdmin){
            return $next($request);
        }
        return redirect()->route('auth.login.form')->withErrors(['Unauthorized']);
    }
}
