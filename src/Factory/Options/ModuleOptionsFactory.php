<?php

namespace Detail\Normalization\Factory\Options;

use Interop\Container\ContainerInterface;

use Detail\Normalization\Options\ModuleOptions;

/**
 * @method ModuleOptions __invoke(ContainerInterface $container, $requestedName, array $options = null)
 */
class ModuleOptionsFactory extends RootOptionsFactory
{
    const OPTION = 'detail_normalization';

    protected function getOptionsClass(): string
    {
        return ModuleOptions::CLASS;
    }
}
