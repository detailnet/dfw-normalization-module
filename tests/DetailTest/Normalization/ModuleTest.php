<?php

namespace DetailTest\Normalization;

use PHPUnit\Framework\TestCase;

use Zend\Loader\StandardAutoloader;

use Detail\Normalization\Module;
use Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer;

class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    protected $module;

    protected function setUp()
    {
        $this->module = new Module();
    }

    public function testModuleProvidesAutoloaderConfig()
    {
        $config = $this->module->getAutoloaderConfig();

        $this->assertTrue(is_array($config));

        $autoloaderClass = StandardAutoloader::CLASS;

        $this->assertArrayHasKey($autoloaderClass, $config);
        $this->assertArrayHasKey('namespaces', $config[$autoloaderClass]);
        $this->assertArrayHasKey('Detail\Normalization', $config[$autoloaderClass]['namespaces']);
    }

    public function testModuleProvidesConfig()
    {
        $config = $this->module->getConfig();

        $this->assertTrue(is_array($config));
        $this->assertArrayHasKey('detail_normalization', $config);
        $this->assertTrue(is_array($config['detail_normalization']));
        $this->assertArrayHasKey('normalizer', $config['detail_normalization']);
        $this->assertEquals(
            JMSSerializerBasedNormalizer::CLASS,
            $config['detail_normalization']['normalizer']
        );
    }

    public function testModuleProvidesControllerConfig()
    {
        $config = $this->module->getControllerConfig();

        $this->assertTrue(is_array($config));
    }

    public function testModuleProvidesServiceConfig()
    {
        $config = $this->module->getServiceConfig();

        $this->assertTrue(is_array($config));
    }
}
