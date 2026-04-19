<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Ensure compiled view path and tmp storage for Vercel / serverless
// Put the env variable before bootstrap so config() reads it during bootstrap.
putenv('VIEW_COMPILED_PATH=/tmp/framework/views');

// Ensure directories exist and are writable in the runtime environment
$paths = [
    '/tmp/framework/views',
    '/tmp/framework/cache/data',
    '/tmp/framework/sessions',
];

foreach ($paths as $p) {
    if (!is_dir($p)) {
        @mkdir($p, 0755, true);
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());