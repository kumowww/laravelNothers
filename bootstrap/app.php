<?php

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
            'locale.validation' => \App\Http\Middleware\LocaleValidation::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->handler(function ($request, $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        });
    })
    ->create()
    ->useStoragePath('/tmp/storage');