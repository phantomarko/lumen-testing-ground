<?php

namespace App\Application\Product\Command;

use App\Domain\Core\Event\EventDispatcher;
use App\Domain\Product\Builder\ProductBuilder;
use App\Domain\Product\Repository\ProductRepository;

class CreateProductCommandHandler
{
    private ProductBuilder $productBuilder;
    private ProductRepository $productRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(
        ProductBuilder $productBuilder,
        ProductRepository $productRepository,
        EventDispatcher $eventDispatcher
    )
    {
        $this->productBuilder = $productBuilder;
        $this->productRepository = $productRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateProductCommand $command): string
    {
        $product = $this->productBuilder
            ->generateUuid()
            ->addName($command->getName())
            ->addPrice($command->getPriceAmount(), $command->getPriceCurrency())
            ->build();
        $this->productRepository->save($product);

        $this->dispatchProductEvents($product->takeEvents());

        return $product->getUuid();
    }

    private function dispatchProductEvents(array $events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event);
        }
    }
}
