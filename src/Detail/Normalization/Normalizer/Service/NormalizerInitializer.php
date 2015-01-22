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

            /** @var \Detail\Normalization\Options\ModuleOptions $moduleOptions */
            $moduleOptions = $serviceLocator->get('Detail\Normalization\Options\ModuleOptions');

            /** @var \Detail\Normalization\Normalizer\NormalizerInterface $normalizer */
            $normalizer = $serviceLocator->get($moduleOptions->getNormalizer());

            $instance->setNormalizer($normalizer);
        }
    }
}
