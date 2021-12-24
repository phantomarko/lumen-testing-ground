<?php

namespace unit\Application\Product\Query;

use App\Domain\Product\Exception\ProductNotFoundException;
use App\Infrastructure\Product\Repository\RandomPokemonProductRepository;
use App\Infrastructure\Product\Repository\VoidProductRepository;
use PHPUnit\Framework\TestCase;
use unit\CoreTestingTrait;
use unit\ProductTestingTrait;

class GetProductQueryHandlerTest extends TestCase
{
    use ProductTestingTrait;
    use CoreTestingTrait;

    public function testProduct_not_exists()
    {
        $uuid = $this->generateUuid();
        $query = $this->createGetProductQuery($uuid);
        $queryHandler = $this->createGetProductQueryHandler(
            $this->createProductFinder(new VoidProductRepository())
        );

        $this->expectException(ProductNotFoundException::class);
        $queryHandler->handle($query);
    }

    public function testProduct_exists()
    {
        $uuid = $this->generateUuid();
        $query = $this->createGetProductQuery($uuid);
        $queryHandler = $this->createGetProductQueryHandler(
            $this->createProductFinder(new RandomPokemonProductRepository())
        );

        $product = $queryHandler->handle($query);

        $this->assertEquals($uuid, $product->getUuid());
    }
}
