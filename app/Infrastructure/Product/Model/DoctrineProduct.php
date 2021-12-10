<?php

namespace App\Infrastructure\Product\Model;

use App\Domain\Product\Model\Product;

class DoctrineProduct
{
    private string $uuid;
    private string $name;
    private float $priceAmount;
    private string $priceCurrency;

    public static function createFromProduct(Product $product): self
    {
        $doctrineProduct = new DoctrineProduct();

        $doctrineProduct->setUuid($product->getUuid());
        $doctrineProduct->setName($product->getName());
        $doctrineProduct->setPriceAmount($product->getPrice()->getAmount());
        $doctrineProduct->setPriceCurrency($product->getPrice()->getCurrency());

        return $doctrineProduct;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPriceAmount(): float
    {
        return $this->priceAmount;
    }

    public function setPriceAmount(float $priceAmount): void
    {
        $this->priceAmount = $priceAmount;
    }

    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }
}
