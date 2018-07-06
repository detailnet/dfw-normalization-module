<?php

namespace Detail\Normalization\Options\JMSSerializer;

use Zend\Stdlib\AbstractOptions;

class FileCacheOptions extends AbstractOptions
{
    /**
     * @var string|null
     */
    private $dir;

    public function getDir(): ?string
    {
        return $this->dir;
    }

    public function setDir(?string $dir): void
    {
        $this->dir = $dir;
    }
}
