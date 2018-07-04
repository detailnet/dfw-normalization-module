<?php

namespace Detail\Normalization\Options;

use Zend\Stdlib\AbstractOptions;

class JMSSerializerOptions extends AbstractOptions
{
    /**
     * @var bool|null
     */
    private $debug;

    /**
     * @var string|null
     */
    private $namingStrategy;

    /**
     * @var array
     */
    private $visitors = [];

    /**
     * @var array|JMSSerializer\HandlersOptions
     */
    private $handlers = [];

    /**
     * @var array|JMSSerializer\MetadataOptions
     */
    private $metadata = [];

    /**
     * @var array|JMSSerializer\EventDispatcherOptions
     */
    private $eventDispatcher = [];

    public function getDebug(): ?bool
    {
        return $this->debug;
    }

    public function setDebug(?bool $debug): void
    {
        $this->debug = $debug;
    }

    public function getNamingStrategy(): ?string
    {
        return $this->namingStrategy;
    }

    public function setNamingStrategy(?string $namingStrategy): void
    {
        $this->namingStrategy = $namingStrategy;
    }

    public function getVisitors(): array
    {
        return $this->visitors;
    }

    public function setVisitors(array $visitors): void
    {
        $this->visitors = $visitors;
    }

    public function getHandlers(): JMSSerializer\HandlersOptions
    {
        if (is_array($this->handlers)) {
            $this->handlers = new JMSSerializer\HandlersOptions($this->handlers);
        }

        return $this->handlers;
    }

    public function setHandlers(array $handlers): void
    {
        $this->handlers = $handlers;
    }

    public function getMetadata(): JMSSerializer\MetadataOptions
    {
        if (is_array($this->metadata)) {
            $this->metadata = new JMSSerializer\MetadataOptions($this->metadata);
        }

        return $this->metadata;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function getEventDispatcher(): JMSSerializer\EventDispatcherOptions
    {
        if (is_array($this->eventDispatcher)) {
            $this->eventDispatcher = new JMSSerializer\EventDispatcherOptions($this->eventDispatcher);
        }

        return $this->eventDispatcher;
    }

    public function setEventDispatcher(array $eventDispatcher): void
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}
