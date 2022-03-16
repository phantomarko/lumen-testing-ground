<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class EntityManagerProductRepository implements ProductRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function findByUuid(Uuid $uuid): ?Product
    {
        return $this->getRepository()->find($uuid);
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Product::class);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }
}
