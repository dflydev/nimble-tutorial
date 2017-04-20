<?php

namespace Nimble;


use Illuminate\Contracts\Container\Container;
use Nimble\Container\ContainerServiceProvider;
use Nimble\Container\ServiceProvider;

class App
{
    public function makeAndRegisterServiceProviders(
        Container $container,
        array $serviceProviderClassNames
    ) {
        foreach ($serviceProviderClassNames as $serviceProviderClassName) {
            /** @var ServiceProvider $serviceProvider */
            $serviceProvider = $container->make($serviceProviderClassName);

            $serviceProvider->register($container);
        }
    }

    public function registerServiceProviders(Container $container)
    {
        $this->makeAndRegisterServiceProviders($container, [
            ContainerServiceProvider::class,
        ]);
    }
}