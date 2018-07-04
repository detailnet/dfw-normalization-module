<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;

use JMS\Serializer\Serializer;

use Detail\Normalization\Factory\JMSSerializer\SerializerFactory;
use Detail\Normalization\Options\JMSSerializerOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

class SerializerFactoryTest extends FactoryTestCase
{
    public function testCreatesVisitor(): void
    {
        $jmsSerializerOptions = $this->getMockBuilder(JMSSerializerOptions::CLASS)->getMock();
        $jmsSerializerOptions->expects($this->any())
            ->method('getNamingStrategy')
            ->will($this->returnValue('identical'));

        $services = $this->getServices();
        $services->expects($this->once())
            ->method('get')
            ->with($this->equalTo(JMSSerializerOptions::CLASS))
            ->will($this->returnValue($jmsSerializerOptions));

        /** @var ServiceLocatorInterface $services */

        $factory = new SerializerFactory();
        $visitor = $factory($services, Serializer::CLASS);

        $this->assertInstanceOf(Serializer::CLASS, $visitor);
    }
}
