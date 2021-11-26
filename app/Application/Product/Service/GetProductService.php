<?php

namespace App\Application\Product\Service;

use App\Application\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class GetProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ProductNotFoundException
     */
    public function execute(GetProductRequest $request): Product
    {
        $product = $this->productRepository->findByUuid($request->getUuid());

        if (empty($product)) {
            throw new ProductNotFoundException($request->getUuid());
        }

        return $product;
    }
}
