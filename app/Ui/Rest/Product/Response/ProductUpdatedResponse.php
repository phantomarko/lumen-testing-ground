<?php

namespace App\Ui\Rest\Product\Response;

use App\Domain\Product\Model\Product;
use App\Ui\Rest\Core\Response\BaseResponse;

class ProductUpdatedResponse extends BaseResponse
{
    private function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @param   \App\Domain\Product\Model\Product   $product
     *
     * @return static
     */
    public static function make(Product $product) : self
    {
        return new self(self::toArray($product));
    }


    protected static function toArray(Product $product): array
    {
        return [
            'uuid' => $product->getUuid(),
            'name' => $product->getName(),
            'price' => $product->getPriceAmount(),
            'currency' => $product->getPriceCurrency(),
        ];
    }
}
