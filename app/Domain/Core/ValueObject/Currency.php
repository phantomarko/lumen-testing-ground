<?php

namespace App\Domain\Core\ValueObject;

use App\Domain\Core\Exception\CurrencyNotValidException;

final class Currency extends StringValueObject
{
    private const EURO = 'EUR';
    private const DOLLAR = 'USD';
    private const AVAILABLE_CURRENCIES = [
        self::EURO,
        self::DOLLAR
    ];

    /**
     * @throws CurrencyNotValidException
     */
    protected function validate(string $value): void
    {
        if (!in_array($value, self::AVAILABLE_CURRENCIES)) {
            throw new CurrencyNotValidException($value);
        }
    }

    public static function createEuro(): self
    {
        return new self(self::EURO);
    }

    public static function createDollar(): self
    {
        return new self(self::DOLLAR);
    }
}
