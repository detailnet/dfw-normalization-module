<?php

namespace Detail\Normalization\Factory\Options;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Normalization\Exception\ConfigException;
use Detail\Normalization\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!isset($config['detail_normalization'])) {
            throw new ConfigException('Config for Detail\FileConversion is not set');
        }

        return new ModuleOptions($config['detail_normalization']);
    }
}
