<?php

namespace App\Infrastructure\Core\Factory;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;

class DoctrineEntityManagerFactory
{
    private const PATH_PREFIX = __DIR__ . '/../../../../';

    private array $connectionConfiguration;
    private array $mappings;
    private bool $devMode;

    public function __construct(array $connectionConfiguration, array $mappings, bool $devMode = false)
    {
        $this->connectionConfiguration = $connectionConfiguration;
        $this->mappings = $this->convertMappingsProjectPathsToRelativePaths($mappings);
        $this->devMode = $devMode;
    }

    public function create(): EntityManager
    {
        $driver = new SimplifiedXmlDriver($this->mappings);
        $driver->setGlobalBasename('global'); // global.orm.xml

        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setProxyDir(sys_get_temp_dir());
        $config->setProxyNamespace('DoctrineProxies');
        $config->setAutoGenerateProxyClasses($this->devMode);

        return EntityManager::create($this->connectionConfiguration, $config);
    }

    private function convertMappingsProjectPathsToRelativePaths(array $mappings): array
    {
        $updatedMappings = [];
        foreach ($mappings as $path => $namespace) {
            $updatedMappings[self::PATH_PREFIX . $path] = $namespace;
        }

        return $updatedMappings;
    }
}
