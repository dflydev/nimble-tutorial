<?php

namespace Nimble\Container;

use Illuminate\Contracts\Container\Container;
use Psr\Container\ContainerInterface;

class ContainerServiceProvider implements ServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(ContainerInterface::class, function ($container) {
            return new LaravelContainer($container);
        });
    }
}