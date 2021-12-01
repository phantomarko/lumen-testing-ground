<?php

namespace App\Domain\Product\Factory;

use App\Domain\Core\Service\UuidGeneratorInterface;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Product\Model\Product;
use App\Domain\Product\ValueObject\ProductName;

class ProductFactory
{
    private UuidGeneratorInterface $uuidGenerator;

    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function create(
        ProductName $productName,
        Price $price
    ): Product {
        return new Product(
            $this->uuidGenerator->generate(),
            $productName,
            $price
        );
    }
}
