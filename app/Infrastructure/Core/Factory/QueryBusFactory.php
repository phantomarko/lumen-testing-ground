<?php

namespace App\Infrastructure\Core\Factory;

use App\Infrastructure\Core\Bus\QueryBus;

class QueryBusFactory
{
    private array $middleware;

    public function __construct(array $middleware)
    {
        $this->middleware = $middleware;
    }

    public function create(): QueryBus
    {
        return new QueryBus($this->middleware);
    }
}
