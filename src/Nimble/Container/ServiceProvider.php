<?php

namespace Nimble\Container;

use Illuminate\Contracts\Container\Container;

interface ServiceProvider
{
    public function register(Container $container);
}