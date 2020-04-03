<?php

use Detail\Normalization;
use Detail\Normalization\Factory;

return [
    'service_manager' => [
        'aliases' => [
            'jms_serializer.naming_strategy.identical' => JMS\Serializer\Naming\IdenticalPropertyNamingStrategy::CLASS,
//            'jms_serializer.json_serialization_visitor' => JMS\Serializer\JsonSerializationVisitor::CLASS,
//            'jms_serializer.json_deserialization_visitor' => JMS\Serializer\JsonDeserializationVisitor::CLASS,
            'jms_serializer.php_serialization_visitor' => Normalization\JMSSerializer\PhpSerializationVisitor::CLASS,
            'jms_serializer.php_deserialization_visitor' => Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS,
//            'jms_serializer.xml_serialization_visitor' => JMS\Serializer\XmlSerializationVisitor::CLASS,
//            'jms_serializer.xml_deserialization_visitor' => JMS\Serializer\XmlDeserializationVisitor::CLASS,
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
            Normalization\JMSSerializer\Handler\UuidHandler::CLASS =>
                Normalization\JMSSerializer\Handler\UuidHandler::CLASS,
        ],
        'factories' => [
            // JMSSerializer
            Normalization\Options\JMSSerializerOptions::CLASS => Factory\Options\JMSSerializerOptionsFactory::CLASS,
//            JMS\Serializer\JsonSerializationVisitor::CLASS =>
//                Factory\JMSSerializer\JsonSerializationVisitorFactory::CLASS,
//            JMS\Serializer\JsonDeserializationVisitor::CLASS =>
//                Factory\JMSSerializer\JsonDeserializationVisitorFactory::CLASS,
            JMS\Serializer\Serializer::CLASS => Factory\JMSSerializer\SerializerFactory::CLASS,
//            JMS\Serializer\XmlSerializationVisitor::CLASS =>
//                Factory\JMSSerializer\XmlSerializationVisitorFactory::CLASS,
//            JMS\Serializer\XmlDeserializationVisitor::CLASS =>
//                Factory\JMSSerializer\XmlDeserializationVisitorFactory::CLASS,
            'jms_serializer.naming_strategy' => Factory\JMSSerializer\NamingStrategyFactory::CLASS,
            // Normalizer
            Normalization\JMSSerializer\Handler\DateHandler::CLASS =>
                Factory\JMSSerializer\Handler\DateHandlerFactory::CLASS,
            Normalization\JMSSerializer\PhpSerializationVisitor::CLASS =>
                Factory\JMSSerializer\PhpSerializationVisitorFactory::CLASS,
            Normalization\JMSSerializer\PhpDeserializationVisitor::CLASS =>
                Factory\JMSSerializer\PhpDeserializationVisitorFactory::CLASS,
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
//                'json' => 'jms_serializer.json_serialization_visitor',
                'php' => 'jms_serializer.php_serialization_visitor',
//                'xml' => 'jms_serializer.xml_serialization_visitor',
            ],
            'deserialization' => [
//                'json' => 'jms_serializer.json_deserialization_visitor',
                'php' => 'jms_serializer.php_deserialization_visitor',
//                'xml' => 'jms_serializer.xml_deserialization_visitor',
            ],
        ],
        'handlers' => [
            'subscribers' => [
                /** @todo Add handlers for PhpCollection and StdClass */
                Normalization\JMSSerializer\Handler\ArrayCollectionHandler::CLASS,
                Normalization\JMSSerializer\Handler\DateHandler::CLASS,
                Normalization\JMSSerializer\Handler\UuidHandler::CLASS,
            ],
        ],
        'eventdispatcher' => [
            'subscribers' => []
        ],
        'timezone' => null,
    ],
    'detail_normalization' => [
        'normalizer' => Normalization\Normalizer\JMSSerializerBasedNormalizer::CLASS,
    ],
];
