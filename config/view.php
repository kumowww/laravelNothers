<?php

return [
    'paths' => [
        resource_path('views'),
    ],
    'compiled' => env('VIEW_COMPILED_PATH', '/tmp/framework/views'),
    'relative_hash' => false,
    'cache' => false,
];