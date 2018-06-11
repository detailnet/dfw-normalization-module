<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;

use JMS\Serializer\Serializer;

use Detail\Normalization\Factory\JMSSerializer\SerializerFactory;

use DetailTest\Normalization\Factory\FactoryTestCase;

class SerializerFactoryTest extends FactoryTestCase
{
    public function testCreatesVisitor(): void
    {
        $services = $this->getServices();

        /** @var ServiceLocatorInterface $services */

        $factory = new SerializerFactory();
        $visitor = $factory($services, Serializer::CLASS);

        $this->assertInstanceOf(Serializer::CLASS, $visitor);
    }
}
