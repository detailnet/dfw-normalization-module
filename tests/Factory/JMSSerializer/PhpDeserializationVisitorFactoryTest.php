<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\Factory\FactoryInterface;

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
        $services->get('jms_serializer.naming_strategy')->willReturn($namingStrategy);

        $visitor = $this->getFactory()->__invoke($services->reveal(), PhpDeserializationVisitor::CLASS);

        $this->assertInstanceOf(PhpDeserializationVisitor::CLASS, $visitor);
    }

    protected function createFactory(): FactoryInterface
    {
        return new PhpDeserializationVisitorFactory();
    }
}
