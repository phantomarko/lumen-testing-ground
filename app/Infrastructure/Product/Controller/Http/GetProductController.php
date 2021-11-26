<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Application\Product\Service\GetProductRequest;
use App\Application\Product\Service\GetProductService;
use App\Infrastructure\Core\Controller\Http\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetProductController extends BaseController
{
    private GetProductService $getProductService;

    public function __construct(GetProductService $getProductService)
    {
        $this->getProductService = $getProductService;
    }

    public function execute(Request $request, $id): Response
    {
        $product = $this->getProductService->execute(new GetProductRequest($id));

        return new Response(
            $product
        );
    }
}
