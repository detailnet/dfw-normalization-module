<?php

namespace DetailTest\Normalization;

use PHPUnit\Framework\TestCase;

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

    public function testModuleProvidesConfig(): void
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
}
