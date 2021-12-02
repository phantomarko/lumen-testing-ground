<?php

namespace unit\Domain\Product\Factory;

use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Model\Product;
use App\Domain\Product\ValueObject\ProductName;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use PHPUnit\Framework\TestCase;

class ProductFactoryTest extends TestCase
{
    public function testCreate_product()
    {
        $name = new ProductName('test');
        $price = new Price(1, Currency::createEuro());
        $factory = new ProductFactory(new RamseyUuidGenerator());

        $product = $factory->create($name, $price);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotEmpty($product->getUuid());
        $this->assertEquals($name->getValue(), $product->getName()->getValue());
        $this->assertEquals($price->getAmount(), $product->getPrice()->getAmount());
        $this->assertEquals($price->getCurrency()->getValue(), $product->getPrice()->getCurrency()->getValue());
    }
}
