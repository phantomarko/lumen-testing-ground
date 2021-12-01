<?php

namespace App\Ui\Rest\Core\Controller;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Ui\Rest\Core\Response\ResourceCreatedResponse;
use App\Ui\Rest\Product\Response\ProductResponse;
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
