<?php

namespace Detail\Normalization\Factory\Normalizer;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

class JMSSerializerBasedNormalizerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \JMS\Serializer\Serializer $serializer */
        $serializer = $serviceLocator->get('jms_serializer.serializer');

        return new JMSSerializerBasedNormalizer($serializer);
    }
}
