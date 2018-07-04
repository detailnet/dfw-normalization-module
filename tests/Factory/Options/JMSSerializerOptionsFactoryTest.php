<?php

namespace DetailTest\Normalization\Factory\Options;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Normalization\Factory\Options\JMSSerializerOptionsFactory;
use Detail\Normalization\Options\JMSSerializerOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

class JMSSerializerOptionsFactoryTest extends FactoryTestCase
{
    public function testRaisesExceptionIfMissingConfigurationOptions(): void
    {
        $this->expectException(ServiceNotCreatedException::CLASS);
        $this->expectExceptionMessage('Missing config option');
        $this->createOptions([]);
    }

    public function testCreatesOptions(): void
    {
        $options = $this->createOptions(['jms_serializer' => []]);

        $this->assertInstanceOf(JMSSerializerOptions::CLASS, $options);
    }

    private function createOptions(array $config): JMSSerializerOptions
    {
        $services = $this->getServices();
        $services->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->equalTo('Config'))
            ->will($this->returnValue($config));

        /** @var ServiceLocatorInterface $services */

        $factory = new JMSSerializerOptionsFactory();
        $options = $factory($services, JMSSerializerOptions::CLASS);

        return $options;
    }
}
