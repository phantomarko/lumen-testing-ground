<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Product\Model\DoctrineProduct;
use Doctrine\ORM\EntityManager;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist(DoctrineProduct::createFromProduct($product));
        $this->entityManager->flush();
    }

    public function findByUuid(Uuid $uuid): ?Product
    {
        return null;
    }
}
