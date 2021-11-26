<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Domain\Product\Model\Product;

class GetProductResponse
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function toArray(): array
    {
        return [
            'uuid' => (string) $this->product->getUuid(),
            'name' => (string) $this->product->getName(),
            'price' => $this->product->getPrice()->getAmount(),
            'currency' => (string) $this->product->getPrice()->getCurrency(),
        ];
    }
}
