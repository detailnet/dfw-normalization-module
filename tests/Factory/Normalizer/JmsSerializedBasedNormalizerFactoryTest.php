<?php

namespace DetailTest\Normalization\Factory\Normalizer;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Serializer as JMSSerializer;

use Detail\Normalization\Factory\Normalizer\JMSSerializerBasedNormalizerFactory;
use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

use DetailTest\Normalization\Factory\FactoryTestCase;

/**
 * @method JMSSerializerBasedNormalizerFactory getFactory()
 */
class JmsSerializedBasedNormalizerFactoryTest extends FactoryTestCase
{
    public function testCreatesNormalizer(): void
    {
        $jmsSerializer = $this->getMockBuilder(JMSSerializer::CLASS)
            ->disableOriginalConstructor()
            ->getMock();

        $services = $this->getServices();
        $services->get('jms_serializer.serializer')->willReturn($jmsSerializer);

        $normalizer = $this->getFactory()->__invoke($services->reveal(), JMSSerializerBasedNormalizer::CLASS);

        $this->assertInstanceOf(JMSSerializerBasedNormalizer::CLASS, $normalizer);
    }

    protected function createFactory(): FactoryInterface
    {
        return new JMSSerializerBasedNormalizerFactory();
    }
}
