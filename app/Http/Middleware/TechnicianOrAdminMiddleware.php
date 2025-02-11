<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechnicianOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $technician = Auth::guard('technician')->user();
        $admin = Auth::guard('web')->user();

        if ($technician || ($admin && $admin->isAdmin())){
            return $next($request);
        }
        return redirect()->back()->withErrors(['Unauthorized']);

    }
}
