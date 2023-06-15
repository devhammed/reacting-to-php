<?php

namespace DevHammed\ReactingToPhp;

use Closure;
use React\Http\HttpServer;
use React\Socket\SocketServer;

class AppServer
{
    protected Closure $callback;

    protected HttpServer $httpServer;

    protected SocketServer $socketServer;

    public function __construct(
        protected string $bindAddress,
        Closure | array $callback,
    ) {
        $this->callback = Closure::fromCallable($callback);

        $this->httpServer = new HttpServer($this->callback);

        $this->socketServer = new SocketServer($this->bindAddress);
    }

    public function listen(): void
    {
        $this->httpServer->listen($this->socketServer);

        echo "Server running at http://$this->bindAddress\n";
    }
}
