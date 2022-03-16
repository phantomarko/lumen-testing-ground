<?php

namespace App\Ui\Rest\Product\Response;

use App\Domain\Product\Model\Product;
use App\Ui\Rest\Core\Response\BaseResponse;

class ProductResponse extends BaseResponse
{
    public function __construct(Product $product)
    {
        parent::__construct($this->toArray($product));
    }

    private function toArray(Product $product): array
    {
        return [
            'uuid' => $product->getUuid(),
            'name' => $product->getName(),
            'price' => $product->getPriceAmount(),
            'currency' => $product->getPriceCurrency(),
        ];
    }
}
