<?php

namespace App\Infrastructure\Product;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Product\Repository\RandomProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, RandomProductRepository::class);
    }
}
