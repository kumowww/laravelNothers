<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    error_log("PHP Error [$errno]: $errstr in $errfile:$errline");
    if (defined('STDERR')) {
        fwrite(STDERR, "PHP Error [$errno]: $errstr in $errfile:$errline\n");
    }
});

set_exception_handler(function($exception) {
    error_log("Exception: " . $exception->getMessage());
    error_log("File: " . $exception->getFile() . ":" . $exception->getLine());
    error_log("Trace: " . $exception->getTraceAsString());
    
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
    ], JSON_PRETTY_PRINT);
});

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
        'app.debug' => true,
    ]);

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);
    
} catch (Throwable $e) {
    error_log("FATAL ERROR: " . $e->getMessage());
    error_log("File: " . $e->getFile() . ":" . $e->getLine());
    error_log("Trace: " . $e->getTraceAsString());
    
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'fatal_error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'type' => get_class($e),
    ], JSON_PRETTY_PRINT);
}