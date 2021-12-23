<?php

/*
 * Doctrine Migrations Commands configuration
 */

require 'vendor/autoload.php';

use App\Infrastructure\Core\Factory\EntityManagerFactory;
use App\Infrastructure\Core\Factory\ContainerBuilderFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;

(new LoadEnvironmentVariables(
    dirname(__DIR__), '.env'
))->bootstrap();

$containerBuilder = (new ContainerBuilderFactory('config/services.yaml'))
    ->create();

/** @var EntityManagerFactory $entityManagerFactory */
$entityManagerFactory = $containerBuilder->get('App\Infrastructure\Core\Factory\EntityManagerFactory');
$entityManager = $entityManagerFactory->create();

return DependencyFactory::fromEntityManager(
    new PhpFile('config/migrations.php'),
    new ExistingEntityManager($entityManager)
);
