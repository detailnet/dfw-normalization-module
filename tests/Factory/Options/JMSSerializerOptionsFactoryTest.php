<?php

namespace DetailTest\Normalization\Factory\Options;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Normalization\Factory\Options\JMSSerializerOptionsFactory;
use Detail\Normalization\Options\JMSSerializerOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

/**
 * @method JMSSerializerOptionsFactory getFactory()
 */
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

    protected function createFactory(): FactoryInterface
    {
        return new JMSSerializerOptionsFactory();
    }

    private function createOptions(array $config): JMSSerializerOptions
    {
        $services = $this->getServices();
        $services->get('Config')->willReturn($config);

        $options = $this->getFactory()->__invoke($services->reveal(), JMSSerializerOptions::CLASS);

        return $options;
    }
}
