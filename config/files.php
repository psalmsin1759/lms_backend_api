<?php

return [
    'default_provider' => env('FILE_STORAGE_PROVIDER', 'local'),

    'disks' => [
        'local' => 'public',
        's3'    => 's3',
        'r2'    => 'r2',
    ],
];
