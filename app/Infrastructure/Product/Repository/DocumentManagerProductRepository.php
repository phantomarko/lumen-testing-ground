<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class DocumentManagerProductRepository implements ProductRepository
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function save(Product $product): void
    {
        $this->documentManager->persist($product);
    }

    public function findByUuid(Uuid $uuid): ?Product
    {
        return $this->getRepository()->find($uuid);
    }

    private function getRepository(): DocumentRepository
    {
        return $this->documentManager->getRepository(Product::class);
    }
}
