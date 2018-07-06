<?php

use Detail\Normalization;
use Detail\Normalization\Factory;

return [
    'service_manager' => [
        'aliases' => [
            'jms_serializer.naming_strategy.identical' => JMS\Serializer\Naming\IdenticalPropertyNamingStrategy::CLASS,
            'jms_serializer.php_serialization_visitor' => Normalization\JMSSerializer\PhpSerializationVisitor::CLASS,
            'jms_serializer.php_deserialization_visitor' => Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS,
            'jms_serializer.serializer' => JMS\Serializer\Serializer::CLASS,
        ],
        'invokables' => [
            // JMSSerializer
            JMS\Serializer\Naming\IdenticalPropertyNamingStrategy::CLASS =>
                JMS\Serializer\Naming\IdenticalPropertyNamingStrategy::CLASS,
            // Normalizer
            Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS =>
                Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS,
            Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS =>
                Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS,
            Normalization\JMSSerializer\Handler\DateHandler::CLASS =>
                Normalization\JMSSerializer\Handler\DateHandler::CLASS,
            Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS =>
                Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS,
            Normalization\JMSSerializer\Handler\UuidHandler::CLASS =>
                Normalization\JMSSerializer\Handler\UuidHandler::CLASS,

            // Add our own version of the default subscriber to support HalCollection types
            'jms_serializer.doctrine_proxy_subscriber' =>
                Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS,
        ],
        'factories' => [
            // JMSSerializer
            Normalization\JMSSerializer\PhpSerializationVisitor::CLASS =>
                Factory\JMSSerializer\PhpSerializationVisitorFactory::CLASS,
            Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS =>
                Factory\JMSSerializer\PhpDeserializationVisitorFactory::CLASS,
            Normalization\Options\JMSSerializerOptions::CLASS => Factory\Options\JMSSerializerOptionsFactory::CLASS,
            JMS\Serializer\Serializer::CLASS => Factory\JMSSerializer\SerializerFactory::CLASS,
            'jms_serializer.naming_strategy' => Factory\JMSSerializer\NamingStrategyFactory::CLASS,
            // Normalizer
            Normalization\Normalizer\JMSSerializerBasedNormalizer::CLASS =>
                Factory\Normalizer\JMSSerializerBasedNormalizerFactory::CLASS,
            Normalization\Options\ModuleOptions::CLASS => Factory\Options\ModuleOptionsFactory::CLASS,
        ],
        'initializers' => [
            Normalization\Normalizer\NormalizerInitializer::CLASS,
        ],
    ],
    'controllers' => [
        'initializers' => [
            Normalization\Normalizer\NormalizerInitializer::CLASS,
        ],
    ],
    'jms_serializer' => [
        'debug' => false,
        'naming_strategy' => 'identical',
        'visitors' => [
            'serialization' => [
                'php' => 'jms_serializer.php_serialization_visitor',
            ],
            'deserialization' => [
                'php' => 'jms_serializer.php_deserialization_visitor',
            ],
        ],
        'handlers' => [
            'subscribers' => [
                Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS,
                Normalization\JMSSerializer\Handler\DateHandler::CLASS,
                Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS,
                Normalization\JMSSerializer\Handler\UuidHandler::CLASS,
            ],
        ],
    ],
    'detail_normalization' => [
        'normalizer' => Normalization\Normalizer\JMSSerializerBasedNormalizer::CLASS,
    ],
];
