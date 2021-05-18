<?php

declare(strict_types=1);

namespace PsrHealth;

class Configuration
{
    /**
     * @var array
     */
    private $config;

    /**
     * Configuration constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed|null
     */
    public function getMysqlConfig()
    {
        return isset($this->config['mysql']) ? $this->config['mysql'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getRedisConfig()
    {
        return isset($this->config['redis']) ? $this->config['redis'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getMongoConfig()
    {
        return isset($this->config['mongo']) ? $this->config['mongo'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getEndpointConfig()
    {
        return isset($this->config['endpoint']) ? $this->config['endpoint'] : null;
    }
}