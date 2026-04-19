<?php

require __DIR__ . '/../vendor/autoload.php';

$paths = [
    '/tmp/framework/views',
    '/tmp/framework/cache/data',
    '/tmp/framework/sessions',
];

foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp');

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

config([
    'view.compiled' => '/tmp/framework/views',
    'cache.default' => 'array',
    'session.driver' => 'cookie',
]);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);