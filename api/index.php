<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

$paths = [
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs'
];

foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

$app->singleton('files', function () {
    return new Illuminate\Filesystem\Filesystem;
});

$app->register(Illuminate\View\ViewServiceProvider::class);
$app->register(Illuminate\Filesystem\FilesystemServiceProvider::class);

try {
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
} catch (\Exception $e) {
    http_response_code(500);
    echo 'Error: ' . $e->getMessage() . '<br>';
    echo 'File: ' . $e->getFile() . '<br>';
    echo 'Line: ' . $e->getLine() . '<br>';
    echo 'Trace: <pre>' . $e->getTraceAsString() . '</pre>';
}