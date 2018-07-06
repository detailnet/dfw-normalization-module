<?php

namespace DetailTest\Normalization\Factory\JMSSerializer;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Naming\PropertyNamingStrategyInterface;
use JMS\Serializer\Serializer;

use Detail\Normalization\Factory\JMSSerializer\SerializerFactory;
use Detail\Normalization\Options\JMSSerializer\EventDispatcherOptions;
use Detail\Normalization\Options\JMSSerializer\FileCacheOptions;
use Detail\Normalization\Options\JMSSerializer\HandlersOptions;
use Detail\Normalization\Options\JMSSerializer\MetadataOptions;
use Detail\Normalization\Options\JMSSerializer\VisitorsOptions;
use Detail\Normalization\Options\JMSSerializerOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

class SerializerFactoryTest extends FactoryTestCase
{
    public function testCreatesSerializerWithDefaultOptions(): void
    {
        $handlers = $this->prophesize(HandlersOptions::CLASS);
        $handlers->getSubscribers()->willReturn([]);

        $events = $this->prophesize(EventDispatcherOptions::CLASS);
        $events->getSubscribers()->willReturn([]);

        $visitors = $this->prophesize(VisitorsOptions::CLASS);
        $visitors->getSerialization()->willReturn([]);
        $visitors->getDeserialization()->willReturn([]);

        $fileCache = $this->prophesize(FileCacheOptions::CLASS);
//        $fileCache->getDir()->willReturn('');

        $metadata = $this->prophesize(MetadataOptions::CLASS);
        $metadata->getFileCache()->willReturn($fileCache->reveal());
        $metadata->getDirectories()->willReturn([]);

        $serializerOptions = $this->prophesize(JMSSerializerOptions::CLASS);
        $serializerOptions->getDebug()->willReturn(null);
        $serializerOptions->getHandlers()->willReturn($handlers->reveal());
        $serializerOptions->getEventDispatcher()->willReturn($events->reveal());
        $serializerOptions->getMetadata()->willReturn($metadata->reveal());
        $serializerOptions->getVisitors()->willReturn($visitors->reveal());

        $namingStrategy = $this->prophesize(PropertyNamingStrategyInterface::CLASS);

        $services = $this->getServices();
        $services->get(JMSSerializerOptions::CLASS)->willReturn($serializerOptions->reveal());
        $services->get('jms_serializer.naming_strategy')->willReturn($namingStrategy->reveal());

        $serializer = $this->getFactory()->__invoke($services->reveal(), Serializer::CLASS);

        $this->assertInstanceOf(Serializer::CLASS, $serializer);
    }

    protected function createFactory(): FactoryInterface
    {
        return new SerializerFactory();
    }
}
