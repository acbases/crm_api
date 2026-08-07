<?php

return [
    'default' => env('DB_CONNECTION', 'pgsql'),

    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'CRM'),
            'username' => env('DB_USERNAME', 'admin_allapps'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'Allpro_rh' => [
            'driver' => 'pgsql',
            'host' => env('ALLPRO_RH_DB_HOST', '127.0.0.1'),
            'port' => env('ALLPRO_RH_DB_PORT', '5432'),
            'database' => env('ALLPRO_RH_DB_DATABASE', ''),
            'username' => env('ALLPRO_RH_DB_USERNAME', ''),
            'password' => env('ALLPRO_RH_DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],
];