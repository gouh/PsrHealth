<?php

declare(strict_types=1);

namespace PsrHealth;

/**
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Return configuration for this component.
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    private function getDependencies(): array
    {
        return [
            'factories' => [
                Health::class => HealthFactory::class
            ]
        ];
    }
}