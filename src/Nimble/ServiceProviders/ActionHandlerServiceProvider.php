<?php

namespace Nimble\ServiceProviders;

use Illuminate\Contracts\Container\Container;
use Nimble\Action\ActionHandler;
use Nimble\Action\Transformer\StringTransformer;
use Nimble\Container\ServiceProvider;
use Psr\Container\ContainerInterface;

class ActionHandlerServiceProvider implements ServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(ActionHandler::class, function (Container $container) {
            $psrContainer = $container->make(ContainerInterface::class);
            $stringTransformer = $container->make(StringTransformer::class);

            return new ActionHandler($psrContainer, $stringTransformer);
        });
    }
}