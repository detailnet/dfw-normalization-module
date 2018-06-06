<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\ServiceLocatorInterface;

use JMS\Serializer\Naming\PropertyNamingStrategyInterface;

use Detail\Normalization\Factory\JMSSerializer\PhpSerializationVisitorFactory;
use Detail\Normalization\JMSSerializer\PhpSerializationVisitor;

use DetailTest\Normalization\Factory\FactoryTestCase;

class PhpSerializationVisitorFactoryTest extends FactoryTestCase
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

        $factory = new PhpSerializationVisitorFactory();
        $visitor = $factory($services, PhpSerializationVisitor::CLASS);

        $this->assertInstanceOf(PhpSerializationVisitor::CLASS, $visitor);
    }
}
