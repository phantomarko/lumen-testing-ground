<?php

namespace unit\Domain\Core\ValueObject;

use App\Domain\Core\Exception\PriceIsNegativeException;
use App\Domain\Core\Exception\ValueIsEmptyException;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /**
     * @dataProvider create_empty_priceProvider
     */
    public function testCreate_empty_price(?float $amount, ?string $currency)
    {
        $this->expectException(ValueIsEmptyException::class);

        new Price($amount, $currency);
    }

    public function testCreate_negative_price()
    {
        $this->expectException(PriceIsNegativeException::class);

        new Price(-1, Currency::dollar()->getValue());
    }

    /**
     * @dataProvider create_price_successfullyProvider
     */
    public function testCreate_price_successfully(float $amount, string $currency)
    {
        $price = new Price($amount, $currency);

        $this->assertEquals($amount, $price->getAmount());
        $this->assertEquals($currency, $price->getCurrency());
    }

    public function create_empty_priceProvider(): array
    {
        return [
            'empty amount' => [null, Currency::dollar()->getValue()],
            'empty currency' => [1, null],
            'both empty' => [null, null],
        ];
    }

    public function create_price_successfullyProvider(): array
    {
        return [
            'zero' => [0, Currency::dollar()->getValue()],
            'decimal' => [0.1, Currency::dollar()->getValue()],
            'integer' => [288, Currency::dollar()->getValue()],
        ];
    }
}
