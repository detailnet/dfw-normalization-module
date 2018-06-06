<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'aliases' => array(
            'jms_serializer.php_serialization_visitor'   => 'Detail\Normalization\JMSSerializer\PhpSerializationVisitor',
            'jms_serializer.php_deserialization_visitor' => 'Detail\Normalization\JMSSerializer\PhpDeserializationVisitor',
        ),
        'invokables' => array(
            'Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber' => 'Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber',
            'Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler'                     => 'Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler',
            'Detail\Normalization\JMSSerializer\Handler\DateHandler'                                => 'Detail\Normalization\JMSSerializer\Handler\DateHandler',
            'Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler'                       => 'Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler',

            // Add our own version of the default subscriber to support HalCollection types
            'jms_serializer.doctrine_proxy_subscriber' => 'Detail\Normalization\JMSSerializer\EventDispatcher\Subscriber\DoctrineProxySubscriber',
        ),
        'factories' => array(
            'Detail\Normalization\JMSSerializer\PhpSerializationVisitor'   => 'Detail\Normalization\Factory\JMSSerializer\PhpSerializationVisitorFactory',
            'Detail\Normalization\JMSSerializer\PhpDeserializationVisitor' => 'Detail\Normalization\Factory\JMSSerializer\PhpDeserializationVisitorFactory',
            'Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer' => 'Detail\Normalization\Factory\Normalizer\JMSSerializerBasedNormalizerFactory',
            'Detail\Normalization\Options\ModuleOptions'                   => 'Detail\Normalization\Factory\Options\ModuleOptionsFactory',
        ),
        'initializers' => array(
            'Detail\Normalization\Normalizer\NormalizerInitializer',
        ),
        'shared' => array(
        ),
    ),
    'controllers' => array(
        'initializers' => array(
            'Detail\Normalization\Normalizer\Service\NormalizerInitializer',
        ),
    ),
    'jms_serializer' => array(
        'naming_strategy' => 'identical',
        'visitors' => array(
            'serialization' => array(
                'php' => 'jms_serializer.php_serialization_visitor',
            ),
            'deserialization' => array(
                'php' => 'jms_serializer.php_deserialization_visitor',
            ),
        ),
        'handlers' => array(
            'subscribers' => array(
                'Detail\Normalization\JMSSerializer\Handler\ArrayCollectionHandler',
                'Detail\Normalization\JMSSerializer\Handler\DateHandler',
                'Detail\Normalization\JMSSerializer\Handler\DateImmutableHandler',
                'Detail\Normalization\JMSSerializer\Handler\PassThroughHandler',
                'Detail\Normalization\JMSSerializer\Handler\UuidHandler',
            ),
        ),
    ),
    'detail_normalization' => array(
        'normalizer' => 'Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer',
    ),
);
