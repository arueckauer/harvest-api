<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi;

use Interop\Container\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container) : Client
    {
        $applicationConfig = $container->has('config') ? $container->get('config') : [];
        $harvestConfig     = array_key_exists(self::class, $applicationConfig)
            ? $applicationConfig[self::class]['config']
            : [];
        $headers = $harvestConfig['headers'] ?? [];
        $config  = $harvestConfig['config']  ?? [];

        return new Client($headers, $config);
    }
}
