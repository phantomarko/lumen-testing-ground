<?php

namespace App\Domain\Product\Repository;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;

interface ProductRepositoryInterface
{
    public function findByUuid(Uuid $uuid): ?Product;
}
