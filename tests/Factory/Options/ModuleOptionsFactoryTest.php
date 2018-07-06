<?php

namespace DetailTest\Normalization\Factory\Options;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

use Detail\Normalization\Factory\Options\ModuleOptionsFactory;
use Detail\Normalization\Options\ModuleOptions;

use DetailTest\Normalization\Factory\FactoryTestCase;

/**
 * @method ModuleOptionsFactory getFactory()
 */
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

    protected function createFactory(): FactoryInterface
    {
        return new ModuleOptionsFactory();
    }

    private function createOptions(array $config): ModuleOptions
    {
        $services = $this->getServices();
        $services->get('Config')->willReturn($config);

        $options = $this->getFactory()->__invoke($services->reveal(), ModuleOptions::CLASS);

        return $options;
    }
}
