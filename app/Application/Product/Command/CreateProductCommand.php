<?php

namespace App\Application\Product\Command;

use App\Domain\Core\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductName;

class CreateProductCommand
{
    private ProductName $productName;
    private Price $price;

    public function __construct(
        ProductName $productName,
        Price $price
    )
    {
        $this->productName = $productName;
        $this->price = $price;
    }

    public function getProductName(): ProductName
    {
        return $this->productName;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
