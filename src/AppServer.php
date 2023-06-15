<?php

namespace DevHammed\ReactingToPhp;

use React\Http\HttpServer;
use React\Socket\SocketServer;

class AppServer
{
    protected HttpServer $httpServer;

    protected SocketServer $socketServer;

    public function __construct(protected string $bindAddress, ...$handlers)
    {
        $this->httpServer = new HttpServer(...$handlers);

        $this->socketServer = new SocketServer($this->bindAddress);
    }

    public function start(): void
    {
        $this->httpServer->listen($this->socketServer);

        echo "Server running at http://$this->bindAddress\n";
    }
}
