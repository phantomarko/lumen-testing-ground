<?php

namespace App\Domain\Core\ValueObject;

use App\Domain\Core\Exception\PriceIsNegativeException;
use App\Domain\Core\Exception\ValueIsEmptyException;

final class Price
{
    protected const VALUE_OBJECT_NAME = 'String';
    private float $amount;
    private Currency $currency;

    public function __construct(?float $amount, ?string $currency)
    {
        $this->validateAmount($amount);
        $currency = new Currency($currency); // the validation is delegated to the sub-value object

        $this->amount = $amount;
        $this->currency = $currency;
    }

    private function validateAmount(?float $amount): void
    {
        $this->isNotEmpty($amount);
        $this->isNotNegative($amount);
    }

    private function isNotEmpty(?float $amount): void
    {
        if (empty($amount) && $amount !== 0.0) {
            throw new ValueIsEmptyException(self::VALUE_OBJECT_NAME);
        }
    }

    private function isNotNegative(float $amount): void
    {
        if ($amount < 0) {
            throw new PriceIsNegativeException();
        }
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency->getValue();
    }

    public function __toString()
    {
        return $this->getAmount() . ' ' . $this->getCurrency();
    }
}
