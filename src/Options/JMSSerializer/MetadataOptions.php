<?php

namespace Detail\Normalization\Options\JMSSerializer;

use Zend\Stdlib\AbstractOptions;

class MetadataOptions extends AbstractOptions
{
    /**
     * @var array|FileCacheOptions
     */
    private $fileCache;

    /**
     * @var array
     */
    private $directories = [];

    public function getFileCache(): FileCacheOptions
    {
        if (is_array($this->fileCache)) {
            $this->fileCache = new FileCacheOptions($this->fileCache);
        }

        return $this->fileCache;
    }

    public function setFileCache(array $fileCache): void
    {
        $this->fileCache = $fileCache;
    }

    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function setDirectories(array $directories): void
    {
        $this->directories = $directories;
    }
}
