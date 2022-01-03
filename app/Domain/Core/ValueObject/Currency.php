<?php

namespace App\Domain\Core\ValueObject;

use App\Domain\Core\Exception\CurrencyNotValidException;

final class Currency extends StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'Currency';
    private const EURO = 'EUR';
    private const DOLLAR = 'USD';
    private const AVAILABLE_CURRENCIES = [
        self::EURO,
        self::DOLLAR
    ];

    protected function validate(?string $value): void
    {
        $this->isNotEmpty($value);
        $this->isValidCurrency($value);
    }

    protected function isValidCurrency(string $value): void
    {
        if (!in_array($value, self::AVAILABLE_CURRENCIES)) {
            throw new CurrencyNotValidException($value);
        }
    }

    public static function euro(): self
    {
        return new self(self::EURO);
    }

    public static function dollar(): self
    {
        return new self(self::DOLLAR);
    }
}
