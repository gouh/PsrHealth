<?php

declare(strict_types=1);

namespace PsrHealth;

use PDO;
use PDOException;
use Redis;
use RedisException;

class Health
{
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @return bool
     * @throws RedisException
     */
    public function redisConnection(): bool
    {
        $redisConfig = $this->config->getRedisConfig();
        if ($redisConfig == null) {
            return false;
        }

        $redis = new Redis();
        $redis->connect($redisConfig['host'], $redisConfig['port']);

        return $redis->ping() != false;
    }

    /**
     * @return bool
     * @throws PDOException if the attempt to connect to the requested database fails.
     */
    public function mysqlConnection(): bool
    {
        $mysqlConfig = $this->config->getMysqlConfig();
        if ($mysqlConfig == null){
            return false;
        }

        $conn = new PDO(
            "mysql:host=${$mysqlConfig['host']};dbname=${$mysqlConfig['database']}",
            $mysqlConfig['user'],
            $mysqlConfig['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $conn = null;
        return true;
    }

    /**
     * @param $requestConfig
     * @return int
     */
    private function getRequest($requestConfig): int
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestConfig['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if (isset($requestConfig['custom_headers'])){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $requestConfig['custom_headers']);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return (int) $httpCode;
    }

    /**
     * @return array
     */
    public function endpointConnection(): array
    {
        $endPointConfig = $this->config->getEndpointConfig();
        if ($endPointConfig == null) {
            return [];
        }

        $endPointResponse = [];
        foreach ($endPointConfig as $endPoint => $item){
            $endPointResponse[$endPoint] = $this->getRequest($item);
        }

        return $endPointResponse;
    }

    /**
     * @return array
     * @throws RedisException
     * @throws PDOException
     */
    public function getHealthStatus()
    {
        return [
            'time' => time(),
            'php' => phpversion(),
            'redis' => $this->redisConnection(),
            'mysql' => $this->mysqlConnection(),
            'endpoint' => $this->endpointConnection()
        ];
    }
}