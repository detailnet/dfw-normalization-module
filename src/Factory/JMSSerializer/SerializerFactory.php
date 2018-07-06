<?php

namespace Detail\Normalization\Factory\JMSSerializer;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\VisitorInterface;

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
        /** @var JMSSerializerOptions $serializerOptions */
        $serializerOptions = $container->get(JMSSerializerOptions::CLASS);

        $serializer = SerializerBuilder::create();
        $serializer->setDebug((bool) $serializerOptions->getDebug());

        $serializer->configureHandlers(
            function (HandlerRegistry $handlers) use ($serializerOptions, $container) {
                foreach ($serializerOptions->getHandlers()->getSubscribers() as $subscriberClass) {
                    /** @var SubscribingHandlerInterface $subscriber */
                    $subscriber = $container->get($subscriberClass);

                    $handlers->registerSubscribingHandler($subscriber);
                }
            }
        );

        $serializer->configureListeners(
            function (EventDispatcher $events) use ($serializerOptions, $container) {
                foreach ($serializerOptions->getEventDispatcher()->getSubscribers() as $subscriberClass) {
                    /** @var EventSubscriberInterface $subscriber */
                    $subscriber = $container->get($subscriberClass);

                    $events->addSubscriber($subscriber);
                }
            }
        );

        foreach ($serializerOptions->getVisitors()->getSerialization() as $format => $visitorName) {
            /** @var VisitorInterface $visitor */
            $visitor = $container->get($visitorName);

            $serializer->setSerializationVisitor($format, $visitor);
        }

        foreach ($serializerOptions->getVisitors()->getDeserialization() as $format => $visitorName) {
            /** @var VisitorInterface $visitor */
            $visitor = $container->get($visitorName);

            $serializer->setDeserializationVisitor($format, $visitor);
        }

        foreach ($serializerOptions->getMetadata()->getDirectories() as $directory) {
            $serializer->addMetadataDir(
                rtrim($directory->getPath(), '\\/'),
                $directory->getNamespacePrefix() ? rtrim($directory->getNamespacePrefix(), '\\') : ''
            );
        }

        $cacheDir = $serializerOptions->getMetadata()->getFileCache()->getDir();

        if ($cacheDir !== null) {
            $serializer->setCacheDir($cacheDir);
        }

        return $serializer->build();
    }
}
