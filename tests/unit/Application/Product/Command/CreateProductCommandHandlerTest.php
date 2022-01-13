<?php

namespace unit\Application\Product\Command;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Repository\ProductRepository;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use unit\Domain\Core\Event\DummyEventDispatcher;
use unit\ProductTestingTrait;

class CreateProductCommandHandlerTest extends TestCase
{
    use ProductTestingTrait;

    public function testCreate_product()
    {
        $name = 'test';
        $priceAmount = 1;
        $priceCurrency = 'EUR';
        $command = $this->createCreateProductCommand($name, $priceAmount, $priceCurrency);
        $builder = $this->createProductBuilder(new RamseyUuidGenerator());
        $repository = $this->createMock(ProductRepository::class);
        $eventDispatcher = new DummyEventDispatcher();
        $this->repositoryMockWillSaveAProduct($repository);
        $handler = $this->createCreateProductCommandHandler($builder, $repository, $eventDispatcher);

        $uuid = $handler->handle($command);

        $this->assertIsString($uuid);
        $this->assertGreaterThan(0, $eventDispatcher->getNumberOfDispatchedEvents());
    }

    private function repositoryMockWillSaveAProduct(MockObject $productRepository): void
    {
        $productRepository
            ->expects($this->once())
            ->method('save');
    }
}
