<?php

namespace App\Infrastructure\Core\Factory;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SymfonyContainerBuilderFactory
{
    private const PATH_PREFIX = __DIR__ . '/../../../../';
    private const SERVICE_ALIAS = 'container_builder';

    private string $yamlPath;

    /**
     * @param string $yamlPath The path of the yaml file from the project root dir
     */
    public function __construct(string $yamlPath)
    {
        $this->yamlPath = $yamlPath;
    }

    public function create(): ContainerBuilder
    {
        $containerBuilder = new ContainerBuilder();

        $loader = new YamlFileLoader(
            $containerBuilder,
            new FileLocator(self::PATH_PREFIX)
        );
        $loader->load($this->yamlPath);

        $containerBuilder->compile(true);

        $containerBuilder->set(self::SERVICE_ALIAS, $containerBuilder);

        return $containerBuilder;
    }
}
