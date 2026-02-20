<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->append([
            // App\Http\Middleware\CheckLoginAdmin::class
        ]);
        // Middleware cho nhóm web và api cục bộ c
        $middleware->web(append: [
            // \App\Http\Middleware\CheckLoginAdmin::class,
        ]);

         $middleware->api(append: [
            'throttle:custom_limit',
            // \App\Http\Middleware\CheckLoginAdmin::class,

        ]);
        $middleware->alias([
            'auth.admin' => \App\Http\Middleware\CheckLoginAdmin::class,
            'product.permission' => \App\Http\Middleware\ProductPermission::class,
            'guest.custom' => \App\Http\Middleware\RedirectIfAuthenticated::class,
         
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
