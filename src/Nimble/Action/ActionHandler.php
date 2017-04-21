<?php

namespace Nimble\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ActionHandler implements MiddlewareInterface
{
    /** @var ContainerInterface */
    private $container;

    /** @var  ViewTransformer */
    private $viewTransformer;

    /**
     * ActionHandler constructor.
     * @param $handle
     */
    public function __construct(ContainerInterface $container, ViewTransformer $viewTransformer)
    {
        $this->container = $container;
        $this->viewTransformer = $viewTransformer;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $action = $this->container->get($request->getAttribute('action'));

        $response = $action($request);

        if ($response instanceof ResponseInterface) {
            return $response;
        }

        return $this->viewTransformer->transform($request, $response);
    }
}