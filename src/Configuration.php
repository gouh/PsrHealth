<?php

declare(strict_types=1);

namespace PsrHealth;

class Configuration
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getMysqlConfig()
    {
        return isset($this->config['mysql']) ? $this->config['mysql'] : null;
    }

    public function getRedisConfig()
    {
        return isset($this->config['redis']) ? $this->config['redis'] : null;
    }

    public function getMongoConfig()
    {
        return isset($this->config['mongo']) ? $this->config['mongo'] : null;
    }

    public function getEndpointConfig()
    {
        return isset($this->config['endpoint']) ? $this->config['endpoint'] : null;
    }
}