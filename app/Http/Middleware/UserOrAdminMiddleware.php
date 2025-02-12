<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOrAdminMiddleware
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
        if ($userOrAdmin){
            return $next($request);
        } else{
            return redirect()->back()->withErrors(['Unauthorized']);
        }
    }
}
