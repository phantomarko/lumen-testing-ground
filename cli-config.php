<?php

/*
 * Doctrine Migrations main configuration
 */

require 'vendor/autoload.php';

use App\Infrastructure\Core\Factory\DoctrineEntityManagerFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;

$config = new PhpFile('migrations.php');

$entityManager = (new DoctrineEntityManagerFactory())->create();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
