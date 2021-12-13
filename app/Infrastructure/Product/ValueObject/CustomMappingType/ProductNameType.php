<?php

namespace App\Infrastructure\Product\ValueObject\CustomMappingType;

use App\Domain\Product\ValueObject\ProductName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class ProductNameType extends TextType
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
