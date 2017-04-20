<?php

namespace LoneStar\Http;

use Interop\Http\Factory\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * Home constructor.
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function __invoke(ServerRequestInterface $serverRequest)
    {
        $response = $this->responseFactory->createResponse(200);

        $response->getBody()->write('Hello Lone Star from a CLASS!!!');

        return $response;
    }
}