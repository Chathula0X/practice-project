<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminRedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin:admins' => AdminRedirectIfAuthenticated::class,
        ]);
        
        // Customize authentication redirect based on route
        $middleware->redirectGuestsTo(function ($request) {
            // Admin routes redirect to admin login
            if ($request->is('admin/*') || 
                $request->is('client/*') || 
                $request->is('supplier/*')) {
                return route('admin.login');
            }
            
            // All other routes redirect to regular login
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();