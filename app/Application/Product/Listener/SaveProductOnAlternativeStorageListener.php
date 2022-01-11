<?php

namespace App\Application\Product\Listener;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreated;
use App\Domain\Product\Repository\ProductRepository;

class SaveProductOnAlternativeStorageListener
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function onProductCreated(ProductCreated $event): void
    {
        $product = $event->getProduct();
        if ($this->productAlreadyExists($product->getUuid())) {
            return;
        }

        $this->productRepository->save($product);
    }

    private function productAlreadyExists(string $productUuid): bool
    {
        return !empty($this->productRepository->findByUuid(new Uuid($productUuid)));
    }
}
