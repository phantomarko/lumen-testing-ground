<?php

namespace App\Infrastructure\Core\Factory;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;

class DoctrineEntityManagerFactory
{
    public function create(): EntityManager
    {
        $isDevMode = true;

        $projectRootDir = __DIR__ . '/../../../..';
        $namespaces = array(
            $projectRootDir . '/app/Infrastructure/Product/Model/Mappings' => 'App\Infrastructure\Product\Model',
        );
        $driver = new SimplifiedXmlDriver($namespaces);
        $driver->setGlobalBasename('global'); // global.orm.xml

        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setProxyDir(sys_get_temp_dir());
        $config->setProxyNamespace('DoctrineProxies');
        $config->setAutoGenerateProxyClasses($isDevMode);

        $dbParams = array(
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => '33006',
            'user' => 'root',
            'password' => 'mys3cur3p4ss',
            'dbname' => 'lumen-test',
        );

        return EntityManager::create($dbParams, $config);
    }
}
