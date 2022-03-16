<?php

namespace App\Application\Product\Command;

use App\Domain\Core\Event\EventDispatcher;
use App\Domain\Product\Builder\ProductBuilder;
use App\Domain\Product\Builder\ProductUpdater;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;

class UpdateProductCommandHandler
{
    public function __construct(
        private ?ProductUpdater $productUpdater,
        private ?ProductRepository $productRepository,
        private ?EventDispatcher $eventDispatcher
    )
    {
    }

    public function handle(UpdateProductCommand $command): Product
    {
        $product = $this->productUpdater->addUuid($command->getUuid())
            ->addName($command->getName())
            ->addPrice($command->getPriceAmount(), $command->getPriceCurrency())
            ->update();
        $this->productRepository->save($product);

        $this->dispatchProductEvents($product->takeEvents());

        return $product;
    }

    private function dispatchProductEvents(array $events): void
    {
        foreach ($events as $event) {
            $this->eventDispatcher->dispatch($event);
        }
    }
}
