<?php
return [
    'driver' => env('CACHE_DRIVER', 'file'),
    'prefix' => 'pws_',
    'stores' => ['file' => ['driver' => 'file', 'path' => storage_path('framework/cache/data')]],
];
