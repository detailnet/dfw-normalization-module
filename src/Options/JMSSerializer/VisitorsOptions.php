<?php

namespace Detail\Normalization\Options\JMSSerializer;

use Zend\Stdlib\AbstractOptions;

class VisitorsOptions extends AbstractOptions
{
    /**
     * @var array
     */
    private $serialization = [];

    /**
     * @var array
     */
    private $deserialization = [];

    public function getSerialization(): array
    {
        return $this->serialization;
    }

    public function setSerialization(array $serialization): void
    {
        $this->serialization = $serialization;
    }

    public function getDeserialization(): array
    {
        return $this->deserialization;
    }

    public function setDeserialization(array $deserialization): void
    {
        $this->deserialization = $deserialization;
    }
}
