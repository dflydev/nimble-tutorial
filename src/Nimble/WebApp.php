<?php

namespace Nimble;

use Illuminate\Contracts\Container\Container;
use Nimble\ServiceProviders\ActionHandlerServiceProvider;
use Nimble\ServiceProviders\NikicFastRouteServiceProvider;

class WebApp
{
    public static function webify(App $app, Container $container)
    {
        $app->makeAndRegisterServiceProviders($container, [
            NikicFastRouteServiceProvider::class,
            ActionHandlerServiceProvider::class,
        ]);
    }
}