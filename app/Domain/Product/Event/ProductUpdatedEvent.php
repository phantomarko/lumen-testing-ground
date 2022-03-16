<?php

namespace App\Domain\Product\Event;

use App\Domain\Core\Event\Event;

class ProductUpdatedEvent extends Event
{

    public function __construct(private string $productUuid)
    {
    }

    public function getProductUuid(): string
    {
        return $this->productUuid;
    }
}
