<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

use Detail\Normalization\Options\JMSSerializerOptions;

class SerializerFactory implements
    FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Serializer
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
//        /** @var PropertyNamingStrategyInterface $namingStrategy */
//        $namingStrategy = $container->get('jms_serializer.naming_strategy');

        /** @var JMSSerializerOptions $serializerOptions */
        $serializerOptions = $container->get(JMSSerializerOptions::CLASS);

//        $serializerOptions->getNamingStrategy();

        $serializer = SerializerBuilder::create();
        $serializer->setDebug((bool) $serializerOptions->getDebug())
            ->addDefaultHandlers();

        $serializer->configureHandlers(
            function (HandlerRegistry $handlers) use ($serializerOptions, $container) {
                foreach ($serializerOptions->getHandlers()->getSubscribers() as $subscriberClass) {
                    /** @var SubscribingHandlerInterface $subscriber */
                    $subscriber = $container->get($subscriberClass);

                    $handlers->registerSubscribingHandler($subscriber);
                }
            }
        );

        $cacheDir = $serializerOptions->getMetadata()->getFileCache()->getDir();

        if ($cacheDir !== null) {
            $serializer->setCacheDir($cacheDir);
        }

        return $serializer->build();
    }
}
