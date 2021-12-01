<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Domain\Product\Model\Product;
use App\Infrastructure\Core\Controller\Http\BaseResponse;

class ProductResponse extends BaseResponse
{
    public function __construct(Product $product)
    {
        parent::__construct($this->toArray($product));
    }

    private function toArray(Product $product): array
    {
        return [
            'uuid' => (string) $product->getUuid(),
            'name' => (string) $product->getName(),
            'price' => $product->getPrice()->getAmount(),
            'currency' => (string) $product->getPrice()->getCurrency(),
        ];
    }
}
