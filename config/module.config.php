<?php

return [
    'service_manager' => [
        'abstract_factories' => [
        ],
        'aliases' => [
            'jms_serializer.php_serialization_visitor' =>
                Detail\Normalization\JMSSerializer\PhpSerializationVisitor::CLASS,
            'jms_serializer.php_deserialization_visitor' =>
                Detail\Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS,
            'jms_serializer.serializer' =>
                JMS\Serializer\Serializer::CLASS,
        ],
        'invokables' => [
            Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS =>
                Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS,
            Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS =>
                Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS,
            Detail\Normalization\JMSSerializer\Handler\DateHandler::CLASS =>
                Detail\Normalization\JMSSerializer\Handler\DateHandler::CLASS,
            Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS =>
                Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS,

            // Add our own version of the default subscriber to support HalCollection types
            'jms_serializer.doctrine_proxy_subscriber' =>
                Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber::CLASS,
        ],
        'factories' => [
            // JMSSerializer
            JMS\Serializer\Serializer::CLASS => Detail\Normalization\Factory\JMSSerializer\SerializerFactory::CLASS,
            // Normalizer
            Detail\Normalization\JMSSerializer\PhpSerializationVisitor::CLASS =>
                Detail\Normalization\Factory\JMSSerializer\PhpSerializationVisitorFactory::CLASS,
            Detail\Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS =>
                Detail\Normalization\Factory\JMSSerializer\PhpDeserializationVisitorFactory::CLASS,
            Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer::CLASS =>
                Detail\Normalization\Factory\Normalizer\JMSSerializerBasedNormalizerFactory::CLASS,
            Detail\Normalization\Options\ModuleOptions::CLASS =>
                Detail\Normalization\Factory\Options\ModuleOptionsFactory::CLASS,
        ],
        'initializers' => [
            Detail\Normalization\Normalizer\NormalizerInitializer::CLASS,
        ],
        'shared' => [
        ],
    ],
    'controllers' => [
        'initializers' => [
            Detail\Normalization\Normalizer\NormalizerInitializer::CLASS,
        ],
    ],
    'jms_serializer' => [
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
                Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS,
                Detail\Normalization\JMSSerializer\Handler\DateHandler::CLASS,
                Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler::CLASS,
                Detail\Normalization\JMSSerializer\Handler\UuidHandler::CLASS,
            ],
        ],
    ],
    'detail_normalization' => [
        'normalizer' => Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer::CLASS,
    ],
];
