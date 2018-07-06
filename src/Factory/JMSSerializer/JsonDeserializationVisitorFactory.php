<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

class JsonDeserializationVisitorFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return JsonDeserializationVisitor
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var PropertyNamingStrategyInterface $namingStrategy */
        $namingStrategy = $container->get('jms_serializer.naming_strategy');

        return new JsonDeserializationVisitor($namingStrategy);
    }
}
