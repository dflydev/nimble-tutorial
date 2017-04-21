<?php

namespace Nimble\Action\Transformer;

use Interop\Http\Factory\ResponseFactoryInterface;
use Nimble\Action\ViewTransformer;
use Psr\Http\Message\ServerRequestInterface;

class StringTransformer implements ViewTransformer
{
    /** @var ResponseFactoryInterface */
    private $responseFactory;

    /**
     * StringTransformer constructor.
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function canTransform(ServerRequestInterface $request, $response = null)
    {
        return is_string($response);
    }

    public function transform(ServerRequestInterface $request, $response = null)
    {
        $newResponse = $this->responseFactory->createResponse(200);
        $newResponse->getBody()->write($response);

        return $newResponse;
    }
}