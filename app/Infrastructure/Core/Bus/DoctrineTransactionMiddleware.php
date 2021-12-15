<?php

namespace App\Infrastructure\Core\Bus;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use League\Tactician\Middleware;
use Throwable;

class DoctrineTransactionMiddleware implements Middleware
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute($command, callable $next)
    {
        $this->entityManager->beginTransaction();

        try {
            $returnValue = $next($command);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->rollbackTransaction();

            throw $e;
        } catch (Throwable $e) {
            $this->rollbackTransaction();

            throw $e;
        }

        return $returnValue;
    }

    protected function rollbackTransaction(): void
    {
        $this->entityManager->rollback();

        $connection = $this->entityManager->getConnection();
        if ($connection->isTransactionActive() && !$connection->isRollbackOnly()) {
            return;
        }

        $this->entityManager->close();
    }
}

{
}
