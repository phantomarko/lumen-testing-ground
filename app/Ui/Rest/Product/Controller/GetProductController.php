<?php

namespace App\Ui\Rest\Product\Controller;

use App\Application\Product\Query\GetProductQuery;
use App\Domain\Product\Model\Product;
use App\Infrastructure\Core\Bus\QueryBus;
use App\Ui\Rest\Core\Controller\BaseController;
use App\Ui\Rest\Core\Response\BaseResponse;

class GetProductController extends BaseController
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function index(string $uuid): BaseResponse
    {
        /** @var Product $product */
        $product = $this->queryBus->handle(new GetProductQuery($uuid));

        return $this->createProductResponse($product);
    }
}
