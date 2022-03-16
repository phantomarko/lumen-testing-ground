<?php

namespace App\Ui\Rest\Product\Response;

use App\Domain\Product\Model\Product;
use App\Ui\Rest\Core\Response\BaseResponse;

class ProductsResponse extends BaseResponse
{
    private function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @param   Product[]   $products
     *
     * @return static
     */
    public static function make(array $products) : self
    {
        return new self(self::toArray($products));
    }

    /**
     * @param   \App\Domain\Product\Model\Product[]   $products
     *
     * @return array
     */
    protected static function toArray(array $products): array
    {
        return array_map( function (Product $product){
            return [
                'uuid'     => $product->getUuid(),
                'name'     => $product->getName(),
                'price'    => $product->getPriceAmount(),
                'currency' => $product->getPriceCurrency(),
            ];
        },$products);
    }
}
