<?php

namespace LoneStar;

use Illuminate\Contracts\Container\Container;
use Nimble\App;

class TutorialApp extends App
{
    public function registerServiceProviders(Container $container)
    {
        parent::registerServiceProviders($container);

        // this is where you can extend by registering your own service providers
    }
}