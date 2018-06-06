<?php

namespace DetailTest\Normalization\Normalizer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Normalization\Normalizer\NormalizerAwareInterface;
use Detail\Normalization\Normalizer\NormalizerInitializer;
use Detail\Normalization\Normalizer\NormalizerInterface;
use Detail\Normalization\Options\ModuleOptions;

class NormalizerInitializerTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $services;

    protected function setUp()
    {
        $this->services = $this->getMockBuilder(ServiceLocatorInterface::CLASS)->getMock();
    }

    public function testDoesNothingIfObjectDoesNotSupportNormalizer(): void
    {
        $object = new \stdClass();
        $services = $this->getServices();

        /** @var ServiceLocatorInterface $services */

        $initializer = new NormalizerInitializer();
        $initializer($services, $object);
    }

    public function testInjectsNormalizerIfObjectSupportsNormalizer(): void
    {
        $normalizerName = 'normalizer';

        $moduleOptions = $this->getMockBuilder(ModuleOptions::CLASS)->getMock();
        $moduleOptions->expects($this->atLeastOnce())
            ->method('getNormalizer')
            ->will($this->returnValue($normalizerName));

        $normalizer = $this->getMockBuilder(NormalizerInterface::CLASS)->getMock();

        $services = $this->getServices();
        $services->expects($this->at(0))
            ->method('get')
            ->with($this->equalTo(ModuleOptions::CLASS))
            ->will($this->returnValue($moduleOptions));
        $services->expects($this->at(1))
            ->method('get')
            ->with($this->equalTo($normalizerName))
            ->will($this->returnValue($normalizer));

        /** @var ServiceLocatorInterface $services */

        $object = $this->getMockBuilder(NormalizerAwareInterface::CLASS)
//            ->setMethods(['setNormalizer'])
            ->getMock();
        $object->expects($this->once())
            ->method('setNormalizer')
            ->with($this->equalTo($normalizer));

        $initializer = new NormalizerInitializer();
        $initializer($services, $object);
    }

    protected function getServices(): MockObject
    {
        return $this->services;
    }
}
