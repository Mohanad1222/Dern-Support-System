<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticatedAnyRoleMiddleware;
use App\Http\Middleware\TechnicianOrAdminMiddleware;
use App\Http\Middleware\UserOrAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'anyRole' => AuthenticatedAnyRoleMiddleware::class,
            'adminOnly' => AdminMiddleware::class,
            'technicianOrAdmin' => TechnicianOrAdminMiddleware::class,
            'UserOrAdmin' => UserOrAdminMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
