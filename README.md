# Psr Health

It is a handler to be able to know if there are certain connections such as cache, database and some external endpoints

### Built With

* [PHP](https://www.php.net)
* [Container interface](https://github.com/php-fig/container)


### Config

If you use config aggregator add next line in the array

```php
PsrHealth\ConfigProvider::class
```

If you use only psr container add next line in your factories

```php
\PsrHealth\Health::class => \PsrHealth\HealthFactory::class
```

Config for psr-health, add an array like this in the project config

```php
    'health' => [
        'mongo' => [
            'host' => 'local-mongo-44',
            'port' => 27017,
            'database' => 'local',
            'collection' => 'startup_log',
            'user' => 'admin',
            'password' => 'admin'
        ],
        'mysql' => [
            'host' => 'local-mysql-57',
            'port' => 3306,
            'database' => 'credit',
            'user' => 'hangouh',
            'password' => 'secret2'
        ],
        'redis' => [
            'host' => 'local-redis',
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
```

You can confgure only what you require

```php
    'health' => [
        'mysql' => [
            'host' => 'local-mysql-57',
            'port' => 3306,
            'database' => 'credit',
            'user' => 'hangouh',
            'password' => 'secret2'
        ],
        'redis' => [
            'host' => 'local-redis',
            'port' => 6379,
            'password' => 'password'
        ]
    ]
```

### Usage

Get Health class from your container and inject in your class

```php
$health = $container->get(Health::class);
```

The class has multiple connection tests you can use each one or together

```php
$health->redisConnection();
$health->mysqlConnection();
$health->mongoConnection();
$health->endpointConnection();
# Or you can use
$health->getHealthStatus();
```
