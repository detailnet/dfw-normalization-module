<?php

namespace DetailTest\Normalization\Options;

use Detail\Normalization\Options\ModuleOptions;

class ModuleOptionsTest extends OptionsTestCase
{
    /**
     * @var ModuleOptions
     */
    private $options;

    protected function setUp()
    {
        $this->options = $this->getOptions(
            ModuleOptions::CLASS,
            [
                'getNormalizer',
                'setNormalizer',
            ]
        );
    }

    public function testNormalizerCanBeSet(): void
    {
        $normalizer = 'Some\Normalizer\Class';

        $this->assertNull($this->options->getNormalizer());

        $this->options->setNormalizer($normalizer);

        $this->assertEquals($normalizer, $this->options->getNormalizer());
    }
}
