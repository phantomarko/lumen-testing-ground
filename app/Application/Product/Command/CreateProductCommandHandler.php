<?php

namespace App\Application\Product\Command;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class CreateProductCommandHandler
{
    private ProductFactory $productFactory;
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductFactory $productFactory, ProductRepositoryInterface $productRepository)
    {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductCommand $command): Uuid
    {
        $product = $this->productFactory->create($command->getProductName(), $command->getPrice());
        $this->productRepository->save($product);

        return $product->getUuid();
    }
}
