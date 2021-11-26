<?php

namespace App\Domain\Core\ValueObject;

final class Price
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        $this->validateAmount($amount);
        $this->amount = $amount;
        $this->currency = $currency;
    }

    private function validateAmount($amount)
    {
        // TODO validate amount
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getPrice(): string
    {
        return $this->getAmount() . ' ' . $this->getCurrency()->getValue();
    }

    public function __toString()
    {
        return $this->getPrice();
    }
}
