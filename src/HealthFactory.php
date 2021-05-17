<?php

declare(strict_types=1);

namespace PsrHealth;

use Psr\Container\ContainerInterface;

class HealthFactory
{
    /**
     * @param ContainerInterface $container
     * @return Health
     */
    public function __invoke(ContainerInterface $container): Health
    {
        $optionsHealth = $container->get('config');
        $optionsHealth = $optionsHealth['health'];
        $configHealth = new Configuration($optionsHealth);
        return new Health($configHealth);
    }
}