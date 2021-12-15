<?php

namespace App\Infrastructure\Core\Factory;

use App\Infrastructure\Core\Bus\DoctrineTransactionMiddleware;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTransactionMiddlewareFactory
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(): DoctrineTransactionMiddleware
    {
        return new DoctrineTransactionMiddleware($this->entityManager);
    }
}
