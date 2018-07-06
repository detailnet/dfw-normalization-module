<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Naming\CacheNamingStrategy;
use JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;

use Detail\Normalization\Options\JMSSerializerOptions;

class NamingStrategyFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PropertyNamingStrategyInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var JMSSerializerOptions $serializerOptions */
        $serializerOptions = $container->get(JMSSerializerOptions::CLASS);
        $strategyName = sprintf('jms_serializer.naming_strategy.%s', $serializerOptions->getNamingStrategy());

        /** @var PropertyNamingStrategyInterface $strategy */
        $propertyStrategy = $container->get($strategyName);
        $annotationStrategy = new SerializedNameAnnotationStrategy($propertyStrategy);

        /** @todo Make cache optional/configurable */
        return new CacheNamingStrategy($annotationStrategy);
    }
}
