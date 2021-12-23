<?php

namespace App\Infrastructure\Core\Factory;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ODM\MongoDB\Types\Type;
use MongoDB\Client;

class DoctrineDocumentManagerFactory
{
    private const PATH_PREFIX = __DIR__ . '/../../../../';

    private string $connectionUri;
    private array $connectionUriOptions;
    private string $database;
    private array $entitiesMappings;
    private array $customTypeMappings;

    public function __construct(
        string $connectionUri,
        array $connectionUriOptions,
        string $database,
        array $entitiesMappings,
        array $customTypeMappings
    ) {
        $this->connectionUri = $connectionUri;
        $this->connectionUriOptions = $connectionUriOptions;
        $this->database = $database;
        $this->entitiesMappings = $this->convertMappingsProjectPathsToRelativePaths($entitiesMappings);
        $this->customTypeMappings = $customTypeMappings;
    }


    public function create(): DocumentManager
    {
        $this->registerCustomMappingTypes($this->customTypeMappings);

        $client = new Client($this->connectionUri, $this->connectionUriOptions);

        $driver = new SimplifiedXmlDriver($this->entitiesMappings);
        $driver->setGlobalBasename('global');

        $config = new Configuration();
        $config->setProxyDir(sys_get_temp_dir());
        $config->setProxyNamespace('Proxies');
        $config->setHydratorDir(sys_get_temp_dir());
        $config->setHydratorNamespace('Hydrators');
        $config->setDefaultDB($this->database);
        $config->setMetadataDriverImpl($driver);

        return DocumentManager::create($client, $config);
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
