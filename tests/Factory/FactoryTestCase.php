<?php

namespace DetailTest\Normalization\Factory;

use PHPUnit\Framework\TestCase;

use Prophecy\Prophecy\ObjectProphecy;

use Interop\Container\ContainerInterface;

use Zend\ServiceManager\Factory\FactoryInterface;

abstract class FactoryTestCase extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    private $services;

    /**
     * @var FactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $this->services = $this->prophesize(ContainerInterface::CLASS);
        $this->factory = $this->createFactory();
    }

    protected function getServices(): ObjectProphecy
    {
        return $this->services;
    }

    protected function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    abstract protected function createFactory(): FactoryInterface;
}
