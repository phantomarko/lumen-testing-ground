<?php

namespace App\Infrastructure\Core\Factory;

use League\Tactician\CommandBus;

class TacticianCommandBusFactory
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
