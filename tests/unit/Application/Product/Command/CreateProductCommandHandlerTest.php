<?php

namespace unit\Application\Product\Command;

use App\Application\Product\Command\CreateProductCommand;
use App\Application\Product\Command\CreateProductCommandHandler;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Builder\ProductBuilder;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use PHPUnit\Framework\TestCase;

class CreateProductCommandHandlerTest extends TestCase
{
    public function testCreate_product()
    {
        $name = 'test';
        $priceAmount = 1;
        $priceCurrency = 'EUR';
        $command = new CreateProductCommand($name, $priceAmount, $priceCurrency);

        $builder = new ProductBuilder(new RamseyUuidGenerator());
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('save');
        $handler = new CreateProductCommandHandler($builder, $repository);

        $uuid = $handler->handle($command);

        $this->assertInstanceOf(Uuid::class, $uuid);
    }
}
