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
use App\Infrastructure\Core\Service\RamseyUuidGenerator;

trait ProductTestingTrait
{
    public function generateUuid(): string
    {
        return (new RamseyUuidGenerator())->generate();
    }

    public function buildGetProductQuery(string $uuid): GetProductQuery
    {
        return new GetProductQuery($uuid);
    }

    public function buildGetProductQueryHandler(ProductFinder $productFinder): GetProductQueryHandler
    {
        return new GetProductQueryHandler($productFinder);
    }

    public function buildCreateProductCommand(
        ?string $name,
        ?float $priceAmount,
        ?string $priceCurrency
    ): CreateProductCommand {
        return new CreateProductCommand($name, $priceAmount, $priceCurrency);
    }

    public function buildCreateProductCommandHandler(
        ProductBuilder $productBuilder,
        ProductRepositoryInterface $productRepository
    ): CreateProductCommandHandler {
        return new CreateProductCommandHandler($productBuilder, $productRepository);
    }

    public function buildProductFinder(ProductRepositoryInterface $productRepository): ProductFinder
    {
        return new ProductFinder($productRepository);
    }

    public function buildProductBuilder(UuidGeneratorInterface $uuidGenerator): ProductBuilder
    {
        return new ProductBuilder($uuidGenerator);
    }
}
