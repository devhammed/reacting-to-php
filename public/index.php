<?php

require_once __DIR__ . '/../vendor/autoload.php';

use React\Http\Message\Response;
use Devhammed\ReactingToPhp\AppServer;
use Psr\Http\Message\ServerRequestInterface;

$bindAddress = '127.0.0.1:8080';

$appServer = new AppServer(
    $bindAddress,
    function (ServerRequestInterface $request, callable $next) {
        echo 'Middleware 1' . PHP_EOL;

        return $next($request);
    },
    function (ServerRequestInterface $request, callable $next) {
        echo 'Middleware 2 Before' . PHP_EOL;

        $response = $next($request);

        echo 'Middleware 2 After' . PHP_EOL;

        return $response;
    },
    function (ServerRequestInterface $request) {
        echo '[Handler] Request URL: ' . $request->getUri() . PHP_EOL;

        echo '[Handler] Request Method: ' . $request->getMethod() . PHP_EOL;

        return Response::plaintext(
            "Hello World!\n"
        );
    }
);

$appServer->listen();
