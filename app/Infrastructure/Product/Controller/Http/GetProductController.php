<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Application\Product\Service\GetProductRequest;
use App\Application\Product\Service\GetProductService;
use App\Domain\Core\ValueObject\Uuid;
use App\Infrastructure\Core\Controller\Http\BaseController;
use App\Infrastructure\Core\Controller\Http\BaseResponse;
use Illuminate\Http\Request;

class GetProductController extends BaseController
{
    private GetProductService $getProductService;

    public function __construct(GetProductService $getProductService)
    {
        $this->getProductService = $getProductService;
    }

    public function execute(Request $request, $uuid): BaseResponse
    {
        $product = $this->getProductService->execute(new GetProductRequest(new Uuid($uuid)));

        return new GetProductResponse($product);
    }
}
