<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class SerializerFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Serializer
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
//        /** @var PropertyNamingStrategyInterface $namingStrategy */
//        $namingStrategy = $container->get('jms_serializer.naming_strategy');

        $serializer = SerializerBuilder::create()->build();

        return $serializer;
    }
}
