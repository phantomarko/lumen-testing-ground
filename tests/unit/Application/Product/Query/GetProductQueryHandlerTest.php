<?php

namespace unit\Application\Product\Query;

use App\Application\Product\Query\GetProductQuery;
use App\Application\Product\Query\GetProductQueryHandler;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Service\ProductFinder;
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
        $queryHandler = $this->buildGetProductQueryHandler(new ProductFinder(new VoidProductRepository()));

        $this->expectException(ProductNotFoundException::class);
        $queryHandler->handle($query);
    }
    public function testProduct_exists()
    {
        $uuid = (new RamseyUuidGenerator())->generate();
        $query = $this->buildGetProductQuery($uuid);
        $queryHandler = $this->buildGetProductQueryHandler(new ProductFinder(new RandomPokemonProductRepository()));

        $product = $queryHandler->handle($query);

        $this->assertEquals($uuid, $product->getUuid()->getValue());
    }

    private function buildGetProductQuery(string $uuid): GetProductQuery
    {
        return new GetProductQuery($uuid);
    }

    private function buildGetProductQueryHandler(ProductFinder $productFinder): GetProductQueryHandler
    {
        return new GetProductQueryHandler($productFinder);
    }
}
