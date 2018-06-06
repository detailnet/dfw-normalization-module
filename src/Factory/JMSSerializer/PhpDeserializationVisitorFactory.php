<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

use Detail\Normalization\JMSSerializer\PhpDeserializationVisitor;

class PhpDeserializationVisitorFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PhpDeserializationVisitor
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var PropertyNamingStrategyInterface $namingStrategy */
        $namingStrategy = $container->get('jms_serializer.naming_strategy');

        return new PhpDeserializationVisitor($namingStrategy);
    }
}
