<?php

namespace Detail\Normalization\Options\JMSSerializer;

use Zend\Stdlib\AbstractOptions;

class MetadataDirectoryOptions extends AbstractOptions
{
    /**
     * @var string|null
     */
    private $namespacePrefix;

    /**
     * @var string|null
     */
    private $path;

    public function getNamespacePrefix(): ?string
    {
        return $this->namespacePrefix;
    }

    public function setNamespacePrefix(?string $namespacePrefix): void
    {
        $this->namespacePrefix = $namespacePrefix;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }
}
