<?php

namespace Nimble\Middleware\Routing\NikicFastRoute;

use FastRoute\Dispatcher;
use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class NikicFastRoute implements MiddlewareInterface
{
    /** @var Dispatcher */
    private $dispatcher;

    /** @var ResponseFactoryInterface */
    private $responseFactory;

    /**
     * NikicFastRoute constructor.
     * @param Dispatcher $dispatcher
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(Dispatcher $dispatcher, ResponseFactoryInterface $responseFactory)
    {
        $this->dispatcher = $dispatcher;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return $this->responseFactory->createResponse(404);
            case Dispatcher::METHOD_NOT_ALLOWED:
                return $this->responseFactory->createResponse(405);
            case Dispatcher::FOUND:
                $action = $routeInfo[1];
                $parameters = $routeInfo[2];

                return $delegate->process($request
                    ->withAttribute('action', $action)
                    ->withAttribute('parameters', $parameters));
        }
    }
}