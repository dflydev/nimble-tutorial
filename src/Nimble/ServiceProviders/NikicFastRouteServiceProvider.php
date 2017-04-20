<?php

namespace Nimble\ServiceProviders;

use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use FastRoute\RouteParser;
use Illuminate\Contracts\Container\Container;
use LoneStar\Http\Home;
use LoneStar\Http\SpeakersDetail;
use Nimble\Container\ServiceProvider;

class NikicFastRouteServiceProvider implements ServiceProvider
{
    public function register(Container $container)
    {
        $container->bind(Dispatcher::class, function (Container $container) {
            $routeCollector = $container->make(RouteCollector::class);

            return new Dispatcher\GroupCountBased($routeCollector->getData());
        });

        $container->bind(RouteParser::class, RouteParser\Std::class);
        $container->bind(DataGenerator::class, DataGenerator\GroupCountBased::class);

        $container->afterResolving(RouteCollector::class, function (RouteCollector $routeCollector, Container $container) {
            $routeCollector->addRoute('GET', '/', Home::class);
            $routeCollector->addRoute('GET', '/speakers/{speaker_name}', SpeakersDetail::class);
        });

    }
}