<?php

namespace Nimble\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ActionHandler implements MiddlewareInterface
{
    /** @var Container */
    private $container;

    /**
     * ActionHandler constructor.
     * @param $handle
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $action = $this->container->get($request->getAttribute('action'));

        return $action($request);
    }
}