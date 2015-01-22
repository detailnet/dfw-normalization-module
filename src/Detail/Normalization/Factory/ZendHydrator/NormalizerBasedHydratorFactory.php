<?php

namespace Detail\Normalization\Factory\ZendHydrator;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class NormalizerBasedHydratorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @todo Make normalizer service name configurable */
        /** @var \Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer $normalizer */
        $normalizer = $serviceLocator->get('Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer');

        return new NormalizerBasedHydrator($normalizer);
    }
}
