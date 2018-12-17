<?php

namespace arueckauer\HarvestApi;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ClientFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Client
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $applicationConfig = $container->has('config')? $container->get('config') : [];
        $harvestConfig     = array_key_exists(self::class, $applicationConfig)
            ? $applicationConfig[self::class]['config']
            : [];
        $headers = $harvestConfig['headers'] ?? [];
        $config  = $harvestConfig['config']  ?? [];

        return new Client($headers, $config);
    }
}
