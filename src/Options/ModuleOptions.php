<?php

namespace Detail\Normalization\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string|null
     */
    private $normalizer;

    public function getNormalizer(): ?string
    {
        return $this->normalizer;
    }

    public function setNormalizer(?string $normalizer)
    {
        $this->normalizer = $normalizer;
    }
}
