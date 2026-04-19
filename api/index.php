<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    $app->useStoragePath('/tmp/storage');

    $storagePaths = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
    ];

    foreach ($storagePaths as $path) {
        if (!is_dir($path)) {
            @mkdir($path, 0755, true);
        }
    }

    config([
        'view.compiled' => '/tmp/storage/framework/views',
        'cache.stores.file.path' => '/tmp/storage/framework/cache/data',
        'session.driver' => 'cookie',
        'logging.channels.single.path' => '/tmp/storage/logs/laravel.log',
    ]);

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $response->send();
    $kernel->terminate($request, $response);
    
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ]);
}