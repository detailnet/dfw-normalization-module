<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Detail\Normalization\JMSSerializer\PhpDeserializationVistor;

class PhpDeserializationVisitorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PhpDeserializationVisitor(
            $serviceLocator->get('jms_serializer.naming_strategy'),
            $serviceLocator->get('jms_serializer.object_constructor')
        );
    }
}
