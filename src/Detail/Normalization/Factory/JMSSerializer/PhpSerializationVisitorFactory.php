<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Detail\Normalization\JMSSerializer\PhpSerializationVisitor;

class PhpSerializationVisitorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PhpSerializationVisitor(
            $serviceLocator->get('jms_serializer.naming_strategy')
        );
    }
}
