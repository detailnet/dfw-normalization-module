<?php

namespace Detail\Normalization\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $normalizer;

    /**
     * @return string
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }

    /**
     * @param string $normalizer
     */
    public function setNormalizer($normalizer)
    {
        $this->normalizer = $normalizer;
    }
}
