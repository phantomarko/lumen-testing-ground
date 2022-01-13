<?php

namespace App\Domain\Product\Event;

use App\Domain\Core\Event\Event;

class ProductCreatedEvent extends Event
{
    private string $productUuid;

    public function __construct(string $productUuid)
    {
        $this->productUuid = $productUuid;
    }

    public function getProductUuid(): string
    {
        return $this->productUuid;
    }
}
