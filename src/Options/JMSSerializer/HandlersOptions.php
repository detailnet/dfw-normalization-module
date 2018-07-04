<?php

namespace Detail\Normalization\Options\JMSSerializer;

use Zend\Stdlib\AbstractOptions;

class HandlersOptions extends AbstractOptions
{
    /**
     * @var array
     */
    private $subscribers;

    public function getSubscribers(): array
    {
        return $this->subscribers;
    }

    public function setSubscribers(array $subscribers): void
    {
        $this->subscribers = $subscribers;
    }
}
