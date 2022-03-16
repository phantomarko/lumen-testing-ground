<?php

namespace App\Application\Product\Query;

use App\Domain\Product\Model\Product;
use App\Domain\Product\Service\ProductFinder;

class GetProductsQueryHandler
{
    private ProductFinder $productFinder;

    public function __construct(ProductFinder $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    /**
     * @param   \App\Application\Product\Query\GetProductsQuery   $query
     *
     * @return Product[]
     */
    public function handle(GetProductsQuery $query) : array{
        return $this->productFinder->getAll();
    }
}
