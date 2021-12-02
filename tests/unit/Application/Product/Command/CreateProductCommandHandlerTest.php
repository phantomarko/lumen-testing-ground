<?php

namespace unit\Application\Product\Command;

use App\Application\Product\Command\CreateProductCommand;
use App\Application\Product\Command\CreateProductCommandHandler;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Product\ValueObject\ProductName;
use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use PHPUnit\Framework\TestCase;

class CreateProductCommandHandlerTest extends TestCase
{
    public function testCreate_product()
    {
        $name = new ProductName('test');
        $price = new Price(1, Currency::createEuro());
        $command = new CreateProductCommand($name, $price);

        $factory = new ProductFactory(new RamseyUuidGenerator());
        $repository = $this->createMock(ProductRepositoryInterface::class);
        $repository
            ->expects($this->once())
            ->method('save');
        $handler = new CreateProductCommandHandler($factory, $repository);

        $uuid = $handler->handle($command);

        $this->assertInstanceOf(Uuid::class, $uuid);
    }
}
