<?php

if (isset($_ENV['APP_KEY'])) {
    putenv("APP_KEY={$_ENV['APP_KEY']}");
}
if (isset($_ENV['APP_DEBUG'])) {
    putenv("APP_DEBUG={$_ENV['APP_DEBUG']}");
}
if (isset($_ENV['APP_URL'])) {
    putenv("APP_URL={$_ENV['APP_URL']}");
}
if (isset($_ENV['DB_CONNECTION'])) {
    putenv("DB_CONNECTION={$_ENV['DB_CONNECTION']}");
    putenv("DB_HOST={$_ENV['DB_HOST']}");
    putenv("DB_PORT={$_ENV['DB_PORT']}");
    putenv("DB_DATABASE={$_ENV['DB_DATABASE']}");
    putenv("DB_USERNAME={$_ENV['DB_USERNAME']}");
    putenv("DB_PASSWORD={$_ENV['DB_PASSWORD']}");
}

$paths = [
    '/tmp/storage',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);