<?php

namespace Detail\Normalization\Factory\Normalizer;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

class JMSSerializerBasedNormalizerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber $doctrineProxySubscriber */
        $doctrineProxySubscriber = $serviceLocator->get(
            'Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber'
        );

        /** @var \JMS\Serializer\EventDispatcher\EventDispatcher $eventDispatcher */
        $eventDispatcher = $serviceLocator->get('jms_serializer.event_dispatcher');
        $eventDispatcher->setListeners(array()); // Remove default listeners/subscribers
        $eventDispatcher->addSubscriber($doctrineProxySubscriber); // Add our own version of the default subscriber to support HalCollection types

        /** @var \JMS\Serializer\Serializer $serializer */
        $serializer = $serviceLocator->get('jms_serializer.serializer');

        return new JMSSerializerBasedNormalizer($serializer);
    }
}
