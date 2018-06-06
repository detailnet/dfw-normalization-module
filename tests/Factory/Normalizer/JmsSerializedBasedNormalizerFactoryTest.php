<?php

namespace DetailTest\Normalization\Factory\Normalizer;

use Zend\ServiceManager\ServiceLocatorInterface;

use JMS\Serializer\Serializer as JMSSerializer;

use Detail\Normalization\Factory\Normalizer\JMSSerializerBasedNormalizerFactory;
use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

use DetailTest\Normalization\Factory\FactoryTestCase;

class JmsSerializedBasedNormalizerFactoryTest extends FactoryTestCase
{
    public function testCreatesNormalizer(): void
    {
        $jmsSerializer = $this->getMockBuilder(JMSSerializer::CLASS)
            ->disableOriginalConstructor()
            ->getMock();

        $services = $this->getServices();
        $services->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->equalTo('jms_serializer.serializer'))
            ->will($this->returnValue($jmsSerializer));

        /** @var ServiceLocatorInterface $services */

        $factory = new JMSSerializerBasedNormalizerFactory();
        $normalizer = $factory($services, JMSSerializerBasedNormalizer::CLASS);

        $this->assertInstanceOf(JMSSerializerBasedNormalizer::CLASS, $normalizer);
    }
}
