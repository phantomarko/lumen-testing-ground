<?php

namespace unit\Application\Product\Query;

use App\Application\Product\Exception\ProductNotFoundException;
use App\Application\Product\Query\GetProductQuery;
use App\Application\Product\Query\GetProductQueryHandler;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use App\Infrastructure\Product\Repository\RandomPokemonProductRepository;
use App\Infrastructure\Product\Repository\VoidProductRepository;
use PHPUnit\Framework\TestCase;

class GetProductQueryHandlerTest extends TestCase
{
    public function testProduct_not_exists()
    {
        $uuid = (new RamseyUuidGenerator())->generate();
        $query = $this->buildGetProductQuery($uuid);
        $queryHandler = $this->buildGetProductQueryHandler(new VoidProductRepository());

        $this->expectException(ProductNotFoundException::class);
        $queryHandler->handle($query);
    }
    public function testProduct_exists()
    {
        $uuid = (new RamseyUuidGenerator())->generate();
        $query = $this->buildGetProductQuery($uuid);
        $queryHandler = $this->buildGetProductQueryHandler(new RandomPokemonProductRepository());

        $product = $queryHandler->handle($query);

        $this->assertEquals((string)$uuid, (string)$product->getUuid());
    }

    private function buildGetProductQueryHandler(ProductRepositoryInterface $productRepository): GetProductQueryHandler
    {
        return new GetProductQueryHandler($productRepository);
    }

    private function buildGetProductQuery(Uuid $uuid): GetProductQuery
    {
        return new GetProductQuery($uuid);
    }
}
