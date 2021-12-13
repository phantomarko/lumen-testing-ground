<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function findByUuid(Uuid $uuid): ?Product
    {
        return $this->getRepository()->find($uuid);
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Product::class);
    }
}
