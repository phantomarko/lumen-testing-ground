<?php

namespace unit\Application\Product\Listener;

use App\Application\Product\Listener\SaveProductOnAlternativeStorageListener;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Event\ProductCreatedEvent;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\ValueObject\ProductName;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use unit\CoreTestingTrait;

class SaveProductOnAlternativeStorageListenerTest extends TestCase
{
    use CoreTestingTrait;

    private MockObject $productRepository;
    private Product $product;

    public function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->product = $this->generateProduct();
    }

    public function testSave_product_that_already_exists()
    {
        $this->repositoryWillReturn($this->product);
        $this->repositoryWillPersistAProduct(false);
        $listener = new SaveProductOnAlternativeStorageListener($this->productRepository);

        $listener->onProductCreated(new ProductCreatedEvent($this->product));
    }

    public function testSave_product_that_not_exists()
    {
        $this->repositoryWillReturn(null);
        $this->repositoryWillPersistAProduct(true);
        $listener = new SaveProductOnAlternativeStorageListener($this->productRepository);

        $listener->onProductCreated(new ProductCreatedEvent($this->product));
    }

    private function repositoryWillReturn(?Product $product): void
    {
        $this->productRepository->expects($this->once())
            ->method('findByUuid')
            ->willReturn($product);
    }

    private function repositoryWillPersistAProduct(bool $willPersist): void
    {
        $this->productRepository->expects($willPersist ? $this->once() : $this->never())
            ->method('save');
    }

    private function generateProduct(): Product
    {
        return new Product(
            new Uuid($this->generateUuid()),
            new ProductName('example'),
            new Price(28.8, Currency::dollar()->getValue())
        );
    }
}
