<?php

namespace DetailTest\Normalization\Factory;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use Zend\ServiceManager\ServiceLocatorInterface;

abstract class FactoryTestCase extends TestCase
{
    /**
     * @var MockObject
     */
    private $services;

    protected function setUp()
    {
        $this->services = $this->getMockBuilder(ServiceLocatorInterface::CLASS)->getMock();
    }

    protected function getServices(): MockObject
    {
        return $this->services;
    }
}
