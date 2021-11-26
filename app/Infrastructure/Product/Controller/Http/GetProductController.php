<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Application\Product\Query\GetProductQuery;
use App\Application\Product\Query\GetProductQueryHandler;
use App\Domain\Core\ValueObject\Uuid;
use App\Infrastructure\Core\Controller\Http\BaseController;
use App\Infrastructure\Core\Controller\Http\BaseResponse;
use Illuminate\Http\Request;

class GetProductController extends BaseController
{
    private GetProductQueryHandler $getProductQueryHandler;

    public function __construct(GetProductQueryHandler $getProductQueryHandler)
    {
        $this->getProductQueryHandler = $getProductQueryHandler;
    }

    public function execute(Request $request, $uuid): BaseResponse
    {
        $product = $this->getProductQueryHandler->handle(new GetProductQuery(new Uuid($uuid)));

        return new GetProductResponse($product);
    }
}
