<?php

namespace unit\Application\Product\Query;

use App\Domain\Product\Exception\ProductNotFoundException;
use App\Infrastructure\Product\Repository\RandomPokemonProductRepository;
use App\Infrastructure\Product\Repository\VoidProductRepository;
use PHPUnit\Framework\TestCase;
use unit\ProductTestingTrait;

class GetProductQueryHandlerTest extends TestCase
{
    use ProductTestingTrait;

    public function testProduct_not_exists()
    {
        $uuid = $this->generateUuid();
        $query = $this->buildGetProductQuery($uuid);
        $queryHandler = $this->buildGetProductQueryHandler(
            $this->buildProductFinder(new VoidProductRepository())
        );

        $this->expectException(ProductNotFoundException::class);
        $queryHandler->handle($query);
    }

    public function testProduct_exists()
    {
        $uuid = $this->generateUuid();
        $query = $this->buildGetProductQuery($uuid);
        $queryHandler = $this->buildGetProductQueryHandler(
            $this->buildProductFinder(new RandomPokemonProductRepository())
        );

        $product = $queryHandler->handle($query);

        $this->assertEquals($uuid, $product->getUuid()->getValue());
    }
}
