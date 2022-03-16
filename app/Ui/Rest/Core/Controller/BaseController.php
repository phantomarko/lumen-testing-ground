<?php

namespace App\Ui\Rest\Core\Controller;

use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Ui\Rest\Core\Response\ResourceCreatedResponse;
use App\Ui\Rest\Product\Response\ProductResponse;
use App\Ui\Rest\Product\Response\ProductsResponse;
use App\Ui\Rest\Product\Response\ProductUpdatedResponse;
use Laravel\Lumen\Routing\Controller;

abstract class BaseController extends Controller
{
    protected function createProductResponse(Product $product): ProductResponse
    {
        return ProductResponse::make($product);
    }

    protected function createProductsResponse(array $products): ProductsResponse
    {
        return ProductsResponse::make($products);
    }

    protected function createResourceCreatedResponse(string $uuid): ResourceCreatedResponse
    {
        return new ResourceCreatedResponse($uuid);
    }

    protected function createResourceUpdatedResponse(Product $product): ProductUpdatedResponse
    {
        return ProductUpdatedResponse::make($product);
    }
}
