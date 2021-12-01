<?php

namespace App\Infrastructure\Core\Controller\Http;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Infrastructure\Product\Controller\Http\ProductResponse;
use Laravel\Lumen\Routing\Controller;

abstract class BaseController extends Controller
{
    protected function createProductResponse(Product $product): ProductResponse
    {
        return new ProductResponse($product);
    }

    protected function createResourceCreatedResponse(Uuid $uuid): ResourceCreatedResponse
    {
        return new ResourceCreatedResponse($uuid);
    }
}
