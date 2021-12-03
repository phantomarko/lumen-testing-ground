<?php

namespace App\Application\Product\Command;

class CreateProductCommand
{
    private ?string $name;
    private ?float $priceAmount;
    private ?string $priceCurrency;

    public function __construct(
        ?string $name,
        ?float $priceAmount,
        ?string $priceCurrency
    )
    {
        $this->name = $name;
        $this->priceAmount = $priceAmount;
        $this->priceCurrency = $priceCurrency;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPriceAmount(): ?float
    {
        return $this->priceAmount;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }
}
