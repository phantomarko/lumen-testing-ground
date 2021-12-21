<?php

namespace App\Infrastructure\Product\ValueObject\EntityManager;

use App\Domain\Product\ValueObject\ProductName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ProductNameCustomType extends StringType
{
    private const NAME = 'productname';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new ProductName($value);
    }

    /**
     * @param ProductName $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function getName()
    {
        return self::NAME;
    }
}
