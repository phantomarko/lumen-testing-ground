<?php

namespace App\Domain\Product\Event;

use App\Domain\Core\Event\Event;
use App\Domain\Product\Model\Product;

class ProductCreated extends Event
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
