<?php

namespace Detail\Normalization\Normalizer\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class NormalizerInitializer implements
    InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof NormalizerAwareInterface) {
            if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }

            /** @var \Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer $normalizer */
            $normalizer = $serviceLocator->get(
                'Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer'
            );

            $instance->setNormalizer($normalizer);
        }
    }
}
