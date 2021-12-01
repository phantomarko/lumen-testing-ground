<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Application\Product\Query\GetProductQuery;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Infrastructure\Core\Controller\Http\BaseController;
use App\Infrastructure\Core\Controller\Http\BaseResponse;
use League\Tactician\CommandBus;

class GetProductController extends BaseController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function index(string $uuid): BaseResponse
    {
        /** @var Product $product */
        $product = $this->commandBus->handle(new GetProductQuery(new Uuid($uuid)));

        return $this->createProductResponse($product);
    }
}
