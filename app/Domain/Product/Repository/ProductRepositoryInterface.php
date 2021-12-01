<?php

namespace App\Domain\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function findByUuid(Uuid $uuid): ?Product;
}
