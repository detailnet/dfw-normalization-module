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
            'Detail\Normalization\JMSSerializer\Handler\HalCollectionHandler'                       => 'Detail\Normalization\JMSSerializer\Handler\HalCollectionHandler',
        ),
        'factories' => array(
            'Detail\Normalization\JMSSerializer\PhpSerializationVisitor'   => 'Detail\Normalization\Factory\JMSSerializer\PhpSerializationVisitorFactory',
            'Detail\Normalization\JMSSerializer\PhpDeserializationVisitor' => 'Detail\Normalization\Factory\JMSSerializer\PhpDeserializationVisitorFactory',
            'Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer' => 'Detail\Normalization\Factory\Normalizer\JMSSerializerBasedNormalizerFactory',
            'Detail\Normalization\Options\ModuleOptions'                   => 'Detail\Normalization\Factory\Options\ModuleOptionsFactory',
            'Detail\Normalization\ZendHydrator\NormalizerBasedHydrator'    => 'Detail\Normalization\Factory\ZendHydrator\NormalizerBasedHydratorFactory',
        ),
        'initializers' => array(
            'Detail\Normalization\Normalizer\Service\NormalizerInitializer',
        ),
        'shared' => array(
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
                'Detail\Normalization\JMSSerializer\Handler\HalCollectionHandler',
            ),
        ),
    ),
    'zf-hal' => array(
        'renderer' => array(
            'default_hydrator' => 'Detail\Normalization\ZendHydrator\NormalizerBasedHydrator',
        ),
    ),
    'detail_normalization' => array(
        'normalizer' => 'Detail\Normalization\Normalizer\JMSSerializerBasedNormalizer',
    ),
);
