<?php

namespace App\Domain\Product\Model;

use App\Domain\Core\Event\Event;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreatedEvent;
use App\Domain\Product\Event\ProductUpdatedEvent;
use App\Domain\Product\ValueObject\ProductName;

class Product
{
    /** @var Event[] */
    private array $events = [];

    public function __construct(private Uuid $uuid, private ProductName $name, private Price $price)
    {
        $this->addProductCreatedEvent();
    }

    public function getUuid(): string
    {
        return $this->uuid->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getPriceAmount(): float
    {
        return $this->price->getAmount();
    }

    public function getPriceCurrency(): string
    {
        return $this->price->getCurrency();
    }

    public function takeEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
    public function update(
        ?ProductName   $name,
        ?Price $price
    ){
        $this->name = $name ?? $this->name;
        $this->price = $price ?? $this->price;
        $this->addProductUpdatedEvent();
    }

    private function addProductCreatedEvent(): void
    {
        $this->events[] = new ProductCreatedEvent($this->getUuid());
    }

    private function addProductUpdatedEvent(): void
    {
        $this->events[] = new ProductUpdatedEvent($this->getUuid());
    }
}
