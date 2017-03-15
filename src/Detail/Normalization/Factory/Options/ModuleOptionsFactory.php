<?php

namespace Detail\Normalization\Factory\Options;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Normalization\Exception\ConfigException;
use Detail\Normalization\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * Create ModuleOptions
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ModuleOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        if (!isset($config['detail_normalization'])) {
            throw new ConfigException('Config for Detail\Normalization is not set');
        }

        return new ModuleOptions($config['detail_normalization']);
    }
}
