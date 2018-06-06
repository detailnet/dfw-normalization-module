<?php

namespace DetailTest\Normalization\Factory\Options;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Normalization\Factory\Options\ModuleOptionsFactory;
use Detail\Normalization\Options\ModuleOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

class ModuleOptionsFactoryTest extends FactoryTestCase
{
    public function testRaisesExceptionIfMissingConfigurationOptions(): void
    {
        $this->expectException(ServiceNotCreatedException::CLASS);
        $this->expectExceptionMessage('Missing config option');
        $this->createOptions([]);
    }

    public function testCreatesOptions(): void
    {
        $options = $this->createOptions(['detail_normalization' => []]);

        $this->assertInstanceOf(ModuleOptions::CLASS, $options);
    }

    private function createOptions(array $config): ModuleOptions
    {
        $services = $this->getServices();
        $services->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->equalTo('Config'))
            ->will($this->returnValue($config));

        /** @var ServiceLocatorInterface $services */

        $factory = new ModuleOptionsFactory();
        $options = $factory($services, ModuleOptions::CLASS);

        return $options;
    }
}
