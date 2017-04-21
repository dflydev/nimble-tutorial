<?php

namespace Nimble\Action;

use Psr\Http\Message\ServerRequestInterface;

interface ViewTransformer
{
    public function canTransform(ServerRequestInterface $request, $response = null);
    public function transform(ServerRequestInterface $request, $response = null);
}