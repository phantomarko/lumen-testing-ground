<?php

namespace App\Infrastructure\Core\Factory;

use App\Infrastructure\Core\Bus\CommandBus;

class CommandBusFactory
{
    private array $middleware;

    public function __construct(array $middleware)
    {
        $this->middleware = $middleware;
    }

    public function create(): CommandBus
    {
        return new CommandBus($this->middleware);
    }
}
