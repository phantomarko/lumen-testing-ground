<?php

namespace App\Application\Product\Query;

use App\Domain\Product\Model\Product;
use App\Domain\Product\Service\ProductFinder;

class GetProductQueryHandler
{
    private ProductFinder $productFinder;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function handle(GetProductQuery $query): Product
    {
        return $this->productFinder->byUuid($query->getUuid());
    }

    /**
     * @param   \App\Application\Product\Query\GetProductQuery   $query
     *
     * @return Product[]
     */
    public function handleAll(GetProductQuery $query) : array{
        return $this->productFinder->getAll();
    }
}
