<?php

namespace Nimble\Container;

use Illuminate\Contracts\Container\Container;
use Psr\Container\ContainerInterface;

class LaravelContainer implements ContainerInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * LaravelContainer constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get($id)
    {
        return $this->container->make($id);
    }

    public function has($id)
    {
        if (class_exists($id)) {
            return true;
        }

        try {
            $reflectionClass = new \ReflectionClass($id);

            return $reflectionClass->isInstantiable();
        } catch (\ReflectionException $e) {
            return false;
        }
    }
}