<?php

namespace Detail\Normalization\Factory\Normalizer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Serializer as JMSSerializer;

use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

class JMSSerializerBasedNormalizerFactory implements
    FactoryInterface
{
    /**
     * Create JMSSerializerBasedNormalizer
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return JMSSerializerBasedNormalizer
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var JMSSerializer $serializer */
        $serializer = $container->get('jms_serializer.serializer');

        return new JMSSerializerBasedNormalizer($serializer);
    }
}
