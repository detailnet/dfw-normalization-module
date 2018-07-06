<?php

namespace Detail\Normalization\Factory\Options;

use Interop\Container\ContainerInterface;

use Detail\Normalization\Options\JMSSerializerOptions;

/**
 * @method JMSSerializerOptions __invoke(ContainerInterface $container, $requestedName, array $options = null)
 */
class JMSSerializerOptionsFactory extends RootOptionsFactory
{
    const OPTION = 'jms_serializer';

    protected function getOptionsClass(): string
    {
        return JMSSerializerOptions::CLASS;
    }
}
