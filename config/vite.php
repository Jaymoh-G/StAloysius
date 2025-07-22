<?php

return [
    'manifest_path' => base_path('public_html/build/manifest.json'),

    'dev_server' => [
        'url' => env('VITE_DEV_SERVER_URL', 'http://localhost:5173'),
    ],

    'build_directory' => 'build',
];
