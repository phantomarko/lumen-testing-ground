<?php

namespace App\Infrastructure\Product\ValueObject\DocumentManager;

use App\Domain\Product\ValueObject\ProductName;
use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;

class ProductNameCustomType extends Type
{
    use ClosureToPHP;

    public function convertToPHPValue($value): ProductName
    {
        $value = parent::convertToPHPValue($value);

        return new ProductName($value);
    }

    /**
     * @param ProductName|string $value
     */
    public function convertToDatabaseValue($value): string
    {
        return $value->getValue();
    }
}
