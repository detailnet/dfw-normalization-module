<?php

namespace Detail\Normalization\Factory\Options;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Normalization\Options\ModuleOptions;

class ModuleOptionsFactory implements
    FactoryInterface
{
    const OPTION = 'detail_normalization';

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ModuleOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        if (!isset($config[self::OPTION])) {
            throw new ServiceNotCreatedException(sprintf('Missing config option "%s"', self::OPTION));
        }

        return new ModuleOptions($config[self::OPTION]);
    }
}
