<?php

namespace Detail\Normalization\Factory\JMSSerializer\Handler;

use DateTime;
use Detail\Normalization\JMSSerializer\Handler\DateHandler;
use Detail\Normalization\Options\JMSSerializerOptions;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DateHandlerFactory implements
    FactoryInterface
{
    /**
     * @param string $requestedName
     * @return DateHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var JMSSerializerOptions $serializerOptions */
        $serializerOptions = $container->get(JMSSerializerOptions::CLASS);

        $timezone = $serializerOptions->getTimezone();

        if ($timezone === null) {
            $timezone = date_default_timezone_get();
        }

        return new DateHandler(DateTime::ISO8601, $timezone);
    }
}
