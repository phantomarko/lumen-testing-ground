<?php

namespace App\Infrastructure\Core\Bus;

use Doctrine\ODM\MongoDB\DocumentManager;
use League\Tactician\Middleware;
use Throwable;

class DocumentManagerTransactionMiddleware implements Middleware
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function execute($command, callable $next)
    {
        /*
         * MongoDB write operations are atomic on the level of a single document.
         *
         * Doctrine MongoDB ODM does not support multi-document transactions, but a workaround could be made if it is
         * needed https://docs.mongodb.com/manual/core/transactions/
         */
        try {
            $returnValue = $next($command);

            $this->documentManager->flush();
        } catch (Throwable $e) {
            // do nothing
            throw $e;
        }

        return $returnValue;
    }
}
