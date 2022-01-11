<?php

namespace App\Domain\Product\Model;

use App\Domain\Core\Event\Event;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreated;
use App\Domain\Product\ValueObject\ProductName;

class Product
{
    private Uuid $uuid;
    private ProductName $name;
    private Price $price;
    /** @var Event[]  */
    private array $events = [];

    public function __construct(Uuid $uuid, ProductName $name, Price $price)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->price = $price;

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

    private function addProductCreatedEvent(): void
    {
        $this->events[] = new ProductCreated($this->getCopy());
    }

    private function getCopy(): self{
        $clone = clone $this;
        $clone->takeEvents(); // clear events

        return $clone;
    }
}
