<?php

namespace unit\Domain\Core\ValueObject;

use App\Domain\Core\Exception\CurrencyNotValidException;
use App\Domain\Core\Exception\ValueIsEmptyException;
use App\Domain\Core\ValueObject\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testCreate_empty_product_name()
    {
        $this->expectException(ValueIsEmptyException::class);

        new Currency(null);
    }

    public function testCreate_invalid_currency()
    {
        $this->expectException(CurrencyNotValidException::class);

        new Currency('BTC');
    }

    /**
     * @dataProvider create_currency_successfullyProvider
     */
    public function testCreate_currency_successfully(string $value)
    {
        $currency = new Currency($value);

        $this->assertEquals($value, $currency->getValue());
    }

    public function create_currency_successfullyProvider(): array
    {
        return [
            'EUR' =>  [Currency::euro()->getValue()],
            'USD' =>  [Currency::dollar()->getValue()],
        ];
    }
}
