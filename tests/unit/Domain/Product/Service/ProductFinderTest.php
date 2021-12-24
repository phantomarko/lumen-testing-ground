<?php

namespace unit\Domain\Product\Service;

use App\Domain\Product\Exception\ProductNotFoundException;
use App\Infrastructure\Product\Repository\RandomPokemonProductRepository;
use App\Infrastructure\Product\Repository\VoidProductRepository;
use PHPUnit\Framework\TestCase;
use unit\CoreTestingTrait;
use unit\ProductTestingTrait;

class ProductFinderTest extends TestCase
{
    use ProductTestingTrait;
    use CoreTestingTrait;

    public function testProduct_not_exists()
    {
        $uuid = $this->generateUuid();
        $finder = $this->createProductFinder(new VoidProductRepository());

        $this->expectException(ProductNotFoundException::class);
        $finder->byUuid($uuid);
    }

    public function testProduct_exists()
    {
        $uuid = $this->generateUuid();
        $finder = $this->createProductFinder(new RandomPokemonProductRepository());

        $product = $finder->byUuid($uuid);

        $this->assertEquals($uuid, $product->getUuid());
    }
}
