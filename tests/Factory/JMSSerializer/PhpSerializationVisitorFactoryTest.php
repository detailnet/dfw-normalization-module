<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\Factory\FactoryInterface;

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
        $services->get('jms_serializer.naming_strategy')->willReturn($namingStrategy);

        $visitor = $this->getFactory()->__invoke($services->reveal(), PhpSerializationVisitor::CLASS);

        $this->assertInstanceOf(PhpSerializationVisitor::CLASS, $visitor);
    }

    protected function createFactory(): FactoryInterface
    {
        return new PhpSerializationVisitorFactory();
    }
}
