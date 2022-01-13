<?php

namespace unit\Application\Product\Listener;

use App\Application\Product\Listener\SaveProductOnAlternativeStorageListener;
use App\Domain\Core\Service\Logger;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreatedEvent;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\Service\ProductFinder;
use App\Domain\Product\ValueObject\ProductName;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use unit\CoreTestingTrait;

class SaveProductOnAlternativeStorageListenerTest extends TestCase
{
    use CoreTestingTrait;

    private MockObject $alternativeProductRepository;
    private MockObject $mainProductRepository;
    private MockObject $logger;
    private Product $product;

    public function setUp(): void
    {
        $this->alternativeProductRepository = $this->createMock(ProductRepository::class);
        $this->mainProductRepository = $this->createMock(ProductRepository::class);
        $this->productFinder = $this->createMock(ProductFinder::class);
        $this->logger = $this->createMock(Logger::class);
        $this->product = $this->generateProduct();
    }

    public function testSave_product_that_already_exists_in_the_alternative_storage()
    {
        $this->theRepositoryWillReturn($this->alternativeProductRepository, $this->product);
        $this->theAlternativeRepositoryWillPersistAProduct(false);
        $this->theLoggerWillLogAnException(true);
        $listener = $this->createListener();

        $listener->onProductCreated($this->createProductCreatedEvent());
    }

    public function testSave_product_that_not_exists_in_the_main_storage()
    {
        $this->theRepositoryWillReturn($this->alternativeProductRepository, null);
        $this->theRepositoryWillReturn($this->mainProductRepository, null);
        $this->theAlternativeRepositoryWillPersistAProduct(false);
        $this->theLoggerWillLogAnException(true);
        $listener = $this->createListener();

        $listener->onProductCreated($this->createProductCreatedEvent());
    }

    public function testSave_product_that_not_exists_in_the_alternative_and_exists_in_the_main()
    {
        $this->theRepositoryWillReturn($this->alternativeProductRepository, null);
        $this->theRepositoryWillReturn($this->mainProductRepository, $this->product);
        $this->theAlternativeRepositoryWillPersistAProduct(true);
        $this->theLoggerWillLogAnException(false);
        $listener = $this->createListener();

        $listener->onProductCreated($this->createProductCreatedEvent());
    }

    private function theRepositoryWillReturn(MockObject $repository, ?Product $product): void
    {
        $repository->expects($this->once())
            ->method('findByUuid')
            ->willReturn($product);
    }

    private function theAlternativeRepositoryWillPersistAProduct(bool $willPersist): void
    {
        $this->alternativeProductRepository->expects($willPersist ? $this->once() : $this->never())
            ->method('save');
    }

    private function theLoggerWillLogAnException(bool $willLog): void
    {
        $this->logger->expects($willLog ? $this->once() : $this->never())
            ->method('error');
    }

    private function generateProduct(): Product
    {
        return new Product(
            new Uuid($this->generateUuid()),
            new ProductName('example'),
            new Price(28.8, Currency::dollar()->getValue())
        );
    }

    private function createListener(): SaveProductOnAlternativeStorageListener
    {
        return new SaveProductOnAlternativeStorageListener(
            $this->alternativeProductRepository,
            new ProductFinder($this->mainProductRepository),
            $this->logger
        );
    }

    private function createProductCreatedEvent(): ProductCreatedEvent
    {
        return new ProductCreatedEvent($this->product->getUuid());
    }
}
