<?php

require_once __DIR__ . '/../vendor/autoload.php';

use React\Http\Message\Response;
use Devhammed\ReactingToPhp\AppServer;

$bindAddress = '127.0.0.1:8080';

$appServer = new AppServer($bindAddress, function () {
    return Response::plaintext(
        "Hello World!\n"
    );
});

$appServer->listen();
