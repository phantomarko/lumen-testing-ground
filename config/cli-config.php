<?php

/*
 * Doctrine Migrations Commands configuration
 */

require 'vendor/autoload.php';

use App\Infrastructure\Core\Factory\DoctrineEntityManagerFactory;
use App\Infrastructure\Core\Factory\SymfonyContainerBuilderFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;

(new LoadEnvironmentVariables(
    dirname(__DIR__), '.env'
))->bootstrap();

$containerBuilder = (new SymfonyContainerBuilderFactory('config/services.yaml'))
    ->create();

/** @var DoctrineEntityManagerFactory $entityManagerFactory */
$entityManagerFactory = $containerBuilder->get('App\Infrastructure\Core\Factory\DoctrineEntityManagerFactory');
$entityManager = $entityManagerFactory->create();

return DependencyFactory::fromEntityManager(
    new PhpFile('config/migrations.php'),
    new ExistingEntityManager($entityManager)
);
