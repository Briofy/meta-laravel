<?php

return [
    /*
     *  The database connection and user_id type to use for the tables.
     */
    'database' => [
        'connection' => env('BMETA_DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
        'uuid' => false
    ],


    /*
     *  The route prefix and middleware to use for the routes.
     */
    'routes' => [
        'api' => [
            'enabled' => env('BMETA_API_ENABLED', false),
            'prefix' => env('BMETA_API_PREFIX', 'api'),
            'name' => env('BMETA_API_NAME', 'api.meta.'),
            'middleware' => ['api'],
        ],
    ],
];
