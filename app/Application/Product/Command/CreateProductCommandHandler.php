<?php

namespace App\Application\Product\Command;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Builder\ProductBuilder;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class CreateProductCommandHandler
{
    private ProductBuilder $productBuilder;
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductBuilder $productBuilder, ProductRepositoryInterface $productRepository)
    {
        $this->productBuilder = $productBuilder;
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductCommand $command): Uuid
    {
        $product = $this->productBuilder
            ->generateUuid()
            ->addName($command->getName())
            ->addPrice($command->getPriceAmount(), $command->getPriceCurrency())
            ->build();
        $this->productRepository->save($product);

        return $product->getUuid();
    }
}
