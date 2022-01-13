<?php

namespace App\Application\Product\Listener;

use App\Application\Product\Exception\ProductAlreadyExistsInAlternativeStorageException;
use App\Domain\Core\Service\Logger;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreatedEvent;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\Service\ProductFinder;

class SaveProductOnAlternativeStorageListener
{
    const LOGGER_MESSAGE_PREFIX = 'Exception launched in ' . SaveProductOnAlternativeStorageListener::class . ': ';

    private ProductRepository $alternativeProductRepository;
    private ProductFinder $productFinder;
    private Logger $logger;

    public function __construct(
        ProductRepository $alternativeProductRepository,
        ProductFinder $productFinder,
        Logger $logger
    ) {
        $this->alternativeProductRepository = $alternativeProductRepository;
        $this->productFinder = $productFinder;
        $this->logger = $logger;
    }

    public function onProductCreated(ProductCreatedEvent $event): void
    {
        try {
            $productUuid = $event->getProductUuid();
            $this->guardAgainstProductExistsInAlternativeStorage($productUuid);
            $this->alternativeProductRepository->save($this->productFinder->byUuid($productUuid));

        } catch (\Exception $exception) {
            $this->logger->error(self::LOGGER_MESSAGE_PREFIX . $exception->getMessage());
        }
    }

    private function guardAgainstProductExistsInAlternativeStorage(string $productUuid): void
    {
        if (!empty($this->alternativeProductRepository->findByUuid(new Uuid($productUuid)))) {
            throw new ProductAlreadyExistsInAlternativeStorageException($productUuid);
        }
    }
}
