<?php

namespace Detail\Normalization\Factory\Options;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\AbstractOptions;

abstract class RootOptionsFactory implements
    FactoryInterface
{
    const OPTION = null;

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AbstractOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        if (!isset($config[static::OPTION])) {
            throw new ServiceNotCreatedException(sprintf('Missing config option "%s"', static::OPTION));
        }

        $optionsClass = $this->getOptionsClass();

        /** @todo Check if class exists */

        return new $optionsClass($config[static::OPTION]);
    }

    abstract protected function getOptionsClass(): string;
}
