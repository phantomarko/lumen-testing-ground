<?php

namespace App\Infrastructure\Product\ValueObject\EntityManager;

use App\Domain\Product\ValueObject\ProductName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ProductNameCustomType extends StringType
{
    private const NAME = 'productname';

    /**
     * @param                                               $value
     * @param   \Doctrine\DBAL\Platforms\AbstractPlatform   $platform
     *
     * @return \App\Domain\Product\ValueObject\ProductName
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ProductName
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new ProductName($value);
    }

    /**
     * @param                                               $value
     * @param   \Doctrine\DBAL\Platforms\AbstractPlatform   $platform
     *
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->getValue();
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
