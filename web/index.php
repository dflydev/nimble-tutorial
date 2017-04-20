<?php

namespace foo;

require_once __DIR__.'/../bootstrap/autoload.php';

use Http\Factory\Diactoros\ResponseFactory;
use Http\Factory\Diactoros\ServerRequestFactory;
use Illuminate\Container\Container;
use Interop\Http\Factory\ResponseFactoryInterface;
use LoneStar\TutorialApp;
use Nimble\Action\ActionHandler;
use Nimble\Middleware\Routing\NikicFastRoute\NikicFastRoute;
use Nimble\Middleware\StringTransformation;
use Nimble\WebApp;
use Psr\Http\Message\ServerRequestInterface;
use function Http\Response\send;

$container = new Container();

$container->bind(ResponseFactoryInterface::class, ResponseFactory::class);

$app = $container->make(TutorialApp::class);

$app->registerServiceProviders($container);

WebApp::webify($app, $container);

$requestServerFactory = new ServerRequestFactory();

$request = $requestServerFactory->createServerRequestFromArray($_SERVER);

$response = \Middlewares\Utils\Dispatcher::run([
    $container->make(NikicFastRoute::class),
    //$container->make(StringTransformation::class),
    $container->make(ActionHandler::class)
], $request);

send($response);
