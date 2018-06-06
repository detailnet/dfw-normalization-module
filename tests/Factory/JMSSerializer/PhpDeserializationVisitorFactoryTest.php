<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;

use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

use Detail\Normalization\Factory\JMSSerializer\PhpDeserializationVisitorFactory;
use Detail\Normalization\JMSSerializer\PhpDeserializationVisitor;

use DetailTest\Normalization\Factory\FactoryTestCase;

class PhpDeserializationVisitorFactoryTest extends FactoryTestCase
{
    public function testCreatesVisitor(): void
    {
        $namingStrategy = $this->getMockBuilder(PropertyNamingStrategyInterface::CLASS)->getMock();

        $services = $this->getServices();
        $services->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->equalTo('jms_serializer.naming_strategy'))
            ->will($this->returnValue($namingStrategy));

        /** @var ServiceLocatorInterface $services */

        $factory = new PhpDeserializationVisitorFactory();
        $visitor = $factory($services, PhpDeserializationVisitor::CLASS);

        $this->assertInstanceOf(PhpDeserializationVisitor::CLASS, $visitor);
    }
}
