<?php

namespace App\Application\Product\Service;

class GetProductService
{
    public function execute(GetProductRequest $request)
    {
        // TODO inject repository and return product
        return ['id' => $request->getId()];
    }
}
