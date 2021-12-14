<?php

namespace App\Infrastructure\Core\Factory;

use League\Tactician\Bundle\Handler\ContainerBasedHandlerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TacticianCommandHandlerMiddlewareFactory
{
    private ContainerBuilder $containerBuilder;
    private array $mappings;

    public function __construct(ContainerBuilder $containerBuilder, array $mappings)
    {
        $this->containerBuilder = $containerBuilder;
        $this->mappings = $mappings;
    }

    public function create(): CommandHandlerMiddleware
    {
        $containerLocator = new ContainerBasedHandlerLocator(
            $this->containerBuilder,
            $this->mappings
        );

        return new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            $containerLocator,
            new HandleInflector()
        );
    }
}
