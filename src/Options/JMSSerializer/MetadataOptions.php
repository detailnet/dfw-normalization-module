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
     * @var MetadataDirectoryOptions[]
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

    /**
     * @return MetadataDirectoryOptions[]
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function setDirectories(array $directories): void
    {
        $dirs = [];

        foreach ($directories as $directory) {
            if (is_array($directory)) {
                $directory = new MetadataDirectoryOptions($directory);
            }

            $dirs[] = $directory;
        }

        $this->directories = $dirs;
    }
}
