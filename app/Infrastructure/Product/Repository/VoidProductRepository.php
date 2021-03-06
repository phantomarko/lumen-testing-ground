<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;

class VoidProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        // do nothing
    }

    public function findByUuid(Uuid $uuid): ?Product
    {
        return null;
    }
}
