<?php

namespace App\Domain\Product\Service;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;

class ProductFinder
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function byUuid(string $uuid): Product
    {
        $uuid = new Uuid($uuid);
        $product = $this->productRepository->findByUuid($uuid);

        if (empty($product)) {
            throw new ProductNotFoundException($uuid);
        }

        return $product;
    }
}
