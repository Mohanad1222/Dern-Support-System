<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userOrAdmin = Auth::guard('web')->user();
        if ($userOrAdmin && $userOrAdmin->role == 'admin'){
            return redirect()->back()->withErrors(['Unauthorized']);
        } else{
            return $next($request);
        }
    }
}
