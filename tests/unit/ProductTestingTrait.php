<?php

namespace unit;

use App\Application\Product\Command\CreateProductCommand;
use App\Application\Product\Command\CreateProductCommandHandler;
use App\Application\Product\Query\GetProductQuery;
use App\Application\Product\Query\GetProductQueryHandler;
use App\Domain\Core\Service\UuidGeneratorInterface;
use App\Domain\Product\Builder\ProductBuilder;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Product\Service\ProductFinder;

trait ProductTestingTrait
{
    public function createGetProductQuery(string $uuid): GetProductQuery
    {
        return new GetProductQuery($uuid);
    }

    public function createGetProductQueryHandler(ProductFinder $productFinder): GetProductQueryHandler
    {
        return new GetProductQueryHandler($productFinder);
    }

    public function createCreateProductCommand(
        ?string $name,
        ?float $priceAmount,
        ?string $priceCurrency
    ): CreateProductCommand {
        return new CreateProductCommand($name, $priceAmount, $priceCurrency);
    }

    public function createCreateProductCommandHandler(
        ProductBuilder $productBuilder,
        ProductRepositoryInterface $productRepository
    ): CreateProductCommandHandler {
        return new CreateProductCommandHandler($productBuilder, $productRepository);
    }

    public function createProductFinder(ProductRepositoryInterface $productRepository): ProductFinder
    {
        return new ProductFinder($productRepository);
    }

    public function createProductBuilder(UuidGeneratorInterface $uuidGenerator): ProductBuilder
    {
        return new ProductBuilder($uuidGenerator);
    }
}
