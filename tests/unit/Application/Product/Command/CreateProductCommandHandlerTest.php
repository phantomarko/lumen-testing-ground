<?php

namespace unit\Application\Product\Command;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
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
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $this->repositoryMockWillSaveAProduct($repository);
        $handler = $this->createCreateProductCommandHandler($builder, $repository);

        $uuid = $handler->handle($command);

        $this->assertInstanceOf(Uuid::class, $uuid);
    }

    private function repositoryMockWillSaveAProduct(MockObject $productRepository): void
    {
        $productRepository
            ->expects($this->once())
            ->method('save');
    }
}
