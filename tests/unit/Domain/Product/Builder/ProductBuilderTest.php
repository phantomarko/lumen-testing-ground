<?php

namespace unit\Domain\Product\Builder;

use App\Domain\Core\ValueObject\Currency;
use App\Domain\Product\Exception\RequiredProductParameterIsNullException;
use App\Domain\Product\Model\Product;
use PHPUnit\Framework\TestCase;
use unit\CoreTestingTrait;
use unit\ProductTestingTrait;

class ProductBuilderTest extends TestCase
{
    use ProductTestingTrait;
    use CoreTestingTrait;

    public function testBuild_product_successfully()
    {
        $name = 'test';
        $priceAmount = 1;
        $priceCurrency = Currency::euro()->getValue();
        $builder = $this->createProductBuilder($this->createRamseyUuidGenerator());

        $product = $builder
            ->generateUuid()
            ->addName($name)
            ->addPrice($priceAmount, $priceCurrency)
            ->build();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotEmpty($product->getUuid());
        $this->assertEquals($name, $product->getName()->getValue());
        $this->assertEquals($priceAmount, $product->getPrice()->getAmount());
        $this->assertEquals($priceCurrency, $product->getPrice()->getCurrency()->getValue());
    }

    public function testBuild_product_without_generating_an_uuid()
    {
        $name = 'test';
        $priceAmount = 1;
        $priceCurrency = Currency::euro()->getValue();
        $builder = $this->createProductBuilder($this->createRamseyUuidGenerator());

        $this->expectException(RequiredProductParameterIsNullException::class);
        $builder
            ->addName($name)
            ->addPrice($priceAmount, $priceCurrency)
            ->build();
    }

    /**
     * @dataProvider build_product_passing_a_required_parameterProvider
     */
    public function testBuild_product_passing_a_required_parameter(
        ?string $name,
        ?float $priceAmount,
        ?string $priceCurrency
    ) {
        $builder = $this->createProductBuilder($this->createRamseyUuidGenerator());

        $this->expectException(RequiredProductParameterIsNullException::class);
        $builder
            ->generateUuid()
            ->addName($name)
            ->addPrice($priceAmount, $priceCurrency)
            ->build();
    }

    public function build_product_passing_a_required_parameterProvider(): array
    {
        return [
            'null name' => [null, 1, Currency::euro()->getValue()],
            'null price amount' => ['test', null, Currency::euro()->getValue()],
            'null price currency' => ['test', 1, null],
        ];
    }
}
