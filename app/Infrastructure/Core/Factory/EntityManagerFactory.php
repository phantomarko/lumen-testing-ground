<?php

namespace App\Infrastructure\Core\Factory;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;

class EntityManagerFactory
{
    private const PATH_PREFIX = __DIR__ . '/../../../../';

    private array $connectionParameters;
    private array $entitiesMappings;
    private array $customTypeMappings;
    private bool $devMode;

    public function __construct(
        array $connectionParameters,
        array $entitiesMappings,
        array $customTypeMappings,
        bool $devMode = false
    )
    {
        $this->connectionParameters = $connectionParameters;
        $this->entitiesMappings = $this->convertMappingsProjectPathsToRelativePaths($entitiesMappings);
        $this->customTypeMappings = $customTypeMappings;
        $this->devMode = $devMode;
    }

    public function create(): EntityManager
    {
        $this->registerCustomMappingTypes($this->customTypeMappings);

        $driver = new SimplifiedXmlDriver($this->entitiesMappings);
        $driver->setGlobalBasename('global'); // global.orm.xml

        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setProxyDir(sys_get_temp_dir());
        $config->setProxyNamespace('DoctrineProxies');
        $config->setAutoGenerateProxyClasses($this->devMode);

        return EntityManager::create($this->connectionParameters, $config);
    }

    private function convertMappingsProjectPathsToRelativePaths(array $mappings): array
    {
        $updatedMappings = [];
        foreach ($mappings as $path => $namespace) {
            $updatedMappings[self::PATH_PREFIX . $path] = $namespace;
        }

        return $updatedMappings;
    }

    private function registerCustomMappingTypes(array $customMappingTypes): void
    {
        foreach ($customMappingTypes as $typeName => $typeClass) {
            Type::addType(
                $typeName,
                $typeClass
            );
        }
    }
}
