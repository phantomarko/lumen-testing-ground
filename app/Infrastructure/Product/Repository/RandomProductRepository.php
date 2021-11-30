<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Product\ValueObject\ProductName;

class RandomProductRepository implements ProductRepositoryInterface
{

    public function findByUuid(Uuid $uuid): ?Product
    {
        return new Product(
            $uuid,
            new ProductName($this->generateRandomString()),
            new Price(288.88, Currency::createDollar())
        );
    }

    private function generateRandomString(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
