<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

class XmlDeserializationVisitorFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return XmlDeserializationVisitor
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var PropertyNamingStrategyInterface $namingStrategy */
        $namingStrategy = $container->get('jms_serializer.naming_strategy');

        return new XmlDeserializationVisitor($namingStrategy);
    }
}
