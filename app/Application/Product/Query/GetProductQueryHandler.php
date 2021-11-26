<?php

namespace App\Application\Product\Query;

use App\Application\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class GetProductQueryHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ProductNotFoundException
     */
    public function handle(GetProductQuery $query): Product
    {
        $product = $this->productRepository->findByUuid($query->getUuid());

        if (empty($product)) {
            throw new ProductNotFoundException($query->getUuid());
        }

        return $product;
    }
}
