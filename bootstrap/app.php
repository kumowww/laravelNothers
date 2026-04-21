<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

if (empty(env('APP_KEY'))) {
    $_ENV['APP_KEY'] = 'base64:iZ9U8Xh9LpV3mN7rT5wY1kC4bJ6sF0gH2aD8eK9nM=';
}

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
        //
    })
    ->create()
    ->useStoragePath('/tmp/storage');