<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class VoidProductRepository implements ProductRepositoryInterface
{
    public function findByUuid(Uuid $uuid): ?Product
    {
        return null;
    }
}
