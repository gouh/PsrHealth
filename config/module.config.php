<?php

return [
    'health' => [
        'mongo' => [
            'host' => '127.0.0.1',
            'port' => 27017,
            'database' => 'local',
            'collection' => 'startup_log',
            'user' => 'admin',
            'password' => 'admin'
        ],
        'mysql' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'credit_sears',
            'user' => 'hangouh',
            'password' => 'secret2'
        ],
        'redis' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'password' => 'password'
        ],
        'endpoint' => [
            'webhook' => [
                'url' => 'https://webhook.site/e8dc7d50-6985-4345-81d1-b45c30601403',
                'custom_headers' => [
                    'Authorization: Basic YWxhZGRpbjpvcGVuc2VzYW1l'
                ]
            ],
            'hangouh' => 'https://hangouh.me'
        ]
    ]
];