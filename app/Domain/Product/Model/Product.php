<?php

namespace App\Domain\Product\Model;

use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\ValueObject\ProductName;

class Product
{
    private Uuid $uuid;
    private ProductName $name;
    private Price $price;

    public function __construct(Uuid $uuid, ProductName $name, Price $price)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->price = $price;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
