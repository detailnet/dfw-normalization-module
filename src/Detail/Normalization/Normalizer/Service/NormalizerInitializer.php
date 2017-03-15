<?php

namespace Detail\Normalization\Normalizer\Service;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Initializer\InitializerInterface;

use Detail\Normalization\Normalizer\NormalizerInterface;
use Detail\Normalization\Options\ModuleOptions;

class NormalizerInitializer implements
    InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param ContainerInterface $container
     * @param object $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof NormalizerAwareInterface) {
            /** @var ModuleOptions $moduleOptions */
            $moduleOptions = $container->get(ModuleOptions::CLASS);

            /** @var NormalizerInterface $normalizer */
            $normalizer = $container->get($moduleOptions->getNormalizer());

            $instance->setNormalizer($normalizer);
        }
    }
}
